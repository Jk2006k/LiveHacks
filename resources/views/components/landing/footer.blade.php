{{-- Footer --}}
<footer id="contact" class="relative pt-20 pb-8 overflow-hidden">
    {{-- Top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <a href="#" class="flex items-center gap-2 mb-4 group">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center shadow-lg shadow-neon-purple/20">
                        <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight">
                        <span class="text-white">Live</span><span class="gradient-text">Hacks</span>
                    </span>
                </a>
                <p class="text-sm text-slate-500 leading-relaxed mb-6 max-w-xs">
                    The ultimate online hackathon platform. Build, compete, and innovate with developers worldwide.
                </p>
                {{-- Social Links --}}
                <div class="flex items-center gap-3">
                    @php $socials = ['twitter', 'github', 'linkedin', 'youtube']; @endphp
                    @foreach ($socials as $social)
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 border border-white/5 hover:border-neon-purple/30 hover:bg-neon-purple/10 flex items-center justify-center text-slate-500 hover:text-neon-purple transition-all duration-300" aria-label="{{ ucfirst($social) }}">
                            <i data-lucide="{{ $social }}" class="w-4 h-4"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Platform</h4>
                <ul class="space-y-3">
                    @php $platformLinks = ['Browse Hackathons', 'Host an Event', 'Leaderboards', 'Prizes & Rewards', 'For Judges']; @endphp
                    @foreach ($platformLinks as $link)
                        <li><a href="#" class="text-sm text-slate-500 hover:text-white transition-colors duration-200">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Resources</h4>
                <ul class="space-y-3">
                    @php $resourceLinks = ['Documentation', 'API Reference', 'Blog', 'Community', 'Help Center']; @endphp
                    @foreach ($resourceLinks as $link)
                        <li><a href="#" class="text-sm text-slate-500 hover:text-white transition-colors duration-200">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Company</h4>
                <ul class="space-y-3">
                    @php $companyLinks = ['About Us', 'Careers', 'Privacy Policy', 'Terms of Service', 'Contact Us']; @endphp
                    @foreach ($companyLinks as $link)
                        <li><a href="#" class="text-sm text-slate-500 hover:text-white transition-colors duration-200">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Newsletter --}}
        <div class="reveal glass-card rounded-2xl p-6 sm:p-8 mb-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h4 class="text-lg font-semibold text-white mb-1">Stay in the loop</h4>
                    <p class="text-sm text-slate-400">Get notified about upcoming hackathons and platform updates.</p>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <input type="email" placeholder="your@email.com" class="flex-1 md:w-64 px-4 py-3 text-sm bg-dark-950/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/20 transition-all">
                    <button class="btn-shimmer px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl hover:shadow-lg hover:shadow-neon-purple/25 transition-all duration-300 cursor-pointer whitespace-nowrap">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-white/5">
            <p class="text-xs text-slate-600">
                &copy; {{ date('Y') }} LiveHacks. All rights reserved.
            </p>
            <div class="flex items-center gap-1 text-xs text-slate-600">
                Built with
                <i data-lucide="heart" class="w-3 h-3 text-red-500 fill-red-500 mx-0.5"></i>
                for developers worldwide
            </div>
        </div>
    </div>
</footer>
