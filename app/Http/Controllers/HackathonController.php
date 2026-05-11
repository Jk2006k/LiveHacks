<?php

namespace App\Http\Controllers;

use App\Models\Hackathon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HackathonController extends Controller
{
    /**
     * Display the hackathon dashboard with search, filters, and tabs.
     */
    public function dashboard(Request $request)
    {
        $query = Hackathon::published()
            ->with('host')
            ->withCount('participants');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        // Tab: latest, trending (most participants), featured
        $tab = $request->input('tab', 'latest');

        switch ($tab) {
            case 'trending':
                $query->orderByDesc('participants_count');
                break;
            case 'featured':
                $query->featured();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $hackathons = $query->paginate(9)->withQueryString();

        // Get distinct categories for the filter
        $categories = Hackathon::published()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('dashboard', compact('hackathons', 'categories', 'tab', 'search', 'category'));
    }

    /**
     * Show the "Host a Hackathon" form.
     */
    public function create()
    {
        return view('hackathons.create');
    }

    /**
     * Store a new hackathon.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'              => ['required', 'string', 'max:255'],
            'tagline'            => ['nullable', 'string', 'max:255'],
            'description'        => ['nullable', 'string', 'max:5000'],
            'category'           => ['required', 'string', 'max:100'],
            'difficulty'         => ['required', 'in:Beginner Friendly,Intermediate,Advanced'],
            'prize_pool'         => ['required', 'numeric', 'min:0'],
            'entry_fee'          => ['required', 'numeric', 'min:0'],
            'team_limit'         => ['required', 'integer', 'min:1', 'max:20'],
            'max_participants'   => ['nullable', 'integer', 'min:1'],
            'tags'               => ['nullable', 'string'],
            'registration_start' => ['nullable', 'date'],
            'registration_end'   => ['nullable', 'date', 'after_or_equal:registration_start'],
            'hackathon_start'    => ['nullable', 'date'],
            'hackathon_end'      => ['nullable', 'date', 'after_or_equal:hackathon_start'],
            'banner_image'           => ['nullable', 'image', 'max:2048'],
            'logo_image'             => ['nullable', 'image', 'max:1024'],
            'problem_statement_pdf'  => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        // Process tags
        $tags = null;
        if (!empty($validated['tags'])) {
            $tags = array_map('trim', explode(',', $validated['tags']));
        }

        // Handle file uploads
        $bannerPath = null;
        $logoPath = null;
        $pdfPath = null;

        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('hackathons/banners', 'public');
        }

        if ($request->hasFile('logo_image')) {
            $logoPath = $request->file('logo_image')->store('hackathons/logos', 'public');
        }

        if ($request->hasFile('problem_statement_pdf')) {
            $pdfPath = $request->file('problem_statement_pdf')->store('hackathons/problem-statements', 'public');
        }

        $hackathon = Hackathon::create([
            'user_id'            => Auth::id(),
            'title'              => $validated['title'],
            'tagline'            => $validated['tagline'],
            'description'        => $validated['description'],
            'category'           => $validated['category'],
            'difficulty'         => $validated['difficulty'],
            'prize_pool'         => $validated['prize_pool'],
            'entry_fee'          => $validated['entry_fee'],
            'team_limit'         => $validated['team_limit'],
            'max_participants'   => $validated['max_participants'],
            'banner_image'           => $bannerPath,
            'logo_image'             => $logoPath,
            'problem_statement_pdf'  => $pdfPath,
            'tags'                   => $tags,
            'registration_start' => $validated['registration_start'],
            'registration_end'   => $validated['registration_end'],
            'hackathon_start'    => $validated['hackathon_start'],
            'hackathon_end'      => $validated['hackathon_end'],
            'status'             => 'published',
        ]);

        return redirect()->route('dashboard')->with('success', 'Hackathon created successfully!');
    }

    /**
     * Show hackathon details / join page.
     */
    public function show(Hackathon $hackathon)
    {
        $hackathon->load('host');
        $hackathon->loadCount('participants');

        $hasJoined = false;
        if (Auth::check()) {
            $hasJoined = $hackathon->participants()->where('user_id', Auth::id())->exists();
        }

        return view('hackathons.show', compact('hackathon', 'hasJoined'));
    }

    /**
     * Join a hackathon.
     */
    public function join(Hackathon $hackathon)
    {
        $user = Auth::user();

        if ($hackathon->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already joined this hackathon.');
        }

        if ($hackathon->max_participants && $hackathon->participants()->count() >= $hackathon->max_participants) {
            return back()->with('error', 'This hackathon is full.');
        }

        $hackathon->participants()->attach($user->id);

        return back()->with('success', 'You have successfully joined the hackathon!');
    }
}
