{{-- How It Works Section --}}
<section id="how-it-works" class="relative py-24 sm:py-32 overflow-hidden">
    {{-- Background --}}
    <div class="blob w-[350px] h-[350px] bg-neon-purple/10 bottom-0 right-0 animate-float"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="reveal text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-neon-purple/20 bg-neon-purple/5 text-xs font-semibold uppercase tracking-widest text-neon-purple mb-4">
                <i data-lucide="map" class="w-3.5 h-3.5"></i>
                How It Works
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Four Steps to <span class="gradient-text">Victory</span>
            </h2>
            <p class="text-slate-400 text-lg">
                Getting started is easy. Follow these simple steps and start hacking!
            </p>
        </div>

        {{-- Steps --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $steps = [
                    ['num' => '01', 'icon' => 'user-plus', 'title' => 'Register', 'desc' => 'Create your free account with email or GitHub. Set up your developer profile and skills.'],
                    ['num' => '02', 'icon' => 'users-round', 'title' => 'Join / Create Team', 'desc' => 'Find teammates or create your own squad. Invite friends or match with skilled developers.'],
                    ['num' => '03', 'icon' => 'code-2', 'title' => 'Build Project', 'desc' => 'Hack away during the event! Use any tech stack, push code to GitHub, and build something amazing.'],
                    ['num' => '04', 'icon' => 'send', 'title' => 'Submit & Compete', 'desc' => 'Submit your project before the deadline. Present to judges and compete for prizes and glory!'],
                ];
            @endphp

            @foreach ($steps as $i => $step)
                <div class="reveal relative group" style="transition-delay: {{ $i * 150 }}ms;">
                    {{-- Connector Line (desktop only) --}}
                    @if (!$loop->last)
                        <div class="hidden lg:block absolute top-12 left-[calc(50%+2rem)] w-[calc(100%-4rem)] h-px bg-gradient-to-r from-neon-blue/30 to-neon-purple/30"></div>
                    @endif

                    <div class="text-center relative">
                        {{-- Step Number --}}
                        <div class="relative inline-flex items-center justify-center w-24 h-24 mb-6">
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 border border-white/5 group-hover:border-neon-purple/30 transition-all duration-500 rotate-6 group-hover:rotate-12"></div>
                            <div class="relative z-10 flex flex-col items-center">
                                <span class="text-xs font-bold text-neon-purple mb-1">STEP</span>
                                <span class="text-2xl font-black gradient-text">{{ $step['num'] }}</span>
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-dark-800 border border-white/5 flex items-center justify-center group-hover:border-neon-blue/30 group-hover:bg-neon-blue/5 transition-all duration-300">
                            <i data-lucide="{{ $step['icon'] }}" class="w-6 h-6 text-neon-blue"></i>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-slate-400 leading-relaxed max-w-xs mx-auto">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
