{{-- Navbar --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            {{-- Logo --}}
            <a href="/" id="nav-logo" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-solar to-solar-hover flex items-center justify-center shadow-md shadow-solar/20 group-hover:shadow-solar/30 transition-shadow duration-300">
                    <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">
                    <span class="text-text-primary">Live</span><span class="gradient-text">Hacks</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="/#hero" class="nav-link text-sm font-medium text-text-secondary hover:text-text-primary transition-colors">Home</a>
                <a href="/#features" class="nav-link text-sm font-medium text-text-secondary hover:text-text-primary transition-colors">Features</a>
                <a href="/#leaderboard" class="nav-link text-sm font-medium text-text-secondary hover:text-text-primary transition-colors">Leaderboard</a>
                <a href="{{ route('dashboard') }}" class="nav-link text-sm font-medium text-text-secondary hover:text-text-primary transition-colors">Dashboard</a>
            </div>

            {{-- Auth Section --}}
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" id="login-btn" class="btn-solar-outline px-5 py-2 text-sm">Login</a>
                    <a href="{{ route('register') }}" id="register-btn" class="btn-solar px-5 py-2 text-sm">Register</a>
                @endguest

                @auth
                    <div class="relative" id="profile-dropdown-container">
                        <button id="profile-dropdown-btn" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-solar-bg border border-transparent hover:border-solar-light transition-all duration-300 group">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-solar to-solar-hover flex items-center justify-center text-white font-bold text-sm shadow-md shadow-solar/15">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-text-secondary group-hover:text-text-primary transition-colors">{{ Auth::user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-text-secondary/50 group-hover:text-text-secondary transition-all duration-300" id="dropdown-chevron"></i>
                        </button>

                        <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-white border border-border shadow-xl shadow-black/8 py-2 animate-slide-down overflow-hidden">
                            <div class="px-4 py-3 border-b border-border">
                                <p class="text-sm font-semibold text-text-primary">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-text-secondary truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-secondary hover:text-solar hover:bg-solar-bg transition-all duration-200">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                                </a>
                                <a href="{{ route('admin.submissions') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-secondary hover:text-solar hover:bg-solar-bg transition-all duration-200">
                                    <i data-lucide="folder-check" class="w-4 h-4"></i> Manage Submissions
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-secondary hover:text-solar hover:bg-solar-bg transition-all duration-200">
                                    <i data-lucide="user-circle" class="w-4 h-4"></i> Profile
                                </a>
                            </div>
                            <div class="border-t border-border pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 text-text-secondary hover:text-solar transition-colors" aria-label="Toggle navigation menu">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden flex-col bg-white border-t border-border px-4 pb-4 shadow-lg">
        <a href="/#hero" class="py-3 text-sm font-medium text-text-secondary hover:text-solar border-b border-border">Home</a>
        <a href="/#features" class="py-3 text-sm font-medium text-text-secondary hover:text-solar border-b border-border">Features</a>
        <a href="/#leaderboard" class="py-3 text-sm font-medium text-text-secondary hover:text-solar border-b border-border">Leaderboard</a>
        <a href="{{ route('dashboard') }}" class="py-3 text-sm font-medium text-text-secondary hover:text-solar border-b border-border">Dashboard</a>
        @guest
            <div class="flex gap-3 pt-4">
                <a href="{{ route('login') }}" class="flex-1 text-center btn-solar-outline py-2.5 text-sm">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-center btn-solar py-2.5 text-sm">Register</a>
            </div>
        @endguest
        @auth
            <div class="pt-4 border-t border-border mt-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-solar to-solar-hover flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-text-primary">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-text-secondary">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-2.5 text-sm text-text-secondary hover:text-solar transition-colors"><i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard</a>
                <a href="{{ route('admin.submissions') }}" class="flex items-center gap-3 py-2.5 text-sm text-text-secondary hover:text-solar transition-colors"><i data-lucide="folder-check" class="w-4 h-4"></i> Manage Submissions</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 py-2.5 text-sm text-red-500 hover:text-red-600 transition-colors"><i data-lucide="log-out" class="w-4 h-4"></i> Logout</button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/90', 'backdrop-blur-lg', 'shadow-sm', 'border-b', 'border-border');
            } else {
                navbar.classList.remove('bg-white/90', 'backdrop-blur-lg', 'shadow-sm', 'border-b', 'border-border');
            }
        });

        const dropdownBtn = document.getElementById('profile-dropdown-btn');
        const dropdownMenu = document.getElementById('profile-dropdown-menu');
        const chevron = document.getElementById('dropdown-chevron');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                if (chevron) chevron.style.transform = dropdownMenu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
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
