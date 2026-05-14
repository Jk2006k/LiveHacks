<x-layouts.app title="{{ $hackathon->title }} — LiveHacks">
    <x-landing.navbar />
    
    <div class="min-h-screen bg-gradient-to-b from-white via-solar-bg/5 to-white pt-32 pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-solar hover:text-solar-hover transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to Hackathons
                </a>
            </div>

            {{-- Success/Error Messages --}}
            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span class="text-emerald-800">{{ session('success') }}</span>
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 shrink-0"></i>
                <span class="text-red-800">{{ session('error') }}</span>
            </div>
            @endif

            {{-- Header Section --}}
            <div class="bg-white rounded-2xl border border-border shadow-lg p-8 sm:p-10 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6">
                    <div class="flex-1">
                        <h1 class="text-4xl sm:text-5xl font-bold text-text-primary mb-3">{{ $hackathon->title }}</h1>
                        @if ($hackathon->tagline)
                            <p class="text-lg text-text-secondary mb-4">{{ $hackathon->tagline }}</p>
                        @endif
                        
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-solar-bg border border-solar-light">
                                <i data-lucide="tag" class="w-4 h-4 text-solar"></i>
                                <span class="text-sm font-medium text-text-primary">{{ $hackathon->category }}</span>
                            </span>
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200">
                                <i data-lucide="bar-chart-2" class="w-4 h-4 text-blue-600"></i>
                                <span class="text-sm font-medium text-blue-900">{{ $hackathon->difficulty }}</span>
                            </span>
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-50 border border-purple-200">
                                <i data-lucide="users" class="w-4 h-4 text-purple-600"></i>
                                <span class="text-sm font-medium text-purple-900">{{ $hackathon->participants_count }} joined</span>
                            </span>
                        </div>

                        {{-- Host Info --}}
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-solar to-solar-hover flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($hackathon->host->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">{{ $hackathon->host->name }}</p>
                                <p class="text-xs text-text-secondary">Hackathon Host</p>
                            </div>
                        </div>
                    </div>

                    {{-- Join Button / Winner Display --}}
                    <div class="sm:self-start">
                        @if ($hackathon->hackathon_end && now()->gte($hackathon->hackathon_end))
                            {{-- Hackathon has ended - Show winner --}}
                            @php
                                $winner = $hackathon->submissions()->where('is_winner', true)->first();
                            @endphp
                            @if ($winner)
                                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-300 rounded-xl px-8 py-6 text-center">
                                    <div class="flex items-center justify-center gap-2 mb-3">
                                        <i data-lucide="trophy" class="w-7 h-7 text-yellow-600"></i>
                                        <span class="font-bold text-xl text-yellow-900">🏆 Winner</span>
                                    </div>
                                    <p class="text-lg font-bold text-text-primary mb-1">{{ $winner->team_name }}</p>
                                    <p class="text-sm text-text-secondary">{{ $winner->project_title }}</p>
                                    <p class="text-xs text-yellow-700 mt-3 font-semibold">Led by {{ $winner->participant_name }}</p>
                                </div>
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-xl px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 mb-2">
                                        <i data-lucide="info" class="w-5 h-5 text-gray-600"></i>
                                        <span class="font-semibold text-gray-900">Hackathon Ended</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Winner will be announced soon.</p>
                                </div>
                            @endif
                        @else
                            {{-- Hackathon ongoing or upcoming --}}
                            @auth
                                @if ($hasJoined)
                                    {{-- User has joined --}}
                                    @if ($hackathon->hackathon_start && now()->gte($hackathon->hackathon_start))
                                        {{-- Hackathon has started - Show Start Now button --}}
                                        <a href="{{ route('hackathons.workspace', $hackathon) }}" class="btn-solar w-full px-8 py-3 font-semibold rounded-xl flex items-center gap-2 justify-center">
                                            <i data-lucide="play-circle" class="w-5 h-5"></i> Start Now
                                        </a>
                                    @else
                                        <div class="bg-blue-50 border border-blue-200 rounded-xl px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2 mb-2">
                                                <i data-lucide="check-circle" class="w-5 h-5 text-blue-600"></i>
                                                <span class="font-semibold text-blue-900">Joined</span>
                                            </div>
                                            <p class="text-sm text-blue-700">You've successfully joined! Waiting for hackathon to start.</p>
                                        </div>
                                    @endif
                                @elseif (!($hackathon->registration_end && now()->gte($hackathon->registration_end)))
                                    {{-- Registration still open - Show Join button --}}
                                    <form method="POST" action="{{ route('hackathons.join', $hackathon) }}" class="space-y-3">
                                        @csrf
                                        <button type="submit" class="btn-solar w-full px-8 py-3 font-semibold rounded-xl flex items-center gap-2 justify-center">
                                            <i data-lucide="plus-circle" class="w-5 h-5"></i> Join Now
                                        </button>
                                    </form>
                                    <p class="text-xs text-text-secondary text-center mt-3">Team size limit: {{ $hackathon->team_limit }} members</p>
                                @else
                                    {{-- Registration closed --}}
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2 mb-2">
                                            <i data-lucide="lock" class="w-5 h-5 text-gray-600"></i>
                                            <span class="font-semibold text-gray-900">Registration Closed</span>
                                        </div>
                                        <p class="text-sm text-gray-700">Registration for this hackathon has ended.</p>
                                    </div>
                                @endif
                            @else
                                @if (!($hackathon->registration_end && now()->gte($hackathon->registration_end)))
                                    <a href="{{ route('login') }}" class="btn-solar w-full px-8 py-3 font-semibold rounded-xl flex items-center gap-2 justify-center">
                                        <i data-lucide="log-in" class="w-5 h-5"></i> Login to Join
                                    </a>
                                    <p class="text-xs text-text-secondary text-center mt-3">Create an account to participate</p>
                                @else
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2 mb-2">
                                            <i data-lucide="lock" class="w-5 h-5 text-gray-600"></i>
                                            <span class="font-semibold text-gray-900">Registration Closed</span>
                                        </div>
                                        <p class="text-sm text-gray-700">Registration for this hackathon has ended.</p>
                                    </div>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

            {{-- Stats Section --}}
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
                <div class="solar-card p-6">
                    <div class="text-sm text-text-secondary mb-1">Prize Pool</div>
                    <div class="text-3xl font-bold text-solar">${{ number_format($hackathon->prize_pool, 0) }}</div>
                </div>
                <div class="solar-card p-6">
                    <div class="text-sm text-text-secondary mb-1">Entry Fee</div>
                    <div class="text-3xl font-bold text-text-primary">
                        @if ($hackathon->entry_fee == 0)
                            <span class="text-emerald-600">Free</span>
                        @else
                            ${{ number_format($hackathon->entry_fee, 2) }}
                        @endif
                    </div>
                </div>
                <div class="solar-card p-6">
                    <div class="text-sm text-text-secondary mb-1">Team Size</div>
                    <div class="text-3xl font-bold text-text-primary">Up to {{ $hackathon->team_limit }}</div>
                </div>
                <div class="solar-card p-6">
                    <div class="text-sm text-text-secondary mb-1">Participants</div>
                    <div class="text-3xl font-bold text-text-primary">{{ $hackathon->participants_count }}</div>
                    @if ($hackathon->max_participants)
                        <div class="text-xs text-text-secondary">of {{ $hackathon->max_participants }}</div>
                    @endif
                </div>
            </div>

            {{-- Content Sections --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Description --}}
                    <div class="bg-white rounded-2xl border border-border shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-4">About this Hackathon</h2>
                        <div class="prose prose-sm max-w-none text-text-secondary leading-relaxed">
                            {{ nl2br(e($hackathon->description)) }}
                        </div>
                    </div>

                    {{-- Tags --}}
                    @if ($hackathon->tags && count($hackathon->tags) > 0)
                    <div class="bg-white rounded-2xl border border-border shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-4">Topics</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($hackathon->tags as $tag)
                                <span class="px-4 py-2 rounded-full bg-solar-bg border border-solar-light text-sm font-medium text-text-primary">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Problem Statement --}}
                    @if ($hackathon->problem_statement_pdf)
                    <div class="bg-white rounded-2xl border border-border shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-4">Problem Statement</h2>
                        <a href="{{ route('hackathons.problem-statement', $hackathon) }}" class="inline-flex items-center gap-2 btn-solar px-6 py-3 rounded-xl font-semibold">
                            <i data-lucide="download" class="w-5 h-5"></i> Download PDF
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    {{-- Timeline --}}
                    <div class="bg-white rounded-2xl border border-border shadow-lg p-8 space-y-4">
                        <h3 class="text-xl font-bold text-text-primary mb-6">Timeline</h3>
                        
                        @if ($hackathon->registration_start)
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Registration Opens</p>
                                <p class="text-sm text-text-secondary">{{ $hackathon->registration_start->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        @if ($hackathon->registration_end)
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center shrink-0">
                                <i data-lucide="calendar" class="w-6 h-6 text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Registration Closes</p>
                                <p class="text-sm text-text-secondary">{{ $hackathon->registration_end->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        @if ($hackathon->hackathon_start)
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                                <i data-lucide="play-circle" class="w-6 h-6 text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Hackathon Starts</p>
                                <p class="text-sm text-text-secondary">{{ $hackathon->hackathon_start->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        @if ($hackathon->hackathon_end)
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center shrink-0">
                                <i data-lucide="stop-circle" class="w-6 h-6 text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-primary">Hackathon Ends</p>
                                <p class="text-sm text-text-secondary">{{ $hackathon->hackathon_end->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>
</x-layouts.app>
