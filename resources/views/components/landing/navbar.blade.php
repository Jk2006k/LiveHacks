{{-- Navbar --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            {{-- Logo --}}
            <a href="/" id="nav-logo" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center shadow-lg shadow-neon-purple/20 group-hover:shadow-neon-purple/40 transition-shadow duration-300">
                    <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">
                    <span class="text-white">Live</span><span class="gradient-text">Hacks</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="/#hero" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Home</a>
                <a href="/#features" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Features</a>
                <a href="/#hackathons" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Hackathons</a>
                <a href="/#leaderboard" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Leaderboard</a>
                <a href="/contact" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Contact</a>
            </div>

            {{-- Auth Section --}}
            <div class="hidden md:flex items-center gap-3">
                @guest
                    {{-- Login & Register Buttons --}}
                    <a href="{{ route('login') }}" id="login-btn" class="px-5 py-2 text-sm font-medium text-slate-300 hover:text-white border border-white/10 hover:border-white/25 rounded-xl transition-all duration-300 hover:bg-white/5">
                        Login
                    </a>
                    <a href="{{ route('register') }}" id="register-btn" class="btn-shimmer px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 transition-all duration-300 hover:scale-105">
                        Register
                    </a>
                @endguest

                @auth
                    {{-- Profile Dropdown --}}
                    <div class="relative" id="profile-dropdown-container">
                        <button id="profile-dropdown-btn" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10 transition-all duration-300 group">
                            {{-- Avatar --}}
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-neon-purple/20 group-hover:shadow-neon-purple/40 transition-shadow duration-300">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-300 group-hover:text-white transition-colors">{{ Auth::user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 group-hover:text-slate-300 transition-all duration-300" id="dropdown-chevron"></i>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 rounded-xl glass-card border border-white/10 shadow-2xl shadow-black/40 py-2 animate-slide-down overflow-hidden">
                            {{-- User Info --}}
                            <div class="px-4 py-3 border-b border-white/5">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- Menu Items --}}
                            <div class="py-1">
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition-all duration-200">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-neon-blue"></i>
                                    Dashboard
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition-all duration-200">
                                    <i data-lucide="user-circle" class="w-4 h-4 text-neon-purple"></i>
                                    Profile
                                </a>
                            </div>

                            {{-- Logout --}}
                            <div class="border-t border-white/5 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/5 transition-all duration-200">
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-400 hover:text-white transition-colors" aria-label="Toggle navigation menu">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden flex-col glass border-t border-white/5 px-4 pb-4">
        <a href="/#hero" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Home</a>
        <a href="/#features" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Features</a>
        <a href="/#hackathons" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Hackathons</a>
        <a href="/#leaderboard" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Leaderboard</a>
        <a href="/contact" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Contact</a>

        @guest
            <div class="flex gap-3 pt-4">
                <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2.5 text-sm font-medium text-slate-300 border border-white/10 rounded-xl hover:bg-white/5 transition-all">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg">Register</a>
            </div>
        @endguest

        @auth
            <div class="pt-4 border-t border-white/5 mt-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="#" class="flex items-center gap-3 py-2.5 text-sm text-slate-300 hover:text-white transition-colors">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-neon-blue"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 py-2.5 text-sm text-slate-300 hover:text-white transition-colors">
                    <i data-lucide="user-circle" class="w-4 h-4 text-neon-purple"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 py-2.5 text-sm text-red-400 hover:text-red-300 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>

{{-- Navbar scroll effect --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('glass', 'shadow-lg', 'shadow-black/20');
            } else {
                navbar.classList.remove('glass', 'shadow-lg', 'shadow-black/20');
            }
        });

        // Profile dropdown toggle
        const dropdownBtn = document.getElementById('profile-dropdown-btn');
        const dropdownMenu = document.getElementById('profile-dropdown-menu');
        const chevron = document.getElementById('dropdown-chevron');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                if (chevron) {
                    chevron.style.transform = dropdownMenu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                const container = document.getElementById('profile-dropdown-container');
                if (container && !container.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    if (chevron) chevron.style.transform = 'rotate(0deg)';
                }
            });
        }
    });
</script>
