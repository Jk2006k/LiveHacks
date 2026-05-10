<x-layouts.app title="Dashboard — LiveHacks">
    <x-landing.navbar />
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[600px] h-[600px] bg-neon-purple/5 -top-40 -right-40 animate-float-slow"></div>
        <div class="blob w-[400px] h-[400px] bg-neon-blue/5 bottom-20 -left-32 animate-pulse-glow"></div>
    </div>
    <main class="relative z-10 pt-24 pb-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Explore <span class="gradient-text">Hackathons</span></h1>
                    <p class="text-slate-400">Discover, join, and compete in hackathons worldwide.</p>
                </div>
                @auth
                <button onclick="window.location.href='{{ route('hackathons.create') }}'" class="btn-shimmer relative z-40 inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <i data-lucide="plus" class="w-4 h-4"></i> Host a Hackathon
                </button>
                @endauth
            </div>

            {{-- Search & Filters --}}
            <div class="glass-card rounded-2xl p-4 sm:p-6 mb-8">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-slate-500"></i>
                        </div>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search hackathons..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                    </div>
                    <select name="category" class="px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 transition-all duration-300 appearance-none cursor-pointer min-w-[180px]">
                        <option value="" class="bg-dark-900">All Categories</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ ($category ?? '') === $cat ? 'selected' : '' }} class="bg-dark-900">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="tab" value="{{ $tab ?? 'latest' }}">
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl hover:scale-105 transition-all duration-300 shrink-0">Search</button>
                </form>
            </div>

            {{-- Tabs --}}
            <div class="flex gap-2 mb-8 overflow-x-auto pb-2">
                @php $tabs = ['latest' => ['icon' => 'clock', 'label' => 'Latest'], 'trending' => ['icon' => 'trending-up', 'label' => 'Trending'], 'featured' => ['icon' => 'star', 'label' => 'Featured']]; @endphp
                @foreach ($tabs as $key => $tabInfo)
                <a href="{{ route('dashboard', array_merge(request()->query(), ['tab' => $key])) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 shrink-0 {{ ($tab ?? 'latest') === $key ? 'bg-gradient-to-r from-neon-blue to-neon-purple text-white shadow-lg shadow-neon-purple/20' : 'text-slate-400 hover:text-white border border-white/10 hover:border-white/20 hover:bg-white/5' }}">
                    <i data-lucide="{{ $tabInfo['icon'] }}" class="w-4 h-4"></i> {{ $tabInfo['label'] }}
                </a>
                @endforeach
            </div>

            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                <p class="text-emerald-400 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            @if ($hackathons->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($hackathons as $i => $hackathon)
                @php $colors = $hackathon->color_scheme; @endphp
                <div class="glass-card rounded-2xl overflow-hidden {{ $colors['border'] }} group" style="animation: slide-up 0.6s ease-out forwards; animation-delay: {{ $i * 100 }}ms; opacity: 0;">
                    @if ($hackathon->banner_image)
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ asset('storage/' . $hackathon->banner_image) }}" alt="{{ $hackathon->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-950/80 to-transparent"></div>
                    </div>
                    @else
                    <div class="h-2 bg-gradient-to-r {{ $colors['gradient'] }}"></div>
                    @endif
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full border {{ $colors['badge_color'] }}">{{ $hackathon->difficulty }}</span>
                            <span class="flex items-center gap-1 text-xs text-slate-500"><i data-lucide="users" class="w-3.5 h-3.5"></i> {{ number_format($hackathon->participants_count) }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1 group-hover:text-neon-blue transition-colors duration-300">{{ $hackathon->title }}</h3>
                        @if ($hackathon->tagline)
                        <p class="text-sm text-slate-400 mb-3 line-clamp-2">{{ $hackathon->tagline }}</p>
                        @endif
                        @if ($hackathon->tags && count($hackathon->tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach (array_slice($hackathon->tags, 0, 4) as $tag)
                            <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-white/5 text-slate-400 border border-white/5">{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-dark-950/50 border border-white/5 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-400/20 to-orange-500/20 flex items-center justify-center shrink-0">
                                <i data-lucide="gem" class="w-5 h-5 text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider">Prize Pool</p>
                                <p class="text-lg font-bold text-white">{{ $hackathon->formatted_prize }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4 text-xs text-slate-500">
                            <span class="flex items-center gap-1.5"><i data-lucide="user" class="w-3.5 h-3.5"></i> {{ $hackathon->host->name ?? 'Unknown' }}</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="users-2" class="w-3.5 h-3.5"></i> Max {{ $hackathon->team_limit }}/team</span>
                        </div>
                        @if ($hackathon->registration_end)
                        <div class="flex items-center gap-2 mb-5">
                            <i data-lucide="clock" class="w-4 h-4 text-neon-blue"></i>
                            <span class="text-sm text-slate-400">Reg. ends:</span>
                            <span class="text-sm font-semibold text-neon-blue countdown-digit" data-countdown="{{ $hackathon->registration_end->toIso8601String() }}">Loading...</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                @if ($hackathon->is_registration_open)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-400"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Registration Open</span>
                                @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-400"><span class="w-2 h-2 rounded-full bg-red-400"></span> Registration Closed</span>
                                @endif
                            </div>
                            <span class="text-xs font-semibold {{ $hackathon->entry_fee > 0 ? 'text-yellow-400' : 'text-emerald-400' }}">
                                {{ $hackathon->formatted_entry_fee }} Entry
                            </span>
                        </div>
                        <a href="{{ route('hackathons.show', $hackathon) }}" class="btn-shimmer block w-full py-3 px-6 text-sm font-semibold text-white text-center bg-gradient-to-r {{ $colors['gradient'] }} rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300 hover:scale-[1.02]">
                            View & Join
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($hackathons->hasPages())
            <div class="mt-12 flex justify-center">{{ $hackathons->links() }}</div>
            @endif
            @else
            {{-- Empty State --}}
            <div class="text-center py-24">
                <div class="glass-card rounded-3xl max-w-lg mx-auto p-12">
                    <div class="w-24 h-24 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 border border-white/10 flex items-center justify-center">
                        <i data-lucide="rocket" class="w-12 h-12 text-neon-purple opacity-60"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-3">No Hackathons Available Yet</h2>
                    <p class="text-slate-400 mb-8 max-w-sm mx-auto">Be the first to create a hackathon and bring the community together!</p>
                    @auth
                    <button onclick="window.location.href='{{ route('hackathons.create') }}'" class="btn-shimmer relative z-40 inline-flex items-center gap-2 px-8 py-3.5 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 transition-all duration-300 hover:scale-105 cursor-pointer">
                        <i data-lucide="plus" class="w-4 h-4"></i> Host a Hackathon
                    </button>
                    @else
                    <a href="{{ route('register') }}" class="btn-shimmer inline-flex items-center gap-2 px-8 py-3.5 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 transition-all duration-300 hover:scale-105">
                        <i data-lucide="user-plus" class="w-4 h-4"></i> Sign Up to Get Started
                    </a>
                    @endauth
                </div>
            </div>
            @endif
        </div>
    </main>
</x-layouts.app>
