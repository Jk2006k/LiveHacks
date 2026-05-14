<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Show the hackathon workspace / submission dashboard.
     */
    public function workspace(Hackathon $hackathon)
    {
        $hackathon->load('host');
        $hackathon->loadCount('participants');

        $user = Auth::user();

        // Check if user has joined this hackathon
        $hasJoined = $hackathon->participants()->where('user_id', $user->id)->exists();
        if (!$hasJoined) {
            return redirect()->route('hackathons.show', $hackathon)
                ->with('error', 'You must join this hackathon first to access the workspace.');
        }

        // Get existing submission
        $submission = Submission::where('hackathon_id', $hackathon->id)
            ->where('user_id', $user->id)
            ->first();

        // Determine submission window status
        $now = now();
        $hackStarted = $hackathon->hackathon_start && $now->gte($hackathon->hackathon_start);
        $hackEnded = $hackathon->hackathon_end && $now->gte($hackathon->hackathon_end);
        $canSubmit = $hackStarted && !$hackEnded;

        // Determine submission status
        $submissionStatus = 'not_submitted';
        if ($hackEnded && !$submission) {
            $submissionStatus = 'closed';
        } elseif ($submission && $submission->submission_count > 1) {
            $submissionStatus = 'resubmitted';
        } elseif ($submission) {
            $submissionStatus = 'submitted';
        }

        return view('hackathons.workspace', compact(
            'hackathon', 'submission', 'canSubmit',
            'hackStarted', 'hackEnded', 'submissionStatus'
        ));
    }

    /**
     * Store or update a submission.
     */
    public function submit(Request $request, Hackathon $hackathon)
    {
        $user = Auth::user();

        // Verify participant
        if (!$hackathon->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You must join this hackathon first.');
        }

        // Check submission window
        $now = now();
        if ($hackathon->hackathon_start && $now->lt($hackathon->hackathon_start)) {
            return back()->with('error', 'Submissions are not open yet. The hackathon has not started.');
        }
        if ($hackathon->hackathon_end && $now->gte($hackathon->hackathon_end)) {
            return back()->with('error', 'Submission deadline has passed. You can no longer submit.');
        }

        // Check for existing submission
        $existing = Submission::where('hackathon_id', $hackathon->id)
            ->where('user_id', $user->id)
            ->first();

        // Validation rules
        $rules = [
            'team_name'        => ['required', 'string', 'max:255'],
            'participant_name' => ['required', 'string', 'max:255'],
            'mobile_number'    => ['required', 'string', 'regex:/^[+]?[0-9]{7,15}$/'],
            'github_link'      => ['required', 'url', 'max:500'],
            'project_title'    => ['required', 'string', 'max:255'],
            'description'      => ['required', 'string', 'max:5000'],
            'demo_video_link'  => ['nullable', 'url', 'max:500'],
        ];

        // ZIP is required for new submissions, optional for resubmissions
        if (!$existing) {
            $rules['zip_file'] = ['required', 'file', 'mimes:zip', 'max:102400']; // 100MB max
        } else {
            $rules['zip_file'] = ['nullable', 'file', 'mimes:zip', 'max:102400'];
        }

        $validated = $request->validate($rules, [
            'mobile_number.regex' => 'Please enter a valid mobile number (7-15 digits, optional + prefix).',
            'zip_file.mimes'      => 'Only .zip files are allowed.',
            'zip_file.max'        => 'ZIP file must be less than 100MB.',
            'github_link.url'     => 'Please enter a valid GitHub repository URL.',
            'demo_video_link.url' => 'Please enter a valid video URL.',
        ]);

        // Handle ZIP file upload
        $zipPath = $existing?->zip_file;
        $zipFileName = $existing?->zip_file_name;
        $zipFileSize = $existing?->zip_file_size;

        if ($request->hasFile('zip_file')) {
            // Delete old file if resubmitting
            if ($existing && $existing->zip_file && Storage::disk('local')->exists($existing->zip_file)) {
                Storage::disk('local')->delete($existing->zip_file);
            }

            $file = $request->file('zip_file');
            $zipFileName = $file->getClientOriginalName();
            $zipFileSize = $file->getSize();
            $zipPath = $file->store('submissions/' . $hackathon->id, 'local');
        }

        if ($existing) {
            // Update existing submission (resubmission)
            $existing->update([
                'team_name'        => $validated['team_name'],
                'participant_name' => $validated['participant_name'],
                'mobile_number'    => $validated['mobile_number'],
                'github_link'      => $validated['github_link'],
                'project_title'    => $validated['project_title'],
                'description'      => $validated['description'],
                'zip_file'         => $zipPath,
                'zip_file_name'    => $zipFileName,
                'zip_file_size'    => $zipFileSize,
                'demo_video_link'  => $validated['demo_video_link'],
                'submitted_at'     => now(),
                'submission_count' => $existing->submission_count + 1,
            ]);

            return back()->with('success', 'Your submission has been updated successfully!');
        } else {
            // Create new submission
            Submission::create([
                'hackathon_id'     => $hackathon->id,
                'user_id'          => $user->id,
                'team_name'        => $validated['team_name'],
                'participant_name' => $validated['participant_name'],
                'mobile_number'    => $validated['mobile_number'],
                'github_link'      => $validated['github_link'],
                'project_title'    => $validated['project_title'],
                'description'      => $validated['description'],
                'zip_file'         => $zipPath,
                'zip_file_name'    => $zipFileName,
                'zip_file_size'    => $zipFileSize,
                'demo_video_link'  => $validated['demo_video_link'],
                'submitted_at'     => now(),
                'submission_count' => 1,
            ]);

            return back()->with('success', 'Your project has been submitted successfully!');
        }
    }

    /**
     * Download problem statement PDF.
     */
    public function downloadProblemStatement(Hackathon $hackathon)
    {
        $user = Auth::user();

        // Only participants and the host can download
        $isHost = $hackathon->user_id === $user->id;
        $hasJoined = $hackathon->participants()->where('user_id', $user->id)->exists();

        if (!$isHost && !$hasJoined) {
            return back()->with('error', 'You must join this hackathon to download the problem statement.');
        }

        if (!$hackathon->problem_statement_pdf || !Storage::disk('public')->exists($hackathon->problem_statement_pdf)) {
            return back()->with('error', 'Problem statement not available.');
        }

        return Storage::disk('public')->download(
            $hackathon->problem_statement_pdf,
            'Problem_Statement_' . str_replace(' ', '_', $hackathon->title) . '.pdf'
        );
    }

    /**
     * Admin: View all submissions for a hackathon.
     */
    public function adminIndex(Request $request)
    {
        $user = Auth::user();

        // Get hackathons hosted by this user
        $hostedHackathons = Hackathon::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all submissions for user's hackathons
        $query = Submission::whereIn('hackathon_id', $hostedHackathons->pluck('id'))
            ->with('hackathon', 'user');

        // Search by team name
        $search = $request->input('search');
        if ($search) {
            $query->where('team_name', 'like', "%{$search}%");
        }

        // Get submissions and group by hackathon
        $submissions = $query->orderBy('submitted_at', 'desc')->get();
        
        $groupedSubmissions = $submissions->groupBy(function ($submission) {
            return $submission->hackathon->title;
        });

        return view('hackathons.admin-submissions', compact(
            'groupedSubmissions', 'search'
        ));
    }

    /**
     * Assign/remove winner status to a submission.
     */
    public function assignWinner(Submission $submission)
    {
        $user = Auth::user();

        // Only the hackathon host can assign winners
        if ($submission->hackathon->user_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }

        // Toggle winner status
        $submission->update([
            'is_winner' => !$submission->is_winner
        ]);

        $message = $submission->is_winner 
            ? 'Team marked as winner!' 
            : 'Winner badge removed!';

        return back()->with('success', $message);
    }

    /**
     * Admin: Download a submitted ZIP file.
     */
    public function downloadZip(Submission $submission)
    {
        $user = Auth::user();

        // Only the hackathon host can download
        if ($submission->hackathon->user_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }

        if (!$submission->zip_file || !Storage::disk('local')->exists($submission->zip_file)) {
            return back()->with('error', 'ZIP file not found.');
        }

        return Storage::disk('local')->download(
            $submission->zip_file,
            $submission->zip_file_name ?? 'submission.zip'
        );
    }
}
