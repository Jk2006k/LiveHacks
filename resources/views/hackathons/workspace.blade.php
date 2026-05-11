<x-layouts.app title="{{ $hackathon->title }} Workspace — LiveHacks">
    <x-landing.navbar />

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="blob w-[800px] h-[800px] bg-neon-purple/5 -top-40 -right-20 animate-float-slow"></div>
        <div class="blob w-[600px] h-[600px] bg-neon-blue/5 bottom-0 -left-20 animate-pulse-glow"></div>
    </div>

    @php $colors = $hackathon->color_scheme; @endphp

    <main class="relative z-10 pt-24 pb-24 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <a href="{{ route('hackathons.show', $hackathon) }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors mb-6">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Hackathon
            </a>

            {{-- Flash --}}
            @if (session('success'))
            <div id="flash-success" class="mb-6 p-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
            </div>
            @endif
            @if (session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 shrink-0"></i>
                <p class="text-red-400 text-sm font-medium">{{ session('error') }}</p>
            </div>
            @endif

            {{-- Header --}}
            <div class="glass-card rounded-3xl p-8 sm:p-10 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold px-3 py-1 rounded-full border {{ $colors['badge_color'] }} uppercase tracking-wider">{{ $hackathon->category }}</span>
                            {{-- Status Badge --}}
                            @if ($submissionStatus === 'closed')
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-red-500/20 bg-red-500/10 text-red-400">
                                <i data-lucide="lock" class="w-3 h-3"></i> Submission Closed
                            </span>
                            @elseif ($submissionStatus === 'resubmitted')
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-amber-500/20 bg-amber-500/10 text-amber-400">
                                <i data-lucide="refresh-cw" class="w-3 h-3"></i> Resubmitted
                            </span>
                            @elseif ($submissionStatus === 'submitted')
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-emerald-500/20 bg-emerald-500/10 text-emerald-400">
                                <i data-lucide="check-circle" class="w-3 h-3"></i> Submitted
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full border border-slate-500/20 bg-slate-500/10 text-slate-400">
                                <i data-lucide="circle" class="w-3 h-3"></i> Not Submitted
                            </span>
                            @endif
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $hackathon->title }}</h1>
                        <p class="text-slate-400 mt-1">Workspace Dashboard</p>
                    </div>

                    {{-- Countdown --}}
                    @if ($hackathon->hackathon_end && !$hackEnded)
                    <div class="text-center px-6 py-4 rounded-2xl bg-dark-950/60 border border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Submission Deadline</p>
                        <p class="text-xl font-black text-neon-blue countdown-digit" data-countdown="{{ $hackathon->hackathon_end->toIso8601String() }}">Loading...</p>
                    </div>
                    @elseif ($hackEnded)
                    <div class="text-center px-6 py-4 rounded-2xl bg-red-500/5 border border-red-500/10">
                        <p class="text-[10px] font-bold text-red-400/60 uppercase tracking-widest mb-1">Deadline</p>
                        <p class="text-xl font-black text-red-400">Ended</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Problem Statement Download --}}
            @if ($hackathon->problem_statement_pdf && $hackStarted)
            <div class="glass-card rounded-2xl p-6 mb-8 flex flex-col sm:flex-row items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500/20 to-teal-500/20 flex items-center justify-center shrink-0">
                    <i data-lucide="file-down" class="w-7 h-7 text-emerald-400"></i>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-lg font-bold text-white">Problem Statement</h3>
                    <p class="text-sm text-slate-400">Download the official problem statement PDF for this hackathon.</p>
                </div>
                <a href="{{ route('hackathons.problem-statement', $hackathon) }}"
                   class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                    <i data-lucide="download" class="w-4 h-4"></i> Download PDF
                </a>
            </div>
            @elseif ($hackathon->problem_statement_pdf && !$hackStarted)
            <div class="glass-card rounded-2xl p-6 mb-8 flex flex-col sm:flex-row items-center gap-4 opacity-60">
                <div class="w-14 h-14 rounded-xl bg-slate-500/10 flex items-center justify-center shrink-0">
                    <i data-lucide="lock" class="w-7 h-7 text-slate-500"></i>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-lg font-bold text-slate-400">Problem Statement</h3>
                    <p class="text-sm text-slate-500">Available after hackathon starts.</p>
                </div>
            </div>
            @endif

            {{-- Existing Submission Details --}}
            @if ($submission)
            <div class="glass-card rounded-2xl p-6 sm:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-neon-purple/10 flex items-center justify-center">
                        <i data-lucide="folder-check" class="w-5 h-5 text-neon-purple"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Your Submission</h2>
                        <p class="text-xs text-slate-500">Last updated {{ $submission->submitted_at->diffForHumans() }} · {{ $submission->submission_count }} submission(s)</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-dark-950/40 border border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Project</p>
                        <p class="text-sm font-bold text-white">{{ $submission->project_title }}</p>
                    </div>
                    <div class="p-4 rounded-xl bg-dark-950/40 border border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Team</p>
                        <p class="text-sm font-bold text-white">{{ $submission->team_name }}</p>
                    </div>
                    <div class="p-4 rounded-xl bg-dark-950/40 border border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">GitHub</p>
                        <a href="{{ $submission->github_link }}" target="_blank" class="text-sm font-medium text-neon-blue hover:underline truncate block">{{ $submission->github_link }}</a>
                    </div>
                    <div class="p-4 rounded-xl bg-dark-950/40 border border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">ZIP File</p>
                        <p class="text-sm text-white flex items-center gap-2">
                            <i data-lucide="archive" class="w-4 h-4 text-neon-purple"></i>
                            {{ $submission->zip_file_name ?? 'submission.zip' }}
                            <span class="text-slate-500 text-xs">({{ $submission->formatted_file_size }})</span>
                        </p>
                    </div>
                </div>
                @if ($submission->demo_video_link)
                <div class="mt-4 p-4 rounded-xl bg-dark-950/40 border border-white/5">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Demo Video</p>
                    <a href="{{ $submission->demo_video_link }}" target="_blank" class="text-sm font-medium text-neon-blue hover:underline">{{ $submission->demo_video_link }}</a>
                </div>
                @endif
            </div>
            @endif

            {{-- Submission Form --}}
            @if ($canSubmit)
            <div class="glass-card rounded-3xl p-8 sm:p-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 flex items-center justify-center">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-neon-blue"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $submission ? 'Update Submission' : 'Submit Your Project' }}</h2>
                        <p class="text-sm text-slate-400">{{ $submission ? 'Edit your submission before the deadline.' : 'Fill in the details and upload your project.' }}</p>
                    </div>
                </div>

                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl border border-red-500/30 bg-red-500/10 space-y-1">
                    @foreach ($errors->all() as $error)
                    <p class="text-red-400 text-sm flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i> {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('hackathons.submit', $hackathon) }}" enctype="multipart/form-data" class="space-y-6" id="submission-form">
                    @csrf

                    {{-- Team & Participant --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="team_name" class="block text-sm font-medium text-slate-300 mb-2">Team Name *</label>
                            <input type="text" name="team_name" id="team_name" value="{{ old('team_name', $submission->team_name ?? '') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="e.g. Code Wizards">
                        </div>
                        <div>
                            <label for="participant_name" class="block text-sm font-medium text-slate-300 mb-2">Your Name *</label>
                            <input type="text" name="participant_name" id="participant_name" value="{{ old('participant_name', $submission->participant_name ?? '') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="John Doe">
                        </div>
                    </div>

                    {{-- Mobile & GitHub --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="mobile_number" class="block text-sm font-medium text-slate-300 mb-2">Mobile Number *</label>
                            <input type="tel" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $submission->mobile_number ?? '') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="+1234567890">
                            <p class="text-xs text-slate-500 mt-1">7-15 digits, optional + prefix</p>
                        </div>
                        <div>
                            <label for="github_link" class="block text-sm font-medium text-slate-300 mb-2">GitHub Repo Link *</label>
                            <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $submission->github_link ?? '') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                                placeholder="https://github.com/user/repo">
                        </div>
                    </div>

                    {{-- Project Title --}}
                    <div>
                        <label for="project_title" class="block text-sm font-medium text-slate-300 mb-2">Project Title *</label>
                        <input type="text" name="project_title" id="project_title" value="{{ old('project_title', $submission->project_title ?? '') }}" required
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                            placeholder="My Awesome Project">
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Project Description *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300 resize-none"
                            placeholder="Describe what your project does...">{{ old('description', $submission->description ?? '') }}</textarea>
                    </div>

                    {{-- ZIP Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            ZIP File Upload {{ $submission ? '(optional — keep current)' : '*' }}
                        </label>
                        <div id="drop-zone"
                             class="relative border-2 border-dashed border-white/10 hover:border-neon-purple/40 rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer group"
                             onclick="document.getElementById('zip_file').click()">
                            <input type="file" name="zip_file" id="zip_file" accept=".zip" class="hidden"
                                   {{ $submission ? '' : 'required' }}>
                            <div id="drop-zone-content">
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-neon-blue/10 to-neon-purple/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-neon-purple"></i>
                                </div>
                                <p class="text-white font-semibold mb-1">Drag & Drop your ZIP file here</p>
                                <p class="text-slate-500 text-sm">or click to browse · Max 100MB · .zip only</p>
                            </div>
                            <div id="drop-zone-file" class="hidden">
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-emerald-500/10 flex items-center justify-center mb-4">
                                    <i data-lucide="file-archive" class="w-8 h-8 text-emerald-400"></i>
                                </div>
                                <p class="text-emerald-400 font-semibold mb-1" id="selected-file-name"></p>
                                <p class="text-slate-500 text-sm" id="selected-file-size"></p>
                            </div>
                        </div>
                        @if ($submission && $submission->zip_file_name)
                        <p class="text-xs text-slate-500 mt-2 flex items-center gap-1">
                            <i data-lucide="archive" class="w-3 h-3"></i>
                            Current: {{ $submission->zip_file_name }} ({{ $submission->formatted_file_size }})
                        </p>
                        @endif
                    </div>

                    {{-- Demo Video --}}
                    <div>
                        <label for="demo_video_link" class="block text-sm font-medium text-slate-300 mb-2">Demo Video Link <span class="text-slate-500">(optional)</span></label>
                        <input type="url" name="demo_video_link" id="demo_video_link" value="{{ old('demo_video_link', $submission->demo_video_link ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-neon-purple/50 focus:ring-1 focus:ring-neon-purple/25 transition-all duration-300"
                            placeholder="https://youtube.com/watch?v=...">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="submit-btn"
                        class="btn-shimmer w-full py-4 text-base font-bold text-white bg-gradient-to-r from-neon-blue to-neon-purple rounded-2xl shadow-xl shadow-neon-purple/20 hover:shadow-neon-purple/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 cursor-pointer flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-5 h-5"></i>
                        {{ $submission ? 'Update Submission' : 'Submit Project' }}
                    </button>
                </form>
            </div>
            @elseif (!$hackStarted)
            <div class="glass-card rounded-3xl p-10 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-neon-blue/10 flex items-center justify-center mb-6">
                    <i data-lucide="clock" class="w-10 h-10 text-neon-blue"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Submissions Not Open Yet</h2>
                <p class="text-slate-400 mb-4">The hackathon hasn't started. Submissions open at:</p>
                @if ($hackathon->hackathon_start)
                <p class="text-lg font-bold text-neon-blue">{{ $hackathon->hackathon_start->format('M d, Y · h:i A') }}</p>
                @endif
            </div>
            @elseif ($hackEnded && !$submission)
            <div class="glass-card rounded-3xl p-10 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-red-500/10 flex items-center justify-center mb-6">
                    <i data-lucide="x-circle" class="w-10 h-10 text-red-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-red-400 mb-2">Submission Deadline Passed</h2>
                <p class="text-slate-400">You can no longer submit for this hackathon.</p>
            </div>
            @endif

        </div>
    </main>

    {{-- Success Modal --}}
    <div id="success-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="glass-card rounded-3xl p-10 max-w-md mx-4 text-center transform scale-95 opacity-0 transition-all duration-300" id="success-modal-content">
            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-500/15 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" id="check-path"
                          style="stroke-dasharray: 30; stroke-dashoffset: 30;"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Submission Successful!</h3>
            <p class="text-slate-400 mb-6">Your project has been submitted. Good luck!</p>
            <button onclick="closeSuccessModal()" class="px-8 py-3 text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl hover:scale-105 transition-all duration-300 cursor-pointer">
                Got it!
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Drag & Drop
            const dz = document.getElementById('drop-zone');
            const fi = document.getElementById('zip_file');
            const dzContent = document.getElementById('drop-zone-content');
            const dzFile = document.getElementById('drop-zone-file');
            const fileName = document.getElementById('selected-file-name');
            const fileSize = document.getElementById('selected-file-size');

            if (dz && fi) {
                ['dragenter','dragover'].forEach(e => {
                    dz.addEventListener(e, (ev) => { ev.preventDefault(); dz.classList.add('border-neon-purple/60','bg-neon-purple/5'); });
                });
                ['dragleave','drop'].forEach(e => {
                    dz.addEventListener(e, (ev) => { ev.preventDefault(); dz.classList.remove('border-neon-purple/60','bg-neon-purple/5'); });
                });
                dz.addEventListener('drop', (ev) => {
                    const files = ev.dataTransfer.files;
                    if (files.length && files[0].name.endsWith('.zip')) {
                        fi.files = files;
                        showFile(files[0]);
                    }
                });
                fi.addEventListener('change', () => {
                    if (fi.files.length) showFile(fi.files[0]);
                });
            }

            function showFile(f) {
                dzContent.classList.add('hidden');
                dzFile.classList.remove('hidden');
                fileName.textContent = f.name;
                const mb = (f.size / (1024*1024)).toFixed(2);
                fileSize.textContent = mb + ' MB';
            }

            // Show success modal if flash
            @if (session('success'))
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    content.classList.remove('scale-95','opacity-0');
                    content.classList.add('scale-100','opacity-100');
                    // Animate checkmark
                    const path = document.getElementById('check-path');
                    if (path) path.style.strokeDashoffset = '0';
                    path.style.transition = 'stroke-dashoffset 0.6s ease 0.3s';
                    path.style.strokeDashoffset = '0';
                }, 50);
            }
            @endif
        });

        function closeSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            content.classList.add('scale-95','opacity-0');
            content.classList.remove('scale-100','opacity-100');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }
    </script>
</x-layouts.app>
