<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }}: {{ $business->name ?? '--' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                    <div class="grid grid-cols-2 gap-2">
                        @if (!empty($business->logo_path))
                            <div class="flex flex-col gap-1 col-span-2">
                                {{-- <span class="text-gray-500">Logo</span> --}}
                                <span>
                                    <div class="flex flex-row gap-2 items-center">
                                        <div class="overflow-hidden h-20 w-20 rounded-md shadow-sm">
                                            @if (!empty($business->logo_path))
                                                <img src="{{ $business->logo }}" alt=""
                                                    class="h-20 w-20 rounded-md object-cover">
                                            @else
                                                <img src="{{ url('storage/placeholderImg.png') }}" alt=""
                                                    class="h-20 w-20 rounded-md object-cover">
                                            @endif
                                        </div>
                                    </div>
                                </span>
                            </div>
                        @endif
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-500">Name</span>
                            <span>{{ $business->name }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-500">Email</span>
                            <span>{{ $business->email }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-500">Phone</span>
                            <span>{{ $business->phone_number }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-gray-500">Branches</span>
                            <a href="{{ route('businesses.create') }}"
                                class="bg-gray-500 text-white py-2 px-4 hover:bg-gray-400 rounded-md">+ Add Branch</a>
                        </div>
                        <table class="table-auto w-full">
                            <thead class="bg-gray-300">
                                <tr>
                                    <td class="p-2">Name</td>
                                    <td class="p-2 flex flex-row justify-end">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($business->branches as $branch)
                                    <tr class="hover:bg-gray-100">
                                        <td class="p-2">
                                            {{ $branch->name }}
                                        </td>
                                        <td class="p-2">
                                            <div class="flex flex-row justify-end gap-2">
                                                {{-- <div>
                                                    <a href="{{ route('businesses.show', $business->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 text-gray-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <form method="post"
                                                    action="{{ route('businesses.destroy', $business->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 text-red-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="hover:bg-gray-100">
                                        <td colspan="4" class="p-2">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
