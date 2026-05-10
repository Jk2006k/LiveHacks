{{-- Hackathon Showcase Section --}}
<section id="hackathons" class="relative py-24 sm:py-32 overflow-hidden">
    {{-- Background --}}
    <div class="blob w-[500px] h-[500px] bg-neon-blue/8 top-1/2 left-[-200px] animate-float-slow"></div>
    <div class="blob w-[300px] h-[300px] bg-neon-pink/8 bottom-0 right-[-100px] animate-float"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="reveal text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-neon-pink/20 bg-neon-pink/5 text-xs font-semibold uppercase tracking-widest text-neon-pink mb-4">
                <i data-lucide="flame" class="w-3.5 h-3.5"></i>
                Live Hackathons
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Trending <span class="gradient-text">Hackathons</span>
            </h2>
            <p class="text-slate-400 text-lg">
                Join the most exciting hackathons happening right now. Limited slots available!
            </p>
        </div>

        {{-- Hackathon Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $hackathons = [
                    [
                        'title' => 'AI Innovation Challenge 2026',
                        'prize' => '$25,000',
                        'participants' => '2,847',
                        'deadline' => '2026-06-15T23:59:59',
                        'tags' => ['AI/ML', 'Python', 'TensorFlow'],
                        'difficulty' => 'Advanced',
                        'gradient' => 'from-blue-500/20 to-cyan-500/20',
                        'border' => 'hover:border-blue-400/30',
                        'badge_color' => 'text-blue-400 border-blue-400/20 bg-blue-400/5',
                    ],
                    [
                        'title' => 'Web3 DeFi Buildathon',
                        'prize' => '$50,000',
                        'participants' => '1,523',
                        'deadline' => '2026-07-01T23:59:59',
                        'tags' => ['Blockchain', 'Solidity', 'React'],
                        'difficulty' => 'Intermediate',
                        'gradient' => 'from-purple-500/20 to-pink-500/20',
                        'border' => 'hover:border-purple-400/30',
                        'badge_color' => 'text-purple-400 border-purple-400/20 bg-purple-400/5',
                    ],
                    [
                        'title' => 'Green Tech Sustainability Hack',
                        'prize' => '$15,000',
                        'participants' => '964',
                        'deadline' => '2026-06-20T23:59:59',
                        'tags' => ['IoT', 'CleanTech', 'APIs'],
                        'difficulty' => 'Beginner Friendly',
                        'gradient' => 'from-emerald-500/20 to-teal-500/20',
                        'border' => 'hover:border-emerald-400/30',
                        'badge_color' => 'text-emerald-400 border-emerald-400/20 bg-emerald-400/5',
                    ],
                ];
            @endphp

            @foreach ($hackathons as $i => $hack)
                <div class="reveal glass-card rounded-2xl overflow-hidden {{ $hack['border'] }}" style="transition-delay: {{ $i * 150 }}ms;">
                    {{-- Card Top Gradient Bar --}}
                    <div class="h-1 bg-gradient-to-r {{ $hack['gradient'] }}"></div>

                    <div class="p-6 sm:p-8">
                        {{-- Difficulty Badge --}}
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full border {{ $hack['badge_color'] }}">
                                {{ $hack['difficulty'] }}
                            </span>
                            <span class="flex items-center gap-1 text-xs text-slate-500">
                                <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                {{ $hack['participants'] }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-xl font-bold text-white mb-3">{{ $hack['title'] }}</h3>

                        {{-- Tags --}}
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach ($hack['tags'] as $tag)
                                <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-white/5 text-slate-400 border border-white/5">{{ $tag }}</span>
                            @endforeach
                        </div>

                        {{-- Prize Pool --}}
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-dark-950/50 border border-white/5 mb-5">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-400/20 to-orange-500/20 flex items-center justify-center">
                                <i data-lucide="gem" class="w-5 h-5 text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider">Prize Pool</p>
                                <p class="text-lg font-bold text-white">{{ $hack['prize'] }}</p>
                            </div>
                        </div>

                        {{-- Countdown --}}
                        <div class="flex items-center gap-2 mb-6">
                            <i data-lucide="clock" class="w-4 h-4 text-neon-blue"></i>
                            <span class="text-sm text-slate-400">Ends in:</span>
                            <span class="text-sm font-semibold text-neon-blue countdown-digit" data-countdown="{{ $hack['deadline'] }}">Loading...</span>
                        </div>

                        {{-- Join Button --}}
                        <button class="btn-shimmer w-full py-3 px-6 text-sm font-semibold text-white bg-gradient-to-r {{ $hack['gradient'] }} rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300 hover:scale-[1.02] cursor-pointer">
                            Join Hackathon
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View All --}}
        <div class="reveal text-center mt-12">
            <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-neon-blue hover:text-neon-purple transition-colors group">
                View All Hackathons
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>
