<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Business') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col gap-2">
                    <div class="inline-flex justify-end">
                        <a href="{{ route('businesses.index') }}" class="text-gray-500 inline-flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="max-w-xl">
                        <form method="post" action="{{ route('businesses.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="logo" :value="__('Logo')" />
                                <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full"
                                    autocomplete="logo" accept=".jpg,.png" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"
                                    autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" name="phone_number" type="text"
                                    class="mt-1 block w-full" autocomplete="phone_number" />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 flex-row items-center justify-end">
                                <a href="{{ route('businesses.index') }}"
                                    class="border border-red-400 rounded-md bg-transparent text-red-400 px-4 py-2 hover:bg-red-400 hover:text-white">Discard</a>
                                <button
                                    class=" rounded-md px-6 py-2 bg-green-600 hover:bg-green-500 text-white">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
