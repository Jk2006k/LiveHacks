{{-- Statistics Section --}}
<section id="leaderboard" class="relative py-24 sm:py-32 overflow-hidden">
    {{-- Gradient divider top --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-neon-purple/30 to-transparent"></div>

    {{-- Background --}}
    <div class="blob w-[400px] h-[400px] bg-neon-purple/10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animate-pulse-glow"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="reveal text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-yellow-400/20 bg-yellow-400/5 text-xs font-semibold uppercase tracking-widest text-yellow-400 mb-4">
                <i data-lucide="bar-chart-3" class="w-3.5 h-3.5"></i>
                Platform Stats
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Our Growing <span class="gradient-text">Community</span>
            </h2>
            <p class="text-slate-400 text-lg">
                Join thousands of developers who are building the future, one hackathon at a time.
            </p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stats = [
                    ['value' => 50000, 'suffix' => '+', 'label' => 'Total Participants', 'icon' => 'users', 'color' => 'neon-blue'],
                    ['value' => 120, 'suffix' => '+', 'label' => 'Active Hackathons', 'icon' => 'code-2', 'color' => 'neon-purple'],
                    ['value' => 8500, 'suffix' => '+', 'label' => 'Projects Submitted', 'icon' => 'folder-git-2', 'color' => 'neon-pink'],
                    ['value' => 3200, 'suffix' => '+', 'label' => 'Winning Teams', 'icon' => 'trophy', 'color' => 'yellow-400'],
                ];
            @endphp

            @foreach ($stats as $i => $stat)
                <div class="reveal glass-card rounded-2xl p-6 sm:p-8 text-center group" style="transition-delay: {{ $i * 100 }}ms;">
                    {{-- Icon --}}
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-{{ $stat['color'] }}/10 border border-{{ $stat['color'] }}/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-7 h-7 text-{{ $stat['color'] }}"></i>
                    </div>
                    {{-- Value --}}
                    <div class="text-3xl sm:text-4xl font-black text-white mb-2">
                        <span data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</span>
                    </div>
                    {{-- Label --}}
                    <p class="text-sm text-slate-400 font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Gradient divider bottom --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-neon-blue/30 to-transparent"></div>
</section>
