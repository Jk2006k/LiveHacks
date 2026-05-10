{{-- Testimonials Section --}}
<section id="testimonials" class="relative py-24 sm:py-32 overflow-hidden">
    {{-- Background --}}
    <div class="blob w-[400px] h-[400px] bg-neon-blue/8 top-0 right-[-150px] animate-float"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="reveal text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-green-400/20 bg-green-400/5 text-xs font-semibold uppercase tracking-widest text-green-400 mb-4">
                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                Testimonials
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Loved by <span class="gradient-text">Developers</span>
            </h2>
            <p class="text-slate-400 text-lg">
                Hear from the hackers and innovators who have built amazing things on LiveHacks.
            </p>
        </div>

        {{-- Testimonial Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $testimonials = [
                    [
                        'name' => 'Priya Sharma',
                        'role' => 'Full Stack Developer',
                        'company' => 'Google',
                        'quote' => 'LiveHacks completely changed how I approach hackathons. The real-time collaboration tools and seamless project submission made our team win first place!',
                        'avatar' => 'PS',
                        'rating' => 5,
                        'gradient' => 'from-blue-500 to-cyan-400',
                    ],
                    [
                        'name' => 'Alex Chen',
                        'role' => 'ML Engineer',
                        'company' => 'OpenAI',
                        'quote' => 'The platform is incredible. Built an AI project during a 48-hour hackathon and the judge evaluation system gave us actionable feedback. Won $10k!',
                        'avatar' => 'AC',
                        'rating' => 5,
                        'gradient' => 'from-purple-500 to-pink-400',
                    ],
                    [
                        'name' => 'Sarah Johnson',
                        'role' => 'CS Student',
                        'company' => 'MIT',
                        'quote' => 'As a student, LiveHacks gave me real-world experience and helped me connect with amazing developers. The certificates I earned helped me land my first internship!',
                        'avatar' => 'SJ',
                        'rating' => 5,
                        'gradient' => 'from-emerald-500 to-teal-400',
                    ],
                ];
            @endphp

            @foreach ($testimonials as $i => $t)
                <div class="reveal glass-card rounded-2xl p-6 sm:p-8 flex flex-col" style="transition-delay: {{ $i * 150 }}ms;">
                    {{-- Stars --}}
                    <div class="flex gap-1 mb-4">
                        @for ($s = 0; $s < $t['rating']; $s++)
                            <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-yellow-400"></i>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <blockquote class="text-slate-300 text-sm leading-relaxed mb-6 flex-1">
                        "{{ $t['quote'] }}"
                    </blockquote>

                    {{-- Author --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $t['gradient'] }} flex items-center justify-center text-sm font-bold text-white shadow-lg">
                            {{ $t['avatar'] }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $t['name'] }}</p>
                            <p class="text-xs text-slate-500">{{ $t['role'] }} · {{ $t['company'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
