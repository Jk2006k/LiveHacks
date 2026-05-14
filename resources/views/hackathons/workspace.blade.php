<x-layouts.app title="Workspace — {{ $hackathon->title }} — LiveHacks">
    <x-landing.navbar />
    
    <div class="min-h-screen bg-gradient-to-b from-white via-solar-bg/5 to-white pt-32 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <div class="mb-8">
                <a href="{{ route('hackathons.show', $hackathon) }}" class="inline-flex items-center gap-2 text-solar hover:text-solar-hover transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to {{ $hackathon->title }}
                </a>
            </div>

            {{-- Header --}}
            <div class="mb-12">
                <h1 class="text-4xl sm:text-5xl font-bold text-text-primary mb-4">Submission Workspace</h1>
                <p class="text-lg text-text-secondary">{{ $hackathon->title }}</p>
            </div>

            {{-- Status Messages --}}
            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span class="text-emerald-800">{{ session('success') }}</span>
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 shrink-0"></i>
                <span class="text-red-800">{{ session('error') }}</span>
            </div>
            @endif

            {{-- Status Banner --}}
            @if ($hackEnded)
            <div class="mb-8 p-6 rounded-xl border border-gray-200 bg-gray-50">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="lock" class="w-5 h-5 text-gray-600"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Submission Period Closed</h3>
                </div>
                <p class="text-gray-700">The hackathon has ended. Submissions are no longer accepted.</p>
            </div>
            @elseif (!$hackStarted)
            <div class="mb-8 p-6 rounded-xl border border-blue-200 bg-blue-50">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i>
                    <h3 class="text-lg font-semibold text-blue-900">Waiting to Start</h3>
                </div>
                <p class="text-blue-700">The hackathon hasn't started yet. You'll be able to submit your work once it begins on {{ $hackathon->hackathon_start->format('M d, Y H:i') }}</p>
            </div>
            @elseif ($canSubmit)
            <div class="mb-8 p-6 rounded-xl border border-emerald-200 bg-emerald-50">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="play-circle" class="w-5 h-5 text-emerald-600"></i>
                    <h3 class="text-lg font-semibold text-emerald-900">Submission Open</h3>
                </div>
                <p class="text-emerald-700">The hackathon is live! Submit your project before {{ $hackathon->hackathon_end->format('M d, Y H:i') }}</p>
            </div>
            @endif

            {{-- Submission Form --}}
            @if ($canSubmit)
            <div class="bg-white rounded-2xl border border-border shadow-lg p-8 sm:p-10">
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('hackathons.submit', $hackathon) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- Team Information --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Team Information</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="team_name" class="block text-sm font-semibold text-text-primary mb-2">Team Name *</label>
                                <input type="text" name="team_name" id="team_name" value="{{ old('team_name', $submission?->team_name) }}" required
                                    class="input-solar" placeholder="e.g., Code Warriors">
                                @error('team_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="participant_name" class="block text-sm font-semibold text-text-primary mb-2">Lead Name *</label>
                                <input type="text" name="participant_name" id="participant_name" value="{{ old('participant_name', $submission?->participant_name) }}" required
                                    class="input-solar" placeholder="Your full name">
                                @error('participant_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="mobile_number" class="block text-sm font-semibold text-text-primary mb-2 mt-6">Mobile Number *</label>
                            <input type="tel" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $submission?->mobile_number) }}" required
                                class="input-solar" placeholder="+1 (555) 123-4567">
                            @error('mobile_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Project Information --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Project Information</h2>
                        
                        <div>
                            <label for="project_title" class="block text-sm font-semibold text-text-primary mb-2">Project Title *</label>
                            <input type="text" name="project_title" id="project_title" value="{{ old('project_title', $submission?->project_title) }}" required
                                class="input-solar" placeholder="Give your project an awesome name">
                            @error('project_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="description" class="block text-sm font-semibold text-text-primary mb-2">Description *</label>
                            <textarea name="description" id="description" rows="6" required
                                class="input-solar" placeholder="Describe your project, what it does, and how it works...">{{ old('description', $submission?->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Links --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Project Links</h2>
                        
                        <div>
                            <label for="github_link" class="block text-sm font-semibold text-text-primary mb-2">GitHub Repository *</label>
                            <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $submission?->github_link) }}" required
                                class="input-solar" placeholder="https://github.com/username/project">
                            @error('github_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="demo_video_link" class="block text-sm font-semibold text-text-primary mb-2">Demo Video Link (Optional)</label>
                            <input type="url" name="demo_video_link" id="demo_video_link" value="{{ old('demo_video_link', $submission?->demo_video_link) }}"
                                class="input-solar" placeholder="https://youtube.com/watch?v=... or https://vimeo.com/...">
                            @error('demo_video_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- File Upload --}}
                    <div>
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Project Files</h2>
                        
                        <label class="block text-sm font-semibold text-text-primary mb-2">
                            Project ZIP File {{ !$submission ? '*' : '' }}
                        </label>
                        <input type="file" name="zip_file" id="zip_file" accept=".zip" class="hidden" onchange="updateZipName(this)">
                        <label for="zip_file" class="block w-full p-8 border-2 border-dashed border-border rounded-xl text-center cursor-pointer hover:border-solar hover:bg-solar-bg/30 transition-all duration-300" id="zip-label">
                            <div class="flex flex-col items-center gap-2" id="zip-content">
                                <i data-lucide="package" class="w-8 h-8 text-text-secondary"></i>
                                <span class="text-sm font-medium text-text-secondary">Click to upload ZIP file</span>
                                <span class="text-xs text-text-secondary/60">ZIP files only (max 100MB)</span>
                            </div>
                            <div id="zip-name" class="hidden text-sm text-emerald-600 font-medium mt-2"></div>
                        </label>
                        @if ($submission && $submission->zip_file)
                            <p class="mt-2 text-sm text-emerald-600">
                                <i data-lucide="check-circle" class="w-4 h-4 inline"></i> Current: {{ $submission->zip_file_name }} ({{ round($submission->zip_file_size / 1024 / 1024, 2) }}MB)
                            </p>
                        @endif
                        @error('zip_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex gap-4 pt-6">
                        <button type="submit" class="btn-solar px-8 py-3 font-semibold rounded-xl flex items-center gap-2 justify-center flex-1">
                            <i data-lucide="send" class="w-5 h-5"></i> {{ $submission ? 'Update Submission' : 'Submit Project' }}
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-white rounded-2xl border border-border shadow-lg p-8 sm:p-10 text-center">
                @if ($submissionStatus === 'submitted')
                <div class="mb-6">
                    <i data-lucide="check-circle" class="w-16 h-16 text-emerald-600 mx-auto"></i>
                </div>
                <h2 class="text-2xl font-bold text-text-primary mb-3">Submission Received</h2>
                <p class="text-text-secondary mb-6">Your project has been submitted successfully. Thank you for participating!</p>
                <div class="space-y-4">
                    <div class="text-left bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-text-secondary mb-1">Project: <span class="font-semibold text-text-primary">{{ $submission->project_title }}</span></p>
                        <p class="text-sm text-text-secondary mb-1">Team: <span class="font-semibold text-text-primary">{{ $submission->team_name }}</span></p>
                        <p class="text-sm text-text-secondary">Submitted: <span class="font-semibold text-text-primary">{{ $submission->submitted_at?->format('M d, Y H:i') }}</span></p>
                    </div>
                </div>
                @elseif ($submissionStatus === 'closed')
                <div class="mb-6">
                    <i data-lucide="lock" class="w-16 h-16 text-gray-600 mx-auto"></i>
                </div>
                <h2 class="text-2xl font-bold text-text-primary mb-3">Submissions Closed</h2>
                <p class="text-text-secondary">The submission period for this hackathon has ended.</p>
                @else
                <div class="mb-6">
                    <i data-lucide="clock" class="w-16 h-16 text-blue-600 mx-auto"></i>
                </div>
                <h2 class="text-2xl font-bold text-text-primary mb-3">Waiting for Hackathon to Start</h2>
                <p class="text-text-secondary">The hackathon will start on {{ $hackathon->hackathon_start?->format('M d, Y H:i') }}</p>
                @endif
            </div>
            @endif
        </div>
    </div>

    <script>
        function updateZipName(input) {
            const zipContent = document.getElementById('zip-content');
            const zipName = document.getElementById('zip-name');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                if (file.type !== 'application/zip' && !file.name.endsWith('.zip')) {
                    alert('Please select a ZIP file');
                    input.value = '';
                    zipContent.style.display = 'flex';
                    zipName.style.display = 'none';
                    return;
                }
                
                if (file.size > 100 * 1024 * 1024) {
                    alert('File size must be less than 100MB');
                    input.value = '';
                    zipContent.style.display = 'flex';
                    zipName.style.display = 'none';
                    return;
                }
                
                zipName.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + 'MB)';
                zipContent.style.display = 'none';
                zipName.style.display = 'block';
            } else {
                zipContent.style.display = 'flex';
                zipName.style.display = 'none';
            }
        }

        const zipLabel = document.getElementById('zip-label');
        if (zipLabel) {
            zipLabel.addEventListener('dragover', (e) => {
                e.preventDefault();
                zipLabel.classList.add('border-solar', 'bg-solar-bg/30');
            });

            zipLabel.addEventListener('dragleave', () => {
                zipLabel.classList.remove('border-solar', 'bg-solar-bg/30');
            });

            zipLabel.addEventListener('drop', (e) => {
                e.preventDefault();
                zipLabel.classList.remove('border-solar', 'bg-solar-bg/30');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById('zip_file').files = files;
                    updateZipName(document.getElementById('zip_file'));
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>
</x-layouts.app>
