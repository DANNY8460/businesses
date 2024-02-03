<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Branch') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="branchHandler">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col gap-2">
                    <div class="inline-flex justify-end">
                        <a href="{{ route('businesses.show', $business->id) }}"
                            class="text-gray-500 inline-flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="max-w-3xl">
                        <form method="post" action="{{ route('businesses.branches.store', $business->id) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="images" :value="__('Images')" />
                                <x-text-input id="images" name="images[]" type="file" class="mt-1 block w-full"
                                    autocomplete="images" accept=".jpg,.png" multiple="multiple" />
                                <x-input-error :messages="$errors->get('images')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <div class="flex justify-between items-end mb-2">
                                    <span class="text-gray-500">Timings</span>
                                </div>
                                <div class=" space-y-4">
                                    {{-- <span x-text="JSON.stringify(timings)"></span> --}}
                                    <template x-for="(timing, day) in timings" key="day">
                                        <div class="grid grid-cols-6 gap-2 ">
                                            <div>
                                                <input type="checkbox"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                    :name="'timings[' + day + '][checked]'" x-model="timing.checked"
                                                    x-bind:id="day">
                                                <label x-text="day" x-bind:for="day"></label>
                                            </div>
                                            <div class="col-span-5 flex justify-between" x-show="timing.checked">
                                                <div>
                                                    <template x-for="(time, index) in timing.times" key="index">
                                                        <div class="flex flex-row ">
                                                            <div class="grid grid-cols-3 gap-1 ">
                                                                <x-text-input id="logo" name="logo"
                                                                    type="time" class="mt-1 block "
                                                                    x-model="time.start_time"
                                                                    x-bind:name="`timings[${day}][times][${index}][start_time]`" />
                                                                <span
                                                                    class="inline-flex justify-center items-center text-lg">-</span>
                                                                <x-text-input id="logo" name="logo"
                                                                    x-model="time.end_time" type="time"
                                                                    class="mt-1 block "
                                                                    x-bind:name="`timings[${day}][times][${index}][end_time]`" />
                                                            </div>
                                                            <div x-show="index !== 0" class="inline-flex justify-end">
                                                                <button type="button" class="text-red-500"
                                                                    @click="removeTiming(day,index)">Remove</button>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                                <div class="">
                                                    <button @click="addTiming(day)" type="button"
                                                        class="inline-flex justify-end items-center text-lg">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="flex gap-2 flex-row items-center justify-end">
                                <a href="{{ route('businesses.show', $business->id) }}"
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
    <script>
        function branchHandler() {
            return {
                timings: <?php echo json_encode($timings); ?>,
                addTiming(day) {
                    if (this.timings[day] !== undefined) {
                        this.timings[day].times = [...this.timings[day].times, [
                            start_time => '',
                            end_time => '',
                        ]];
                    }
                },
                removeTiming(day, key) {
                    if (this.timings[day] !== undefined) {
                        this.timings[day].times = this.timings[day].times.filter((time, index) => index !== key);
                    }
                }
            };
        }
    </script>
</x-app-layout>
