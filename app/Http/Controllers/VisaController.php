<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\Country;

class VisaController extends Controller
{

    public function index()
    {
        return Country::all();
    }

    public function getVisas($cid)
    {
        return Visa::where('country_id', $cid)->get();
    }

    public function store(Request $request)
    {
        $this->authorize('manage', Visa::class);
        $request->validate([
            'country.fa_name' => 'required',
            'country.latin_name' => 'required',
            'country.iso_code' => 'required|string|size:2',
            'country.country_code' => 'required',
            'country.lang' => 'required',
            'country.local_name' => 'required',
            'country.brief_info' => 'nullable',
            'country.full_info' => 'nullable',
            'visas.*.name' => 'required',
            'visas.*.latin_name' => 'required',
            'visas.*.type' => 'required',
            'visas.*.quiz' => 'required',
            'visas.*.counselings' => 'required',
        ]);

        $country = Country::create($request->country);
        foreach ($request->visas as $visa) {
            $visa['country_id'] = $country->id;
            $visa['counselings'] = implode(',', $visa['counselings']);
            $visa['first_picture'] = '...';
            Visa::create($visa);
        }

        return ['success' => true];
    }
}
