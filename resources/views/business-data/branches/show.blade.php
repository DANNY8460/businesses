<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('branch') }}: {{ $branch->name ?? '--' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col gap-2">
                    <div class="inline-flex justify-end">
                        <a href="{{ route('businesses.show', $branch->business_id) }}"
                            class="text-gray-500 inline-flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        @if (!empty($branch->images))
                            <div class="flex flex-row gap-1 col-span-2">
                                {{-- <span class="text-gray-500">Logo</span> --}}
                                @foreach ($branch->images as $image)
                                    <span>
                                        <div class="flex flex-row gap-2 items-center">
                                            <div class="overflow-hidden h-20 w-20 rounded-md shadow-sm">
                                                @if (!empty($image->image_path))
                                                    <img src="{{ $image->image }}" alt=""
                                                        class="h-20 w-20 rounded-md object-cover">
                                                @else
                                                    <img src="{{ url('storage/placeholderImg.png') }}" alt=""
                                                        class="h-20 w-20 rounded-md object-cover">
                                                @endif
                                            </div>
                                        </div>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-500">Name</span>
                            <span>{{ $branch->name }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-500">Status</span>
                            <span
                                class="{{ $branch->today_status == 1 ? 'text-green-500' : 'text-red-500' }}">{{ $branch->today_status == 1 ? 'Open' : 'Closed' }}</span>
                        </div>
                    </div>
                    <span class="text-gray-500">Timings</span>
                    @foreach ($branch->workingWeekDays as $day)
                        <div class="w-full">
                            <div class="flex flex-col gap-1">
                                <span class="text-gray-500">{{ Str::ucfirst($day->day) }}</span>
                                <div class="flex flex-row gap-3">
                                    @if ($day->status == 0)
                                        Closed
                                    @else
                                        @foreach ($day->timings as $time)
                                            <div>
                                                {{ Carbon\Carbon::parse($time->start_time)->format('h:i A') . ' - ' . Carbon\Carbon::parse($time->end_time)->format('h:i A') }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
