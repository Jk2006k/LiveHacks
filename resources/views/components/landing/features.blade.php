{{-- Features Section --}}
<section id="features" class="relative py-24 sm:py-32 overflow-hidden">
    {{-- Background blob --}}
    <div class="blob w-[400px] h-[400px] bg-neon-blue/10 top-0 left-1/2 -translate-x-1/2 animate-float-slow"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="reveal text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-neon-blue/20 bg-neon-blue/5 text-xs font-semibold uppercase tracking-widest text-neon-blue mb-4">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                Features
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Everything You Need to <span class="gradient-text">Hack & Win</span>
            </h2>
            <p class="text-slate-400 text-lg">
                Powerful tools designed to make your hackathon experience seamless, from team building to project submission.
            </p>
        </div>

        {{-- Feature Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $features = [
                    ['icon' => 'users', 'title' => 'Team Collaboration', 'desc' => 'Form teams, invite members, share code in real-time, and collaborate seamlessly with built-in communication tools.', 'color' => 'neon-blue'],
                    ['icon' => 'trophy', 'title' => 'Real-Time Leaderboards', 'desc' => 'Watch rankings update live as judges evaluate projects. Track your team\'s position and compete for the top spot.', 'color' => 'neon-purple'],
                    ['icon' => 'upload-cloud', 'title' => 'Project Submission', 'desc' => 'Submit your projects with GitHub integration, live demo links, and comprehensive documentation support.', 'color' => 'neon-pink'],
                    ['icon' => 'clipboard-check', 'title' => 'Judge Evaluation', 'desc' => 'Professional judges evaluate projects with detailed scoring rubrics, providing constructive feedback.', 'color' => 'neon-blue'],
                    ['icon' => 'award', 'title' => 'Certificates & Rewards', 'desc' => 'Earn verified certificates, win cash prizes, and unlock exclusive rewards for your achievements.', 'color' => 'neon-purple'],
                    ['icon' => 'bell-ring', 'title' => 'Live Notifications', 'desc' => 'Stay updated with real-time notifications for deadlines, announcements, team updates, and results.', 'color' => 'neon-pink'],
                ];
            @endphp

            @foreach ($features as $i => $feature)
                <div class="reveal group glass-card rounded-2xl p-6 sm:p-8" style="transition-delay: {{ $i * 100 }}ms;">
                    {{-- Icon --}}
                    <div class="w-12 h-12 rounded-xl bg-{{ $feature['color'] }}/10 border border-{{ $feature['color'] }}/20 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6 text-{{ $feature['color'] }}"></i>
                    </div>
                    {{-- Content --}}
                    <h3 class="text-lg font-semibold text-white mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
