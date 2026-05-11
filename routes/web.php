<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel is running correctly!',
        'timestamp' => now()
    ]);
});

Route::get('/about', function () {
    return view('about');
});

// ── Authentication Routes ────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Allow logout via POST or GET regardless of auth state to prevent 404s
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Dashboard (public) ──────────────────────────────
Route::get('/dashboard', [HackathonController::class, 'dashboard'])->name('dashboard');

// ── Hackathon Routes ─────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/hackathons/create', [HackathonController::class, 'create'])->name('hackathons.create');
    Route::post('/hackathons', [HackathonController::class, 'store'])->name('hackathons.store');
    Route::post('/hackathons/{hackathon}/join', [HackathonController::class, 'join'])->name('hackathons.join');

    // ── Submission Routes ────────────────────────────────
    Route::get('/hackathons/{hackathon}/workspace', [SubmissionController::class, 'workspace'])->name('hackathons.workspace');
    Route::post('/hackathons/{hackathon}/submit', [SubmissionController::class, 'submit'])->name('hackathons.submit');
    Route::get('/hackathons/{hackathon}/problem-statement', [SubmissionController::class, 'downloadProblemStatement'])->name('hackathons.problem-statement');

    // ── Admin Submission Management ──────────────────────
    Route::get('/admin/submissions', [SubmissionController::class, 'adminIndex'])->name('admin.submissions');
    Route::get('/admin/submissions/{submission}/download', [SubmissionController::class, 'downloadZip'])->name('admin.submissions.download');
});

// Show hackathon detail page (public, must be after /hackathons/create)
Route::get('/hackathons/{hackathon}', [HackathonController::class, 'show'])->name('hackathons.show');