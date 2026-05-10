{{-- Navbar --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            {{-- Logo --}}
            <a href="#" id="nav-logo" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center shadow-lg shadow-neon-purple/20 group-hover:shadow-neon-purple/40 transition-shadow duration-300">
                    <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">
                    <span class="text-white">Live</span><span class="gradient-text">Hacks</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#hero" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Home</a>
                <a href="#features" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Features</a>
                <a href="#hackathons" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Hackathons</a>
                <a href="#leaderboard" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Leaderboard</a>
                <a href="#contact" class="nav-link text-sm font-medium text-slate-300 hover:text-white transition-colors">Contact</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="#" id="login-btn" class="px-5 py-2 text-sm font-medium text-slate-300 hover:text-white border border-white/10 hover:border-white/25 rounded-xl transition-all duration-300 hover:bg-white/5">
                    Login
                </a>
                <a href="#" id="register-btn" class="btn-shimmer px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 transition-all duration-300 hover:scale-105">
                    Register
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-400 hover:text-white transition-colors" aria-label="Toggle navigation menu">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden flex-col glass border-t border-white/5 px-4 pb-4">
        <a href="#hero" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Home</a>
        <a href="#features" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Features</a>
        <a href="#hackathons" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Hackathons</a>
        <a href="#leaderboard" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Leaderboard</a>
        <a href="#contact" class="py-3 text-sm font-medium text-slate-300 hover:text-white border-b border-white/5">Contact</a>
        <div class="flex gap-3 pt-4">
            <a href="#" class="flex-1 text-center px-4 py-2.5 text-sm font-medium text-slate-300 border border-white/10 rounded-xl hover:bg-white/5 transition-all">Login</a>
            <a href="#" class="flex-1 text-center px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg">Register</a>
        </div>
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
    });
</script>
