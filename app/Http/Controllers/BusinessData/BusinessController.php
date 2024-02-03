<?php

namespace App\Http\Controllers\BusinessData;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $businesses = Business::/*withWhereHas('branches', function ($q) {
            $q->with(['images', 'workingWeekDays']);
        })->*/get();
        return view('business-data.businesses.index', compact('businesses'));
    }

    /**
     * Create business
     *
     */
    public function create(Request $request)
    {
        return view('business-data.businesses.create');
    }

    /**
     * Store business data
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string', 'max:18'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg']
        ]);

        $requestData = $request->except('logo');

        if ($request->file('logo') && !empty($request->logo)) {
            $name = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/business-logos', $name);
            $requestData['logo_path'] = 'business-logos/' . $name;
        }

        Business::create($requestData);
        return redirect()->intended(route('businesses.index'));
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
        $business = Business::with(['branches'])->findOrFail($id);
        return view('business-data.businesses.show', compact('business'));
    }

    /**
     * Delete the business
     *
     */
    public function destroy($id)
    {
        Business::destroy($id);
        return redirect()->intended(route('businesses.index'));
    }
}
