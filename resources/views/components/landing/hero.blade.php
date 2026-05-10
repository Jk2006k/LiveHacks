{{-- Hero Section --}}
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-18">
    {{-- Animated Background Blobs --}}
    <div class="blob w-[500px] h-[500px] bg-neon-blue/20 top-[-100px] left-[-200px] animate-blob animate-float-slow"></div>
    <div class="blob w-[600px] h-[600px] bg-neon-purple/15 bottom-[-150px] right-[-200px] animate-blob animate-float" style="animation-delay: 2s;"></div>
    <div class="blob w-[300px] h-[300px] bg-neon-pink/10 top-1/3 right-1/4 animate-blob animate-pulse-glow" style="animation-delay: 4s;"></div>

    {{-- Grid Pattern Overlay --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 40px 40px;"></div>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-dark-950/50 to-dark-950"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <div class="animate-slide-down opacity-0 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-neon-purple/30 bg-neon-purple/10 text-sm text-neon-purple mb-8">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-neon-purple opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-neon-purple"></span>
            </span>
            Season 3 Hackathons are Live
        </div>

        {{-- Headline --}}
        <h1 class="animate-slide-up opacity-0 text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black tracking-tight leading-[1.05] mb-6">
            <span class="text-white">Build. </span>
            <span class="gradient-text">Compete.</span><br>
            <span class="text-white">Innovate.</span>
        </h1>

        {{-- Subheadline --}}
        <p class="animate-slide-up opacity-0 delay-200 max-w-2xl mx-auto text-lg sm:text-xl text-slate-400 leading-relaxed mb-10">
            Join online hackathons, collaborate with teams, showcase your skills, and compete with developers worldwide.
        </p>

        {{-- CTA Buttons --}}
        <div class="animate-slide-up opacity-0 delay-400 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#hackathons" id="explore-hackathons-btn" class="btn-shimmer group relative inline-flex items-center gap-2 px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-2xl shadow-xl shadow-neon-purple/25 hover:shadow-neon-purple/50 transition-all duration-300 hover:scale-105">
                <i data-lucide="rocket" class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-0.5"></i>
                Explore Hackathons
            </a>
            <a href="#" id="host-hackathon-btn" class="group inline-flex items-center gap-2 px-8 py-4 text-base font-semibold text-slate-300 hover:text-white border border-white/15 hover:border-white/30 rounded-2xl transition-all duration-300 hover:bg-white/5 hover:scale-105">
                <i data-lucide="plus-circle" class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90"></i>
                Host a Hackathon
            </a>
        </div>

        {{-- Floating Code Illustration --}}
        <div class="animate-slide-up opacity-0 delay-600 mt-16 max-w-3xl mx-auto">
            <div class="relative glass-card rounded-2xl p-1 glow-purple">
                <div class="bg-dark-900 rounded-xl overflow-hidden">
                    {{-- Terminal Header --}}
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-white/5">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                        <span class="ml-3 text-xs text-slate-500 font-mono">livehacks-cli</span>
                    </div>
                    {{-- Terminal Content --}}
                    <div class="p-6 text-left font-mono text-sm leading-relaxed">
                        <p><span class="text-green-400">$</span> <span class="text-slate-300">livehacks init --team "CodeCrafters"</span></p>
                        <p class="text-neon-blue mt-1">✓ Team created successfully</p>
                        <p class="mt-3"><span class="text-green-400">$</span> <span class="text-slate-300">livehacks join --hackathon "AI-Innovation-2026"</span></p>
                        <p class="text-neon-purple mt-1">✓ Joined hackathon! 2,847 participants competing</p>
                        <p class="mt-3"><span class="text-green-400">$</span> <span class="text-slate-300">livehacks submit --project ./my-app</span></p>
                        <p class="text-green-400 mt-1">🚀 Project submitted! Good luck!</p>
                        <span class="inline-block w-2 h-5 bg-neon-blue animate-pulse ml-1"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trusted By --}}
        <div class="animate-fade-in opacity-0 delay-800 mt-16 flex flex-col items-center gap-4">
            <p class="text-xs uppercase tracking-widest text-slate-500 font-medium">Trusted by developers from</p>
            <div class="flex items-center gap-8 text-slate-500">
                <span class="text-lg font-bold hover:text-slate-300 transition-colors cursor-default">Google</span>
                <span class="text-lg font-bold hover:text-slate-300 transition-colors cursor-default">Microsoft</span>
                <span class="text-lg font-bold hover:text-slate-300 transition-colors cursor-default">Meta</span>
                <span class="hidden sm:block text-lg font-bold hover:text-slate-300 transition-colors cursor-default">Amazon</span>
                <span class="hidden sm:block text-lg font-bold hover:text-slate-300 transition-colors cursor-default">GitHub</span>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <i data-lucide="chevron-down" class="w-6 h-6 text-slate-500"></i>
    </div>
</section>
