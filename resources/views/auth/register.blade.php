<x-layouts.app title="Register — LiveHacks">

    {{-- Background effects --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[500px] h-[500px] bg-neon-purple/8 -top-20 -right-32 animate-float-slow"></div>
        <div class="blob w-[400px] h-[400px] bg-neon-blue/8 bottom-0 left-0 animate-pulse-glow"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-16">
        <div class="w-full max-w-md">
            {{-- Logo --}}
            <a href="/" class="flex items-center justify-center gap-2 mb-10 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-neon-blue to-neon-purple flex items-center justify-center shadow-lg shadow-neon-purple/25 group-hover:shadow-neon-purple/50 transition-shadow duration-300">
                    <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight">
                    <span class="text-white">Live</span><span class="gradient-text">Hacks</span>
                </span>
            </a>

            {{-- Register Card --}}
            <div class="glass-card rounded-2xl p-8 sm:p-10">
                <div class="text-center mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Join LiveHacks</h1>
                    <p class="text-slate-400 text-sm">Create your account and start competing</p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-400 text-sm flex items-center gap-2">
                                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-4 h-4 text-slate-500"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm
                                       focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="John Doe">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-500"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm
                                       focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-slate-500"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm
                                       focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="••••••••">
                        </div>
                        <p class="mt-1.5 text-xs text-slate-500">Minimum 8 characters</p>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="shield-check" class="w-4 h-4 text-slate-500"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm
                                       focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="••••••••">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-shimmer w-full py-3 text-sm font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25
                               hover:shadow-neon-purple/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                        Create Account
                    </button>
                </form>

                {{-- Divider --}}
                <div class="mt-8 flex items-center gap-3">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent to-white/10"></div>
                    <span class="text-xs text-slate-500 uppercase tracking-wider">or</span>
                    <div class="flex-1 h-px bg-gradient-to-l from-transparent to-white/10"></div>
                </div>

                {{-- Login link --}}
                <p class="mt-6 text-center text-sm text-slate-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-neon-purple hover:text-neon-blue font-semibold transition-colors duration-300">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>

</x-layouts.app>
