<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\Country;
use App\Models\Gallery;

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
        return Country::where('id', $cid)->with('visas')->with('gallery')->first();
    }

    public function upsert(Request $request)
    {
        // check policy
        $this->authorize('manage', Visa::class);

        // validate incoming data
        $cid = $request->country['id'] ?? 0;
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

        // create or update country instance
        $countryData = $request->country;
        unset($countryData['visas'], $countryData['gallery']);
        $country = Country::updateOrCreate(['id' => $cid], $countryData);

        // create or update visas
        foreach ($request->visas as $visaData) {
            $visaData['country_id'] = $country->id;
            $visaData['counselings'] = implode(',', $visaData['counselings']);
            Visa::updateOrCreate(['id' => $visaData['id'] ?? 0], $visaData);
        }

        // track uploaded files in db, if any
        if ($request->gallery && count($request->gallery)) {
            foreach ($request->gallery as $galleryData) {
                $galleryData['owner_type'] = Country::class;
                $galleryData['owner_id'] = $country->id;
                Gallery::create($galleryData);
            }
        }

        return ['success' => true];
    }

    public function destroy(Country $country)
    {
        Visa::where('country_id', $country->id)->delete();
        $country->delete();
        return ['success' => true];
    }
}
