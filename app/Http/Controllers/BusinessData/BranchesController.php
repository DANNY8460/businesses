<?php

namespace App\Http\Controllers\BusinessData;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Business;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Create business
     *
     */
    public function create(Request $request, $id)
    {
        $business = Business::findOrFail($id);
        $timings = [
            'sun' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'mon' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'tue' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'wed' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'thu' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'fri' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
            'sat' => [
                'checked' => false,
                'times' => [[
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->addMinutes(30)->format('H:i'),
                ]]
            ],
        ];
        return view('business-data.branches.create', compact('business', 'timings'));
    }

    /**
     * Store business data
     *
     */
    public function store(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $business = Business::findOrFail($id);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'file', 'mimes:png,jpg'],
            'timings' => ['required', 'array']
        ]);

        $requestData = $request->except('images');
        $requestData['business_id'] = $business->id;

        $branch = Branch::create($requestData);

        if ($request->timings && count($request->timings) > 0) {
            foreach ($request->timings as $day => $timing) {
                $status = isset($timing['checked']) ? 1 : 0;
                $workingDay = $branch->workingWeekDays()->create(['day' => $day, 'status' => $status]);
                if (isset($timing['times']) && count($timing['times']) > 0 && $status) {
                    foreach ($timing['times'] as $times) {
                        $workingDay->timings()->create($times);
                    }
                }
            }
        }

        if ($request->file('images') && !empty($request->images)) {
            foreach ($request->file('images') as $key => $file) {
                $name = \Str::random().time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/branch-images', $name);
                $path = 'branch-images/' . $name;
                $branch->images()->create(['image_path' => $path]);
            }
        }
        return redirect()->intended(route('businesses.show', $business->id));
    }

    /**
     *
     *
     */ /**
     * Store business data
     *
     */
    public function show($id)
    {
        $branch = Branch::with(['images','workingWeekDays' => fn ($q) => $q->with('timings')])->findOrFail($id);
        return view('business-data.branches.show', compact('branch'));
    }

    /**
     * Delete the business
     *
     */
    public function destroy($id)
    {
        Branch::destroy($id);
        return redirect()->back();
    }
}
