<x-layouts.app title="Manage Submissions — LiveHacks">
    <x-landing.navbar />
    
    <div class="min-h-screen bg-gradient-to-b from-white via-solar-bg/5 to-white pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-12">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-bold text-text-primary mb-2">Manage Submissions</h1>
                        <p class="text-lg text-text-secondary">Review and award winners from your hackathons</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-solar hover:text-solar-hover transition-colors">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i> Back
                    </a>
                </div>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span class="text-emerald-800">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Search Bar --}}
            <div class="mb-8">
                <form method="GET" action="{{ route('admin.submissions') }}" class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-5 h-5 text-text-secondary"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by team name..." 
                            class="input-solar pl-12 w-full" autofocus>
                    </div>
                    <button type="submit" class="btn-solar px-6 py-3 rounded-xl font-semibold">Search</button>
                    @if (request('search'))
                    <a href="{{ route('admin.submissions') }}" class="btn-solar-outline px-6 py-3 rounded-xl font-semibold">Clear</a>
                    @endif
                </form>
            </div>

            {{-- Submissions Grouped by Hackathon --}}
            @if ($groupedSubmissions->count() > 0)
                @foreach ($groupedSubmissions as $hackathon => $submissionsByHackathon)
                <div class="mb-6 bg-white rounded-2xl border border-border shadow-lg overflow-hidden">
                    {{-- Hackathon Header (Like a Folder) --}}
                    <button onclick="toggleHackathon(this)" class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors group" data-hackathon-id="{{ $submissionsByHackathon[0]->hackathon->id }}">
                        <div class="flex items-center gap-4 flex-1 text-left">
                            <i data-lucide="folder-open" class="w-6 h-6 text-solar shrink-0"></i>
                            <div>
                                <h3 class="text-lg font-bold text-text-primary">{{ $submissionsByHackathon[0]->hackathon->title }}</h3>
                                <p class="text-sm text-text-secondary">{{ count($submissionsByHackathon) }} submission{{ count($submissionsByHackathon) !== 1 ? 's' : '' }}</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-text-secondary group-hover:text-text-primary transition-transform" style="transition: transform 0.3s;"></i>
                    </button>

                    {{-- Submissions List (Inside Folder) --}}
                    <div class="border-t border-border hidden" style="display: none;">
                        <div class="divide-y divide-border">
                            @foreach ($submissionsByHackathon as $submission)
                            <div class="px-6 py-6 hover:bg-gray-50/50 transition-colors">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    {{-- Left: Team & Project Info --}}
                                    <div class="lg:col-span-2">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h4 class="text-lg font-bold text-text-primary">{{ $submission->team_name }}</h4>
                                                <p class="text-sm text-text-secondary">{{ $submission->project_title }}</p>
                                            </div>
                                            @if ($submission->is_winner)
                                            <div class="flex items-center gap-2 px-3 py-2 rounded-full bg-yellow-50 border border-yellow-200">
                                                <i data-lucide="trophy" class="w-4 h-4 text-yellow-600"></i>
                                                <span class="text-sm font-semibold text-yellow-900">Winner</span>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                            <div>
                                                <p class="text-text-secondary">Lead: <span class="font-semibold text-text-primary">{{ $submission->participant_name }}</span></p>
                                                <p class="text-text-secondary">Mobile: <span class="font-semibold text-text-primary">{{ $submission->mobile_number }}</span></p>
                                            </div>
                                            <div>
                                                <p class="text-text-secondary">Submitted: <span class="font-semibold text-text-primary">{{ $submission->submitted_at?->format('M d, H:i') }}</span></p>
                                                <p class="text-text-secondary">Submissions: <span class="font-semibold text-text-primary">{{ $submission->submission_count }}</span></p>
                                            </div>
                                        </div>

                                        <p class="text-sm text-text-secondary mb-4 line-clamp-2">{{ $submission->description }}</p>

                                        {{-- Links --}}
                                        <div class="flex flex-wrap gap-2">
                                            @if ($submission->zip_file)
                                            <a href="{{ route('admin.submissions.download', $submission) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-solar-bg hover:bg-solar text-solar hover:text-white rounded-lg transition-colors text-sm font-medium">
                                                <i data-lucide="download" class="w-4 h-4"></i> Download ZIP
                                            </a>
                                            @endif
                                            @if ($submission->github_link)
                                            <a href="{{ $submission->github_link }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-2 border border-border hover:border-solar text-text-secondary hover:text-solar rounded-lg transition-colors text-sm font-medium">
                                                <i data-lucide="github" class="w-4 h-4"></i> GitHub
                                            </a>
                                            @endif
                                            @if ($submission->demo_video_link)
                                            <a href="{{ $submission->demo_video_link }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-2 border border-border hover:border-solar text-text-secondary hover:text-solar rounded-lg transition-colors text-sm font-medium">
                                                <i data-lucide="play-circle" class="w-4 h-4"></i> Demo Video
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Right: Winner Assignment (Only show after hackathon ends) --}}
                                    <div class="lg:col-span-1">
                                        @if ($submissionsByHackathon[0]->hackathon->hackathon_end && now()->gte($submissionsByHackathon[0]->hackathon->hackathon_end))
                                            <form method="POST" action="{{ route('admin.submissions.assign-winner', $submission) }}" class="space-y-2">
                                                @csrf
                                                @if ($submission->is_winner)
                                                    <button type="submit" class="w-full btn-solar-outline px-4 py-2.5 rounded-lg font-semibold text-sm">
                                                        <i data-lucide="x" class="w-4 h-4 inline"></i> Remove Winner Badge
                                                    </button>
                                                @else
                                                    <button type="submit" class="w-full px-4 py-2.5 rounded-lg font-semibold text-sm bg-yellow-50 hover:bg-yellow-100 text-yellow-900 border border-yellow-200 transition-colors">
                                                        <i data-lucide="trophy" class="w-4 h-4 inline"></i> Mark as Winner
                                                    </button>
                                                @endif
                                            </form>
                                        @else
                                            <div class="text-center py-2">
                                                <p class="text-sm text-text-secondary font-medium">Judging disabled</p>
                                                <p class="text-xs text-text-secondary">until hackathon ends</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="bg-white rounded-2xl border border-border shadow-lg p-12 text-center">
                <i data-lucide="inbox" class="w-16 h-16 text-text-secondary/30 mx-auto mb-4"></i>
                <h2 class="text-2xl font-bold text-text-primary mb-2">
                    @if (request('search'))
                        No teams found
                    @else
                        No Submissions Yet
                    @endif
                </h2>
                <p class="text-text-secondary">
                    @if (request('search'))
                        Try searching with a different team name
                    @else
                        Submissions from your hosted hackathons will appear here
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>

    <script>
        function toggleHackathon(button) {
            const content = button.nextElementSibling;
            const chevron = button.querySelector('i[data-lucide="chevron-down"]');
            
            if (content.style.display === 'none' || content.style.display === '') {
                content.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
            } else {
                content.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>
</x-layouts.app>
