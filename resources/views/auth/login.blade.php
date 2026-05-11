<x-layouts.app title="Login — LiveHacks">
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-16 bg-solar-bg/30">
        <div class="fixed inset-0 dot-pattern pointer-events-none"></div>
        <div class="w-full max-w-md relative z-10">
            <a href="/" class="flex items-center justify-center gap-2.5 mb-10 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-solar to-solar-hover flex items-center justify-center shadow-md shadow-solar/20">
                    <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight"><span class="text-text-primary">Live</span><span class="gradient-text">Hacks</span></span>
            </a>
            <div class="solar-card p-8 sm:p-10 shadow-lg shadow-black/5">
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-text-primary mb-2">Welcome Back</h1>
                    <p class="text-text-secondary text-sm">Sign in to continue your hackathon journey</p>
                </div>
                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50">
                    @foreach ($errors->all() as $error)
                    <p class="text-red-600 text-sm flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i> {{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-primary mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i data-lucide="mail" class="w-4 h-4 text-text-secondary"></i></div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="input-solar pl-11" placeholder="you@example.com">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-primary mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i data-lucide="lock" class="w-4 h-4 text-text-secondary"></i></div>
                            <input type="password" name="password" id="password" required class="input-solar pl-11" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-border text-solar focus:ring-solar/25">
                            <span class="text-sm text-text-secondary group-hover:text-text-primary transition-colors">Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn-solar w-full py-3 text-sm font-semibold rounded-xl justify-center">Sign In</button>
                </form>
                <div class="mt-8 flex items-center gap-3"><div class="flex-1 h-px bg-border"></div><span class="text-xs text-text-secondary uppercase tracking-wider">or</span><div class="flex-1 h-px bg-border"></div></div>
                <p class="mt-6 text-center text-sm text-text-secondary">Don't have an account? <a href="{{ route('register') }}" class="text-solar hover:text-solar-hover font-semibold transition-colors duration-300">Create one</a></p>
            </div>
        </div>
    </div>
</x-layouts.app>
