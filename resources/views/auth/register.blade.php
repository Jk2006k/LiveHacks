<x-layouts.app title="Register — LiveHacks">
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
                    <h1 class="text-2xl sm:text-3xl font-bold text-text-primary mb-2">Join LiveHacks</h1>
                    <p class="text-text-secondary text-sm">Create your account and start competing</p>
                </div>
                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 space-y-1">
                    @foreach ($errors->all() as $error)
                    <p class="text-red-600 text-sm flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i> {{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-text-primary mb-2">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus class="input-solar" placeholder="John Doe">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-primary mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="input-solar" placeholder="you@example.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-primary mb-2">Password</label>
                        <input type="password" name="password" id="password" required class="input-solar" placeholder="••••••••">
                        <p class="mt-1.5 text-xs text-text-secondary">Minimum 8 characters</p>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-text-primary mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="input-solar" placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn-solar w-full py-3 text-sm font-semibold rounded-xl justify-center">Create Account</button>
                </form>
                <div class="mt-8 flex items-center gap-3"><div class="flex-1 h-px bg-border"></div><span class="text-xs text-text-secondary uppercase tracking-wider">or</span><div class="flex-1 h-px bg-border"></div></div>
                <p class="mt-6 text-center text-sm text-text-secondary">Already have an account? <a href="{{ route('login') }}" class="text-solar hover:text-solar-hover font-semibold transition-colors duration-300">Sign in</a></p>
            </div>
        </div>
    </div>
</x-layouts.app>
