<div>
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                Add Grading Component
            </h2>
        </div>
        <p class="text-gray-600">Manage your grading components and their weight percentages</p>
    </div>

    <!-- Progress Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-700">Total Percentage</p>
                    <p class="text-2xl font-bold text-blue-900 mt-1">{{ $totalPercentage }}%</p>
                </div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="h-2 bg-blue-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: {{ $totalPercentage }}%"></div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-700">Remaining</p>
                    <p class="text-2xl font-bold text-green-900 mt-1">{{ $remaining }}%</p>
                </div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="h-2 bg-green-200 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full" style="width: {{ $remaining }}%"></div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-purple-700">Components</p>
                    <p class="text-2xl font-bold text-purple-900 mt-1">{{ count($criteriaList) }}</p>
                </div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs font-medium {{ count($criteriaList) < 3 ? 'text-yellow-600' : 'text-purple-600' }}">
                    {{ count($criteriaList) < 3 ? '⚠️ Need ' . (3 - count($criteriaList)) . ' more' : '✅ Minimum reached' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(count($criteriaList) < 3)
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex items-center gap-3 animate-pulse">
            <svg class="w-5 h-5 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm text-yellow-700 font-medium">
                Minimum of 3 grading components required. Add {{ 3 - count($criteriaList) }} more components.
            </p>
        </div>
    @endif

    @if($remaining <= 0 && count($criteriaList) > 0)
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm text-red-700 font-medium">
                Total grading percentage already reached 100%. You cannot add more components.
            </p>
        </div>
    @endif

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Column: Livewire Form -->
        <div>
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                    </svg>
                    Add New Component
                </h3>
                
                <!-- LIVEWIRE FORM - ITO LANG ANG GAMITIN -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Component Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                wire:model="name"
                                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                                       focus:ring-2 focus:ring-purple-500 focus:border-transparent 
                                       transition-all duration-200 {{ $remaining <= 0 ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                placeholder="e.g., Quiz, Activity, Exam, Project"
                                {{ $remaining <= 0 ? 'disabled' : '' }}
                            >
                        </div>
                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-medium text-gray-700">
                                Percentage (%)
                            </label>
                            <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-1 rounded">
                                Max: {{ $remaining }}%
                            </span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 a1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input
                                type="number"
                                wire:model="weight"
                                min="1"
                                max="{{ $remaining }}"
                                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                                       focus:ring-2 focus:ring-purple-500 focus:border-transparent
                                       transition-all duration-200 {{ $remaining <= 0 ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                placeholder="Enter percentage"
                                {{ $remaining <= 0 ? 'disabled' : '' }}
                            >
                        </div>
                        @error('weight') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Slide to adjust:</span>
                            <input type="range" 
                                   min="1" 
                                   max="{{ $remaining }}" 
                                   wire:model="weight"
                                   class="w-32 accent-purple-600"
                                   {{ $remaining <= 0 ? 'disabled' : '' }}>
                            <span class="font-medium text-purple-600">{{ $weight ?: 1 }}%</span>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button
                            wire:click="addComponent"
                            wire:loading.attr="disabled"
                            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 
                                   hover:from-purple-700 hover:to-indigo-700 text-white font-semibold 
                                   rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 
                                   transition-all duration-200 flex items-center justify-center gap-2
                                   {{ $remaining <= 0 ? 'opacity-50 cursor-not-allowed grayscale' : '' }}"
                            {{ $remaining <= 0 ? 'disabled' : '' }}
                        >
                            <span wire:loading.remove wire:target="addComponent">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Component
                            </span>
                            <span wire:loading wire:target="addComponent">
                                <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Adding...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Existing Components -->
        <div>
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Existing Components
                        <span class="text-sm font-normal bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                            {{ count($criteriaList) }}
                        </span>
                    </h3>
                </div>

                @if(count($criteriaList) == 0)
                    <div class="text-center py-12">
                        <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No components added yet</p>
                        <p class="text-gray-400 text-sm mt-1">Start by adding your first grading component</p>
                    </div>
                @else
                    <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                        @foreach($criteriaList as $index => $c)
                            <div class="group bg-gray-50 hover:bg-blue-50 border border-gray-200 
                                        rounded-xl p-4 transition-all duration-200 hover:shadow-sm
                                        hover:border-blue-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center 
                                                    {{ $index % 3 == 0 ? 'bg-purple-100 text-purple-600' : 
                                                       ($index % 3 == 1 ? 'bg-blue-100 text-blue-600' : 
                                                       'bg-green-100 text-green-600') }}">
                                            <span class="font-bold">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $c->component_name }}</h4>
                                            <div class="flex items-center gap-2 mt-1">
                                                <div class="w-32 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                    <div class="h-full {{ $index % 3 == 0 ? 'bg-purple-500' : 
                                                                           ($index % 3 == 1 ? 'bg-blue-500' : 
                                                                           'bg-green-500') }} rounded-full" 
                                                         style="width: {{ $c->percentage }}%">
                                                    </div>
                                                </div>
                                                <span class="text-sm font-semibold 
                                                            {{ $index % 3 == 0 ? 'text-purple-600' : 
                                                               ($index % 3 == 1 ? 'text-blue-600' : 
                                                               'text-green-600') }}">
                                                    {{ $c->percentage }}%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button wire:click="deleteComponent({{ $c->id }})" 
                                            wire:confirm="Are you sure you want to delete this component?"
                                            class="opacity-0 group-hover:opacity-100 p-2 text-gray-400 
                                                   hover:text-red-500 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Total Percentage Summary -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-700">Total Weight</span>
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-2 bg-gray-300 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full" 
                                         style="width: {{ $totalPercentage }}%">
                                    </div>
                                </div>
                                <span class="font-bold text-gray-900">{{ $totalPercentage }}%</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Close Button -->
    <div class="mt-6 flex justify-end">
        <button
            type="button"
            id="closeCriteriaModal2"
            class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl 
                   hover:bg-gray-50 transition-all duration-200 hover:shadow-sm"
        >
            Close
        </button>
    </div>
</div>