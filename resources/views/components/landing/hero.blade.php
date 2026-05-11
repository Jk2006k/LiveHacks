{{-- Hero Section --}}
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-18">
    {{-- Subtle Dot Pattern --}}
    <div class="absolute inset-0 dot-pattern"></div>

    {{-- Soft Gradient Orbs --}}
    <div class="absolute w-[500px] h-[500px] rounded-full bg-solar/5 blur-3xl top-[-100px] left-[-200px] animate-float-gentle"></div>
    <div class="absolute w-[400px] h-[400px] rounded-full bg-solar-light/40 blur-3xl bottom-[-100px] right-[-150px] animate-float-gentle" style="animation-delay: 3s;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <div class="animate-slide-down opacity-0 inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-solar-light bg-solar-bg text-sm text-solar font-medium mb-8">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-solar opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-solar"></span>
            </span>
            Season 3 Hackathons are Live
        </div>

        {{-- Headline --}}
        <h1 class="animate-slide-up opacity-0 text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black tracking-tight leading-[1.05] mb-6">
            <span class="text-text-primary">Build. </span>
            <span class="gradient-text">Compete.</span><br>
            <span class="text-text-primary">Innovate.</span>
        </h1>

        {{-- Subheadline --}}
        <p class="animate-slide-up opacity-0 delay-200 max-w-2xl mx-auto text-lg sm:text-xl text-text-secondary leading-relaxed mb-10">
            Join online hackathons, collaborate with teams, showcase your skills, and compete with developers worldwide.
        </p>

        {{-- CTA Buttons --}}
        <div class="animate-slide-up opacity-0 delay-400 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('dashboard') }}" id="explore-hackathons-btn" class="btn-solar group relative inline-flex items-center gap-2 px-8 py-4 text-base font-semibold rounded-2xl">
                <i data-lucide="rocket" class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-0.5"></i>
                Explore Hackathons
            </a>
            <a href="{{ route('hackathons.create') }}" id="host-hackathon-btn" class="btn-solar-outline group inline-flex items-center gap-2 px-8 py-4 text-base font-semibold rounded-2xl">
                <i data-lucide="plus-circle" class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90"></i>
                Host a Hackathon
            </a>
        </div>

        {{-- Floating Code Illustration --}}
        <div class="animate-slide-up opacity-0 delay-600 mt-16 max-w-3xl mx-auto">
            <div class="relative solar-card p-1 shadow-xl shadow-solar/5">
                <div class="bg-solar-bg rounded-[16px] overflow-hidden">
                    {{-- Terminal Header --}}
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-border">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        <span class="ml-3 text-xs text-text-secondary font-mono">livehacks-cli</span>
                    </div>
                    {{-- Terminal Content --}}
                    <div class="p-6 text-left font-mono text-sm leading-relaxed">
                        <p><span class="text-solar">$</span> <span class="text-text-primary">livehacks init --team "CodeCrafters"</span></p>
                        <p class="text-emerald-600 mt-1">✓ Team created successfully</p>
                        <p class="mt-3"><span class="text-solar">$</span> <span class="text-text-primary">livehacks join --hackathon "AI-Innovation-2026"</span></p>
                        <p class="text-solar mt-1">✓ Joined hackathon! 2,847 participants competing</p>
                        <p class="mt-3"><span class="text-solar">$</span> <span class="text-text-primary">livehacks submit --project ./my-app</span></p>
                        <p class="text-emerald-600 mt-1">🚀 Project submitted! Good luck!</p>
                        <span class="inline-block w-2 h-5 bg-solar animate-pulse ml-1"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trusted By --}}
        <div class="animate-fade-in opacity-0 delay-800 mt-16 flex flex-col items-center gap-4">
            <p class="text-xs uppercase tracking-widest text-text-secondary font-medium">Trusted by developers from</p>
            <div class="flex items-center gap-8 text-text-secondary/40">
                <span class="text-lg font-bold hover:text-text-secondary transition-colors cursor-default">Google</span>
                <span class="text-lg font-bold hover:text-text-secondary transition-colors cursor-default">Microsoft</span>
                <span class="text-lg font-bold hover:text-text-secondary transition-colors cursor-default">Meta</span>
                <span class="hidden sm:block text-lg font-bold hover:text-text-secondary transition-colors cursor-default">Amazon</span>
                <span class="hidden sm:block text-lg font-bold hover:text-text-secondary transition-colors cursor-default">GitHub</span>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <i data-lucide="chevron-down" class="w-6 h-6 text-text-secondary/40"></i>
    </div>
</section>
