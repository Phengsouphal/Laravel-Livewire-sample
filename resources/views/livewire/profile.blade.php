<div>
    <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>

    <form wire:submit.prevent="save">
        <div class="mt-6 sm:mt-5 space-y-6">

            <div>
                @if ($saved)
                <div id="toast-success"
                    class="flex items-center p-2 mb-4 w-full  text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <div
                        class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ml-3 text-sm font-normal">Saved successfully.</div>
                    <button type="button" wire:click="$set('saved', false)"
                        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                @endif
            </div>

            <x-input.group label="Name" for="name" :error="$errors->first('name')">
                <x-input.text wire:model="user.name" name="name" id="name" leading-add-on="kakak.com/" />
            </x-input.group>


            <x-input.group label="Birthday" for="birthday">
                <x-input.date wire:model="user.birthday" id="birthday" name="birthday" placeholder="MM/DD/YYYY" />
            </x-input.group>

            <x-input.group label="Description" for="description">
                <x-input.textarea :initial-value="$description" wire:model.lazy="description" id="description"
                    name="description" />
                <p class="mt-2 text-sm text-gray-500">Write a few sentences description yourself.</p>

            </x-input.group>

            <x-input.group label="About" for="about" :error="$errors->first('about')">
                <x-input.rich-text wire:model.defer="user.about" name="about" id="about" />
                <p class="mt-2 text-sm text-gray-500">Write a few sentences about yourself.</p>

            </x-input.group>

            <x-input.group label="upload" for="upload" :error="$errors->first('upload')">

                <x-input.avatar wire:model="upload" id="upload">

                    <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                        @if ($upload)
                        <img src="{{$upload->temporaryUrl()}} " alt="">
                        @else
                        <img src="{{auth()->user()->avatarUrl()}}" alt="">
                        @endif

                    </span>

                </x-input.avatar>
            </x-input.group>


            {{-- newAvatars.* for multiple files --}}
            <x-input.group label="Photo" for="photo">
                <x-input.filepond wire:model="files" multiple />
            </x-input.group>

            <x-input.group label="Photo" for="photo">
                <div wire:model.lazy="count">
                    <input type="text">
                    Count:
                    <button type="button" x-data="{ count: 0}" @click="count++; $dispatch('change', count)"
                        x-text="count">0</button>
                </div>

                Livewire Count : {{$count}}


                <div wire:model.debounce="testing">
                    <input type="text">

                    Livewire Count : {{$testing}}

                </div>
            </x-input.group>

        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="space-x-3 flex justify-end items-center">
                <span x-data="{ open: false }" x-init="
                        @this.on('notify-saved', () => {
                            if (open === false) setTimeout(() => { open = false }, 2500);
                            open = true;
                        })
                    " x-show.transition.out.duration.1000ms="open" style="display: none;"
                    class="text-gray-500">Saved!</span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </button>
                </span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>