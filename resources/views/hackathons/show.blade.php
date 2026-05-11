<x-layouts.app title="{{ $hackathon->title }} — LiveHacks">
    <x-landing.navbar />

    {{-- Background --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[800px] h-[800px] bg-neon-purple/5 -top-40 -right-20 animate-float-slow"></div>
        <div class="blob w-[600px] h-[600px] bg-neon-blue/5 bottom-0 -left-20 animate-pulse-glow"></div>
    </div>

    @php $colors = $hackathon->color_scheme; @endphp

    <main class="relative z-10 pt-24 pb-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Link --}}
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors mb-6">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Dashboard
            </a>

            {{-- Flash Messages --}}
            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
            </div>
            @endif
            @if (session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 shrink-0"></i>
                <p class="text-red-400 text-sm font-medium">{{ session('error') }}</p>
            </div>
            @endif

            {{-- ═══════════════════════════════════════════════
                 SINGLE UNIFIED CARD
                 ═══════════════════════════════════════════════ --}}
            <div class="glass-card rounded-3xl overflow-hidden">

                {{-- Banner --}}
                @if ($hackathon->banner_image)
                <div class="relative h-64 sm:h-80">
                    <img src="{{ asset('storage/' . $hackathon->banner_image) }}" alt="{{ $hackathon->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[rgba(3,7,18,1)] via-[rgba(3,7,18,0.5)] to-transparent"></div>
                </div>
                @else
                <div class="h-3 bg-gradient-to-r {{ $colors['gradient'] }}"></div>
                @endif

                {{-- Content Body --}}
                <div class="p-8 sm:p-10 lg:p-12 space-y-10">

                    {{-- ── Header ──────────────────────────── --}}
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 {{ $hackathon->banner_image ? '-mt-24 relative z-10' : '' }}">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="text-xs font-bold px-3 py-1 rounded-full border {{ $colors['badge_color'] }} uppercase tracking-wider">{{ $hackathon->difficulty }}</span>
                                <span class="text-xs font-bold px-3 py-1 rounded-full border border-white/10 bg-white/5 text-slate-300 uppercase tracking-wider">{{ $hackathon->category }}</span>
                                @if ($hackathon->is_registration_open)
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-emerald-500/20 bg-emerald-500/10 text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Open
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-red-500/20 bg-red-500/10 text-red-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Closed
                                </span>
                                @endif
                            </div>
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-2">{{ $hackathon->title }}</h1>
                            @if ($hackathon->tagline)
                            <p class="text-lg text-slate-300">{{ $hackathon->tagline }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 shrink-0">
                            <div class="text-center px-5 py-3 rounded-2xl bg-dark-950/50 border border-white/5">
                                <span class="block text-2xl font-black text-white">{{ number_format($hackathon->participants_count) }}</span>
                                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Joined</span>
                            </div>
                        </div>
                    </div>

                    {{-- ── Key Stats Row ───────────────────── --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        {{-- Entry Fee --}}
                        <div class="p-5 rounded-2xl bg-dark-950/40 border border-white/5 text-center">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Entry Fee</p>
                            @if ($hackathon->entry_fee > 0)
                            <p class="text-2xl font-black text-white">${{ number_format($hackathon->entry_fee, 0) }}</p>
                            @else
                            <p class="text-2xl font-black text-emerald-400">FREE</p>
                            @endif
                        </div>
                        {{-- Prize Pool --}}
                        <div class="p-5 rounded-2xl bg-dark-950/40 border border-white/5 text-center">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Prize Pool</p>
                            <p class="text-2xl font-black text-yellow-400">{{ $hackathon->formatted_prize }}</p>
                        </div>
                        {{-- Team Size --}}
                        <div class="p-5 rounded-2xl bg-dark-950/40 border border-white/5 text-center">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Team Size</p>
                            <p class="text-2xl font-black text-white">{{ $hackathon->team_limit }}</p>
                        </div>
                        {{-- Max Participants --}}
                        <div class="p-5 rounded-2xl bg-dark-950/40 border border-white/5 text-center">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Max Slots</p>
                            <p class="text-2xl font-black text-white">{{ $hackathon->max_participants ? number_format($hackathon->max_participants) : '∞' }}</p>
                        </div>
                    </div>

                    {{-- ── Description ─────────────────────── --}}
                    @if ($hackathon->description)
                    <div>
                        <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-neon-blue"></i> About
                        </h2>
                        <p class="text-slate-300 leading-relaxed whitespace-pre-line">{{ $hackathon->description }}</p>
                    </div>
                    @endif

                    {{-- ── Technologies ─────────────────────── --}}
                    @if ($hackathon->tags && count($hackathon->tags) > 0)
                    <div>
                        <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="code" class="w-5 h-5 text-neon-purple"></i> Technologies
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($hackathon->tags as $tag)
                            <span class="text-sm font-medium px-4 py-2 rounded-xl bg-white/5 text-slate-200 border border-white/10">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- ── Schedule ─────────────────────────── --}}
                    <div>
                        <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="calendar" class="w-5 h-5 text-neon-pink"></i> Schedule
                        </h2>

                        @php
                            $now = now();
                            $regStarted = $hackathon->registration_start && $now->gte($hackathon->registration_start);
                            $regEnded = $hackathon->registration_end && $now->gte($hackathon->registration_end);
                            $hackStarted = $hackathon->hackathon_start && $now->gte($hackathon->hackathon_start);
                            $hackEnded = $hackathon->hackathon_end && $now->gte($hackathon->hackathon_end);
                        @endphp

                        {{-- Live Status Banner --}}
                        @if ($hackStarted && !$hackEnded)
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 mb-4 animate-pulse-glow">
                            <span class="relative flex h-4 w-4 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500"></span>
                            </span>
                            <div>
                                <p class="text-emerald-400 font-bold text-sm">Hackathon is LIVE!</p>
                                @if ($hackathon->hackathon_end)
                                <p class="text-emerald-400/70 text-xs">Ends: {{ $hackathon->hackathon_end->format('M d, Y · h:i A') }}</p>
                                @endif
                            </div>
                        </div>
                        @elseif ($hackEnded)
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-500/10 border border-slate-500/20 mb-4">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-slate-400 shrink-0"></i>
                            <p class="text-slate-400 font-bold text-sm">Hackathon has ended</p>
                        </div>
                        @elseif ($hackathon->hackathon_start)
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-neon-blue/10 border border-neon-blue/20 mb-4">
                            <i data-lucide="clock" class="w-5 h-5 text-neon-blue shrink-0"></i>
                            <div>
                                <p class="text-neon-blue font-bold text-sm">Hackathon starts soon</p>
                                <p class="text-neon-blue/70 text-xs countdown-digit" data-countdown="{{ $hackathon->hackathon_start->toIso8601String() }}">Loading...</p>
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @if ($hackathon->registration_start)
                            <div class="flex items-center gap-3 p-4 rounded-xl bg-dark-950/40 border {{ $regStarted ? 'border-emerald-500/20' : 'border-white/5' }}">
                                <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center shrink-0">
                                    <i data-lucide="user-plus" class="w-5 h-5 text-emerald-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Reg. Opens</p>
                                        @if ($regStarted)
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/15 text-emerald-400">✓ Started</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-bold text-white">{{ $hackathon->registration_start->format('M d, Y · h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                            @if ($hackathon->registration_end)
                            <div class="flex items-center gap-3 p-4 rounded-xl bg-dark-950/40 border {{ $regEnded ? 'border-red-500/20' : 'border-white/5' }}">
                                <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center shrink-0">
                                    <i data-lucide="user-minus" class="w-5 h-5 text-red-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Reg. Closes</p>
                                        @if ($regEnded)
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-red-500/15 text-red-400">Closed</span>
                                        @elseif ($regStarted)
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-yellow-500/15 text-yellow-400">Open</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-bold text-white">{{ $hackathon->registration_end->format('M d, Y · h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                            @if ($hackathon->hackathon_start)
                            <div class="flex items-center gap-3 p-4 rounded-xl bg-dark-950/40 border {{ $hackStarted && !$hackEnded ? 'border-emerald-500/20 ring-1 ring-emerald-500/10' : ($hackStarted ? 'border-slate-500/20' : 'border-white/5') }}">
                                <div class="w-10 h-10 rounded-lg {{ $hackStarted && !$hackEnded ? 'bg-emerald-500/10' : 'bg-neon-blue/10' }} flex items-center justify-center shrink-0">
                                    <i data-lucide="play" class="w-5 h-5 {{ $hackStarted && !$hackEnded ? 'text-emerald-400' : 'text-neon-blue' }}"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Starts</p>
                                        @if ($hackStarted && !$hackEnded)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/15 text-emerald-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> LIVE
                                        </span>
                                        @elseif ($hackEnded)
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-500/15 text-slate-400">Done</span>
                                        @else
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-neon-blue/15 text-neon-blue">Upcoming</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-bold text-white">{{ $hackathon->hackathon_start->format('M d, Y · h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                            @if ($hackathon->hackathon_end)
                            <div class="flex items-center gap-3 p-4 rounded-xl bg-dark-950/40 border {{ $hackEnded ? 'border-slate-500/20' : 'border-white/5' }}">
                                <div class="w-10 h-10 rounded-lg bg-neon-purple/10 flex items-center justify-center shrink-0">
                                    <i data-lucide="flag" class="w-5 h-5 text-neon-purple"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Ends</p>
                                        @if ($hackEnded)
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-500/15 text-slate-400">Ended</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-bold text-white">{{ $hackathon->hackathon_end->format('M d, Y · h:i A') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── Hosted By ────────────────────────── --}}
                    <div class="flex items-center gap-4 p-5 rounded-2xl bg-dark-950/40 border border-white/5">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-neon-purple/20 shrink-0">
                            {{ strtoupper(substr($hackathon->host->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Hosted By</p>
                            <p class="text-lg font-bold text-white">{{ $hackathon->host->name ?? 'Unknown' }}</p>
                        </div>
                    </div>

                    {{-- ── Divider ──────────────────────────── --}}
                    <div class="border-t border-white/5"></div>

                    {{-- ── Join / Payment Section ──────────── --}}
                    @auth
                        @if ($hasJoined)
                        <div class="text-center py-6">
                            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-500/15 flex items-center justify-center mb-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-emerald-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-emerald-400 mb-1">You're Registered!</h3>
                            <p class="text-slate-400 mb-6">You have already joined this hackathon. Good luck!</p>
                            <a href="{{ route('hackathons.workspace', $hackathon) }}"
                               class="btn-shimmer inline-flex items-center gap-2 px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-2xl shadow-xl shadow-neon-purple/20 hover:shadow-neon-purple/40 hover:scale-[1.02] transition-all duration-300">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Go to Workspace
                            </a>
                        </div>
                        @elseif ($hackathon->is_registration_open)
                        <div>
                            <h2 class="text-xl font-bold text-white mb-6 text-center">
                                @if ($hackathon->entry_fee > 0)
                                    Pay <span class="gradient-text">${{ number_format($hackathon->entry_fee, 0) }}</span> to Join
                                @else
                                    Ready to Join?
                                @endif
                            </h2>

                            <form method="POST" action="{{ route('hackathons.join', $hackathon) }}" id="join-form">
                                @csrf

                                @if ($hackathon->entry_fee > 0)
                                <div class="max-w-md mx-auto space-y-4 mb-8">
                                    <div class="grid grid-cols-1 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1.5">Cardholder Name</label>
                                            <input type="text" id="card_name" placeholder="John Doe" required
                                                class="w-full px-4 py-3 rounded-xl bg-dark-950/60 border border-white/10 text-white placeholder-slate-600 text-sm focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/30 outline-none transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1.5">Card Number</label>
                                            <input type="text" id="card_number" placeholder="4242 4242 4242 4242" required maxlength="19"
                                                class="w-full px-4 py-3 rounded-xl bg-dark-950/60 border border-white/10 text-white placeholder-slate-600 text-sm focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/30 outline-none transition-all tracking-wider">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1.5">Expiry</label>
                                                <input type="text" id="card_expiry" placeholder="MM/YY" required maxlength="5"
                                                    class="w-full px-4 py-3 rounded-xl bg-dark-950/60 border border-white/10 text-white placeholder-slate-600 text-sm focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/30 outline-none transition-all">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1.5">CVC</label>
                                                <input type="text" id="card_cvc" placeholder="123" required maxlength="4"
                                                    class="w-full px-4 py-3 rounded-xl bg-dark-950/60 border border-white/10 text-white placeholder-slate-600 text-sm focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/30 outline-none transition-all">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500 pt-1">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400"></i> Secured with 256-bit SSL encryption
                                    </div>
                                </div>
                                @endif

                                <div class="max-w-md mx-auto">
                                    @if ($hackathon->entry_fee > 0)
                                    <button type="submit" class="btn-shimmer w-full py-4 px-6 text-base font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-2xl shadow-xl shadow-neon-purple/20 hover:shadow-neon-purple/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 cursor-pointer">
                                        Pay ${{ number_format($hackathon->entry_fee, 0) }} & Join Hackathon
                                    </button>
                                    @else
                                    <button type="submit" class="btn-shimmer w-full py-4 px-6 text-base font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl shadow-xl shadow-emerald-500/20 hover:shadow-emerald-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 cursor-pointer">
                                        Join Hackathon — Free
                                    </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="text-center py-6">
                            <div class="w-16 h-16 mx-auto rounded-full bg-red-500/15 flex items-center justify-center mb-4">
                                <i data-lucide="lock" class="w-8 h-8 text-red-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-red-400 mb-1">Registration Closed</h3>
                            <p class="text-slate-400">This hackathon is no longer accepting new participants.</p>
                        </div>
                        @endif
                    @else
                    <div class="text-center py-6">
                        <p class="text-slate-400 mb-4">You need to be logged in to join this hackathon.</p>
                        <a href="{{ route('login') }}" class="btn-shimmer inline-flex items-center gap-2 px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-2xl shadow-xl shadow-neon-purple/20 hover:shadow-neon-purple/40 hover:scale-[1.02] transition-all duration-300">
                            <i data-lucide="log-in" class="w-5 h-5"></i> Login to Join
                        </a>
                    </div>
                    @endauth

                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cardInput = document.getElementById('card_number');
            if (cardInput) {
                cardInput.addEventListener('input', (e) => {
                    let val = e.target.value.replace(/\D/g, '').substring(0, 16);
                    e.target.value = val.replace(/(.{4})/g, '$1 ').trim();
                });
            }
            const expiryInput = document.getElementById('card_expiry');
            if (expiryInput) {
                expiryInput.addEventListener('input', (e) => {
                    let val = e.target.value.replace(/\D/g, '').substring(0, 4);
                    if (val.length > 2) val = val.substring(0, 2) + '/' + val.substring(2);
                    e.target.value = val;
                });
            }
        });
    </script>
</x-layouts.app>
