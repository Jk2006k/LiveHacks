<x-layouts.app title="Host a Hackathon — LiveHacks">
    <x-landing.navbar />
    
    <div class="min-h-screen bg-gradient-to-b from-white via-solar-bg/5 to-white pt-32 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-12">
                <h1 class="text-4xl sm:text-5xl font-bold text-text-primary mb-4">Host a Hackathon</h1>
                <p class="text-lg text-text-secondary">Create and manage your own hackathon event. Set prizes, deadlines, and rules for your competitors.</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-border shadow-lg p-8 sm:p-10">
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('hackathons.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- Basic Information Section --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Basic Information</h2>
                        
                        {{-- Title --}}
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-semibold text-text-primary mb-2">Hackathon Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="input-solar" placeholder="e.g., AI Innovation Challenge 2026">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tagline --}}
                        <div class="mb-6">
                            <label for="tagline" class="block text-sm font-semibold text-text-primary mb-2">Tagline</label>
                            <input type="text" name="tagline" id="tagline" value="{{ old('tagline') }}"
                                class="input-solar" placeholder="A short tagline for your hackathon">
                            @error('tagline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-text-primary mb-2">Description *</label>
                            <textarea name="description" id="description" rows="5" required
                                class="input-solar" placeholder="Describe your hackathon theme, goals, and what participants will build..."></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category & Difficulty --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-semibold text-text-primary mb-2">Category *</label>
                                <select name="category" id="category" required class="input-solar" style="appearance: auto;">
                                    <option value="">Select a category</option>
                                    <option value="Web Development" {{ old('category') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                    <option value="Mobile Development" {{ old('category') === 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                    <option value="Artificial Intelligence" {{ old('category') === 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                                    <option value="Cybersecurity" {{ old('category') === 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                                    <option value="IoT" {{ old('category') === 'IoT' ? 'selected' : '' }}>IoT</option>
                                    <option value="Blockchain" {{ old('category') === 'Blockchain' ? 'selected' : '' }}>Blockchain</option>
                                    <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="difficulty" class="block text-sm font-semibold text-text-primary mb-2">Difficulty Level *</label>
                                <select name="difficulty" id="difficulty" required class="input-solar" style="appearance: auto;">
                                    <option value="">Select difficulty</option>
                                    <option value="Beginner Friendly" {{ old('difficulty') === 'Beginner Friendly' ? 'selected' : '' }}>Beginner Friendly</option>
                                    <option value="Intermediate" {{ old('difficulty') === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('difficulty') === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                                @error('difficulty')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Timeline Section --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Timeline</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="registration_start" class="block text-sm font-semibold text-text-primary mb-2">Registration Start</label>
                                <input type="datetime-local" name="registration_start" id="registration_start" value="{{ old('registration_start') }}" class="input-solar">
                                @error('registration_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="registration_end" class="block text-sm font-semibold text-text-primary mb-2">Registration End</label>
                                <input type="datetime-local" name="registration_end" id="registration_end" value="{{ old('registration_end') }}" class="input-solar">
                                @error('registration_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="hackathon_start" class="block text-sm font-semibold text-text-primary mb-2">Hackathon Start</label>
                                <input type="datetime-local" name="hackathon_start" id="hackathon_start" value="{{ old('hackathon_start') }}" class="input-solar">
                                @error('hackathon_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="hackathon_end" class="block text-sm font-semibold text-text-primary mb-2">Hackathon End</label>
                                <input type="datetime-local" name="hackathon_end" id="hackathon_end" value="{{ old('hackathon_end') }}" class="input-solar">
                                @error('hackathon_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Prize & Participation Section --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Prize & Participation</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="prize_pool" class="block text-sm font-semibold text-text-primary mb-2">Prize Pool (USD) *</label>
                                <input type="number" name="prize_pool" id="prize_pool" value="{{ old('prize_pool', 0) }}" min="0" step="100" required class="input-solar" placeholder="e.g., 10000">
                                @error('prize_pool')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="entry_fee" class="block text-sm font-semibold text-text-primary mb-2">Entry Fee (USD) *</label>
                                <input type="number" name="entry_fee" id="entry_fee" value="{{ old('entry_fee', 0) }}" min="0" step="0.01" required class="input-solar" placeholder="Leave 0 for free">
                                @error('entry_fee')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="team_limit" class="block text-sm font-semibold text-text-primary mb-2">Team Size Limit *</label>
                                <input type="number" name="team_limit" id="team_limit" value="{{ old('team_limit', 5) }}" min="1" max="20" required class="input-solar">
                                @error('team_limit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="max_participants" class="block text-sm font-semibold text-text-primary mb-2">Max Participants (Optional)</label>
                                <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" min="1" class="input-solar" placeholder="Leave empty for unlimited">
                                @error('max_participants')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Additional Info Section --}}
                    <div class="border-b border-border pb-8">
                        <h2 class="text-2xl font-bold text-text-primary mb-6">Additional Information</h2>
                        
                        {{-- Tags --}}
                        <div class="mb-6">
                            <label for="tags" class="block text-sm font-semibold text-text-primary mb-2">Tags (comma-separated)</label>
                            <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                                class="input-solar" placeholder="e.g., Machine Learning, Python, Open Source">
                            @error('tags')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Problem Statement --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-primary mb-2">Problem Statement (PDF)</label>
                            <input type="file" name="problem_statement_pdf" id="problem_statement_pdf" accept=".pdf" class="hidden" onchange="updateFileName(this)">
                            <label for="problem_statement_pdf" class="block w-full p-6 border-2 border-dashed border-border rounded-xl text-center cursor-pointer hover:border-solar hover:bg-solar-bg/30 transition-all duration-300" id="file-label">
                                <div class="flex flex-col items-center gap-2" id="file-content">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-text-secondary"></i>
                                    <span class="text-sm font-medium text-text-secondary">Click to upload PDF</span>
                                    <span class="text-xs text-text-secondary/60">PDF files only (max 10MB)</span>
                                </div>
                                <div id="file-name" class="hidden text-sm text-emerald-600 font-medium mt-2"></div>
                            </label>
                            @error('problem_statement_pdf')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="flex gap-4">
                        <button type="submit" class="btn-solar px-8 py-3 font-semibold rounded-xl flex items-center gap-2 justify-center flex-1">
                            <i data-lucide="plus" class="w-5 h-5"></i> Create Hackathon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // File upload handling
        function updateFileName(input) {
            const fileContent = document.getElementById('file-content');
            const fileName = document.getElementById('file-name');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validate file type
                if (file.type !== 'application/pdf') {
                    alert('Please select a PDF file');
                    input.value = '';
                    fileContent.style.display = 'flex';
                    fileName.style.display = 'none';
                    return;
                }
                
                // Validate file size (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('File size must be less than 10MB');
                    input.value = '';
                    fileContent.style.display = 'flex';
                    fileName.style.display = 'none';
                    return;
                }
                
                fileName.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + 'MB)';
                fileContent.style.display = 'none';
                fileName.style.display = 'block';
            } else {
                fileContent.style.display = 'flex';
                fileName.style.display = 'none';
            }
        }

        // Drag and drop handling
        const fileLabel = document.getElementById('file-label');
        if (fileLabel) {
            fileLabel.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileLabel.classList.add('border-solar', 'bg-solar-bg/30');
            });

            fileLabel.addEventListener('dragleave', () => {
                fileLabel.classList.remove('border-solar', 'bg-solar-bg/30');
            });

            fileLabel.addEventListener('drop', (e) => {
                e.preventDefault();
                fileLabel.classList.remove('border-solar', 'bg-solar-bg/30');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById('problem_statement_pdf').files = files;
                    updateFileName(document.getElementById('problem_statement_pdf'));
                }
            });
        }

        // Initialize Lucide icons after DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>
</x-layouts.app>
