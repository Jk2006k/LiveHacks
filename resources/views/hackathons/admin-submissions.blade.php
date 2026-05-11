<x-layouts.app title="Manage Submissions — LiveHacks">
    <x-landing.navbar />

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[600px] h-[600px] bg-neon-purple/5 -top-40 -right-40 animate-float-slow"></div>
        <div class="blob w-[400px] h-[400px] bg-neon-blue/5 bottom-20 -left-32 animate-pulse-glow"></div>
    </div>

    <main class="relative z-10 pt-24 pb-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
                <div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors mb-4">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Dashboard
                    </a>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Manage <span class="gradient-text">Submissions</span></h1>
                    <p class="text-slate-400">View and manage all participant submissions for your hackathons.</p>
                </div>
            </div>

            {{-- Filters --}}
            <div class="glass-card rounded-2xl p-4 sm:p-6 mb-8">
                <form method="GET" action="{{ route('admin.submissions') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <select name="hackathon_id" class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 transition-all duration-300 appearance-none cursor-pointer">
                            <option value="" class="bg-dark-900">Select a Hackathon</option>
                            @foreach ($hostedHackathons as $h)
                            <option value="{{ $h->id }}" {{ ($hackathonId ?? '') == $h->id ? 'selected' : '' }} class="bg-dark-900">{{ $h->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <select name="sort" class="px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 transition-all duration-300 appearance-none cursor-pointer min-w-[160px]">
                        <option value="latest" {{ ($sortBy ?? 'latest') === 'latest' ? 'selected' : '' }} class="bg-dark-900">Latest First</option>
                        <option value="oldest" {{ ($sortBy ?? '') === 'oldest' ? 'selected' : '' }} class="bg-dark-900">Oldest First</option>
                        <option value="team" {{ ($sortBy ?? '') === 'team' ? 'selected' : '' }} class="bg-dark-900">By Team Name</option>
                    </select>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl hover:scale-105 transition-all duration-300 shrink-0">
                        View Submissions
                    </button>
                </form>
            </div>

            @if (session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 shrink-0"></i>
                <p class="text-red-400 text-sm">{{ session('error') }}</p>
            </div>
            @endif

            @if ($selectedHackathon)
            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                <div class="glass-card rounded-2xl p-5 text-center">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Total</p>
                    <p class="text-2xl font-black text-white">{{ $submissions->total() }}</p>
                </div>
                <div class="glass-card rounded-2xl p-5 text-center">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Hackathon</p>
                    <p class="text-sm font-bold text-neon-blue truncate">{{ $selectedHackathon->title }}</p>
                </div>
                <div class="glass-card rounded-2xl p-5 text-center">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Status</p>
                    @php $now = now(); $ended = $selectedHackathon->hackathon_end && $now->gte($selectedHackathon->hackathon_end); @endphp
                    <p class="text-sm font-bold {{ $ended ? 'text-red-400' : 'text-emerald-400' }}">{{ $ended ? 'Ended' : 'Active' }}</p>
                </div>
                <div class="glass-card rounded-2xl p-5 text-center">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Participants</p>
                    <p class="text-2xl font-black text-white">{{ $selectedHackathon->participants()->count() }}</p>
                </div>
            </div>

            {{-- Submissions List --}}
            @if ($submissions->count() > 0)
            <div class="space-y-4">
                @foreach ($submissions as $i => $sub)
                <div class="glass-card rounded-2xl overflow-hidden" style="animation: slide-up 0.4s ease-out forwards; animation-delay: {{ $i * 60 }}ms; opacity: 0;">
                    <div class="p-6 sm:p-8">
                        <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                            {{-- Left: Details --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-3">
                                    <h3 class="text-lg font-bold text-white truncate">{{ $sub->project_title }}</h3>
                                    @if ($sub->submission_count > 1)
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 shrink-0">
                                        Resubmitted ×{{ $sub->submission_count }}
                                    </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-sm">
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="users" class="w-4 h-4 text-neon-purple shrink-0"></i>
                                        <span class="truncate"><strong class="text-white">{{ $sub->team_name }}</strong></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="user" class="w-4 h-4 text-neon-blue shrink-0"></i>
                                        <span class="truncate">{{ $sub->participant_name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="phone" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                                        <span>{{ $sub->mobile_number }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="mail" class="w-4 h-4 text-slate-500 shrink-0"></i>
                                        <span class="truncate">{{ $sub->user->email ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="github" class="w-4 h-4 text-slate-500 shrink-0"></i>
                                        <a href="{{ $sub->github_link }}" target="_blank" class="text-neon-blue hover:underline truncate">{{ $sub->github_link }}</a>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="clock" class="w-4 h-4 text-slate-500 shrink-0"></i>
                                        <span>{{ $sub->submitted_at->format('M d, h:i A') }}</span>
                                    </div>
                                </div>

                                @if ($sub->description)
                                <p class="text-sm text-slate-400 mt-3 line-clamp-2">{{ $sub->description }}</p>
                                @endif

                                @if ($sub->demo_video_link)
                                <div class="flex items-center gap-2 mt-3">
                                    <i data-lucide="video" class="w-4 h-4 text-neon-pink"></i>
                                    <a href="{{ $sub->demo_video_link }}" target="_blank" class="text-sm text-neon-blue hover:underline">Demo Video</a>
                                </div>
                                @endif
                            </div>

                            {{-- Right: Download --}}
                            <div class="flex flex-col items-center gap-2 shrink-0">
                                <a href="{{ route('admin.submissions.download', $sub) }}"
                                   class="inline-flex items-center gap-2 px-5 py-3 text-sm font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/20 hover:shadow-neon-purple/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                                    <i data-lucide="download" class="w-4 h-4"></i> Download ZIP
                                </a>
                                <p class="text-xs text-slate-500">{{ $sub->zip_file_name ?? 'submission.zip' }}</p>
                                <p class="text-xs text-slate-600">{{ $sub->formatted_file_size }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if ($submissions->hasPages())
            <div class="mt-8 flex justify-center">{{ $submissions->links() }}</div>
            @endif

            @else
            <div class="glass-card rounded-3xl p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-500/10 flex items-center justify-center mb-6">
                    <i data-lucide="inbox" class="w-10 h-10 text-slate-500"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">No Submissions Yet</h2>
                <p class="text-slate-400">No participants have submitted for this hackathon yet.</p>
            </div>
            @endif

            @elseif ($hostedHackathons->isEmpty())
            <div class="glass-card rounded-3xl p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-500/10 flex items-center justify-center mb-6">
                    <i data-lucide="folder-x" class="w-10 h-10 text-slate-500"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">No Hackathons Found</h2>
                <p class="text-slate-400 mb-6">You haven't hosted any hackathons yet.</p>
                <a href="{{ route('hackathons.create') }}" class="btn-shimmer inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl transition-all duration-300 hover:scale-105">
                    <i data-lucide="plus" class="w-4 h-4"></i> Host a Hackathon
                </a>
            </div>
            @else
            <div class="glass-card rounded-3xl p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-neon-blue/10 flex items-center justify-center mb-6">
                    <i data-lucide="arrow-up" class="w-10 h-10 text-neon-blue"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Select a Hackathon</h2>
                <p class="text-slate-400">Choose a hackathon above to view its submissions.</p>
            </div>
            @endif
        </div>
    </main>
</x-layouts.app>
