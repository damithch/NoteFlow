<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Update Your Note</h1>
                    </div>

                    <form action="{{ route('notes.update', $note) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Note Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $note->title) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" 
                                   placeholder="Enter your note title..."
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Note Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="15" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('content') border-red-500 @enderror resize-none" 
                                      placeholder="Start writing your note here..."
                                      required>{{ old('content', $note->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Character Counter -->
                            <div class="mt-2 text-right">
                                <span id="char-count" class="text-sm text-gray-500">0 characters</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <a href="{{ route('notes.show', $note) }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Cancel
                                </a>
                                
                                <a href="{{ route('notes.index') }}" 
                                   class="text-indigo-600 hover:text-indigo-700 font-medium py-3 px-3 transition duration-150 ease-in-out">
                                    Back to Notes
                                </a>
                            </div>

                            <button type="submit" 
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out">
                                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Note
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Writing Tips Section -->
            <div class="mt-8 bg-gradient-to-r from-indigo-50 to-blue-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Editing Tips
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div>
                            <p class="mb-2"><strong>🔄 Review and Revise:</strong> Take time to read through your note and improve clarity.</p>
                            <p class="mb-2"><strong>✨ Polish Your Content:</strong> Fix any typos and enhance your key points.</p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>📝 Update Structure:</strong> Reorganize content for better flow if needed.</p>
                            <p><strong>🎯 Stay Focused:</strong> Ensure your note maintains its main purpose and message.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for character counter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('content');
            const charCount = document.getElementById('char-count');
            
            function updateCharCount() {
                const count = textarea.value.length;
                charCount.textContent = count + ' characters';
                
                if (count > 5000) {
                    charCount.classList.add('text-red-500');
                    charCount.classList.remove('text-gray-500');
                } else {
                    charCount.classList.add('text-gray-500');
                    charCount.classList.remove('text-red-500');
                }
            }
            
            // Update count on page load
            updateCharCount();
            
            // Update count on input
            textarea.addEventListener('input', updateCharCount);
        });
    </script>
</x-app-layout>