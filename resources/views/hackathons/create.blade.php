<x-layouts.app title="Host a Hackathon — LiveHacks">
    <x-landing.navbar />
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[500px] h-[500px] bg-neon-blue/8 -top-20 -left-32 animate-float-slow"></div>
        <div class="blob w-[400px] h-[400px] bg-neon-purple/8 bottom-0 right-0 animate-pulse-glow"></div>
    </div>
    <main class="relative z-10 pt-24 pb-16 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors mb-6">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Dashboard
                </a>
                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Host a <span class="gradient-text">Hackathon</span></h1>
                <p class="text-slate-400">Fill in the details to create and publish your hackathon.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 space-y-1">
                @foreach ($errors->all() as $error)
                <p class="text-red-400 text-sm flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i> {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('hackathons.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Basic Info --}}
                <div class="glass-card rounded-2xl p-6 sm:p-8 space-y-5">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2"><i data-lucide="info" class="w-5 h-5 text-neon-blue"></i> Basic Information</h2>
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-300 mb-2">Hackathon Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                            placeholder="e.g. AI Innovation Challenge 2026">
                    </div>
                    <div>
                        <label for="tagline" class="block text-sm font-medium text-slate-300 mb-2">Tagline</label>
                        <input type="text" name="tagline" id="tagline" value="{{ old('tagline') }}"
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                            placeholder="A short catchy description">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300 resize-none"
                            placeholder="Describe your hackathon...">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Category & Difficulty --}}
                <div class="glass-card rounded-2xl p-6 sm:p-8 space-y-5">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2"><i data-lucide="layers" class="w-5 h-5 text-neon-purple"></i> Category & Tags</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="category" class="block text-sm font-medium text-slate-300 mb-2">Category *</label>
                            <select name="category" id="category" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 transition-all duration-300 appearance-none cursor-pointer">
                                <option value="" class="bg-dark-900">Select category</option>
                                @foreach (['AI/ML', 'Web3', 'IoT', 'Mobile', 'Cybersecurity', 'Green Tech', 'FinTech', 'HealthTech', 'EdTech', 'Gaming', 'Open Innovation'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }} class="bg-dark-900">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="difficulty" class="block text-sm font-medium text-slate-300 mb-2">Difficulty *</label>
                            <select name="difficulty" id="difficulty" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 transition-all duration-300 appearance-none cursor-pointer">
                                @foreach (['Beginner Friendly', 'Intermediate', 'Advanced'] as $diff)
                                <option value="{{ $diff }}" {{ old('difficulty', 'Intermediate') === $diff ? 'selected' : '' }} class="bg-dark-900">{{ $diff }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="tags" class="block text-sm font-medium text-slate-300 mb-2">Tags (comma separated)</label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                            placeholder="Python, React, TensorFlow">
                    </div>
                </div>

                {{-- Prize, Entry Fee & Team --}}
                <div class="glass-card rounded-2xl p-6 sm:p-8 space-y-5">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2"><i data-lucide="gem" class="w-5 h-5 text-yellow-400"></i> Prize, Entry Fee & Team</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="prize_pool" class="block text-sm font-medium text-slate-300 mb-2">Prize Pool ($) *</label>
                            <input type="number" name="prize_pool" id="prize_pool" value="{{ old('prize_pool', 0) }}" required min="0" step="100"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                        <div>
                            <label for="entry_fee" class="block text-sm font-medium text-slate-300 mb-2">Entry Fee ($) *</label>
                            <input type="number" name="entry_fee" id="entry_fee" value="{{ old('entry_fee', 0) }}" required min="0" step="1"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="0 for free entry">
                            <p class="text-xs text-slate-500 mt-1">Set to 0 for free hackathons</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="team_limit" class="block text-sm font-medium text-slate-300 mb-2">Team Size Limit *</label>
                            <input type="number" name="team_limit" id="team_limit" value="{{ old('team_limit', 4) }}" required min="1" max="20"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                        <div>
                            <label for="max_participants" class="block text-sm font-medium text-slate-300 mb-2">Max Participants</label>
                            <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" min="1"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="Unlimited">
                        </div>
                    </div>
                </div>

                {{-- Dates --}}
                <div class="glass-card rounded-2xl p-6 sm:p-8 space-y-5">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2"><i data-lucide="calendar" class="w-5 h-5 text-neon-pink"></i> Schedule</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="registration_start" class="block text-sm font-medium text-slate-300 mb-2">Registration Start</label>
                            <input type="datetime-local" name="registration_start" id="registration_start" value="{{ old('registration_start') }}"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                        <div>
                            <label for="registration_end" class="block text-sm font-medium text-slate-300 mb-2">Registration End</label>
                            <input type="datetime-local" name="registration_end" id="registration_end" value="{{ old('registration_end') }}"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                        <div>
                            <label for="hackathon_start" class="block text-sm font-medium text-slate-300 mb-2">Hackathon Start</label>
                            <input type="datetime-local" name="hackathon_start" id="hackathon_start" value="{{ old('hackathon_start') }}"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                        <div>
                            <label for="hackathon_end" class="block text-sm font-medium text-slate-300 mb-2">Hackathon End</label>
                            <input type="datetime-local" name="hackathon_end" id="hackathon_end" value="{{ old('hackathon_end') }}"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300">
                        </div>
                    </div>
                </div>

                {{-- Images --}}
                <div class="glass-card rounded-2xl p-6 sm:p-8 space-y-5">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2"><i data-lucide="image" class="w-5 h-5 text-neon-blue"></i> Images</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="banner_image" class="block text-sm font-medium text-slate-300 mb-2">Banner Image</label>
                            <input type="file" name="banner_image" id="banner_image" accept="image/*"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-neon-purple/20 file:text-neon-purple hover:file:bg-neon-purple/30 transition-all duration-300">
                        </div>
                        <div>
                            <label for="logo_image" class="block text-sm font-medium text-slate-300 mb-2">Logo Image</label>
                            <input type="file" name="logo_image" id="logo_image" accept="image/*"
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-neon-purple/20 file:text-neon-purple hover:file:bg-neon-purple/30 transition-all duration-300">
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="btn-shimmer w-full py-4 text-base font-semibold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl shadow-lg shadow-neon-purple/25 hover:shadow-neon-purple/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                    Publish Hackathon
                </button>
            </form>
        </div>
    </main>
</x-layouts.app>
