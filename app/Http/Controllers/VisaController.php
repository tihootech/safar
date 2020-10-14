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

    public function getCountry($cid)
    {
        return Country::where('id', $cid)->with('visas')->first();
    }

    public function upsert(Request $request)
    {
        $this->authorize('manage', Visa::class);
        $cid = $request->country['id'];
        $request->validate([
            'country.fa_name' => 'required|unique:countries,fa_name,'.$cid,
            'country.latin_name' => 'required|unique:countries,latin_name,'.$cid,
            'country.iso_code' => 'required|string|size:2|unique:countries,iso_code,'.$cid,
            'country.country_code' => 'required|unique:countries,country_code,'.$cid,
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

        $countryData = $request->country;
        unset($countryData['visas']);
        $country = Country::updateOrCreate($countryData);
        foreach ($request->visas as $visa) {
            $visa['country_id'] = $country->id;
            // $visa['counselings'] = implode(',', $visa['counselings']);
            $visa['first_picture'] = '...';
            Visa::updateOrCreate($visa);
        }

        return ['success' => true];
    }

    public function destroy(Country $country)
    {
        if ($country->visas->count()) {
            $country->visas->delete();
        }
        $country->delete();
        return ['success' => true];
    }
}
