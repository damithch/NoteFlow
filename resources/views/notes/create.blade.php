<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="title" 
                                        :value="old('title')" 
                                        required 
                                        autofocus 
                                        maxlength="255"
                                        placeholder="Enter note title..." />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" 
                                    name="content"
                                    rows="10"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Write your note content here..."
                                    required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('notes.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                Cancel
                            </a>

                            <x-primary-button class="ms-3">
                                {{ __('Create Note') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Writing Tips -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-3">💡 Writing Tips</h3>
                <ul class="text-blue-800 space-y-2 text-sm">
                    <li>• Use a descriptive title that summarizes your note</li>
                    <li>• Break up long content with line breaks for better readability</li>
                    <li>• You can always edit your note later if needed</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>