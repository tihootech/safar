<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\Country;
use App\Models\Gallery;

class VisaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return Country::all();
    }

    public function allVisas()
    {
        return Visa::all();
    }

    public function getVisas($cid)
    {
        return Visa::where('country_id', $cid)->get();
    }

    public function getCountry($cid)
    {
        return Country::where('id', $cid)->with('visas', 'gallery')->first();
    }

    public function upsert(Request $request)
    {
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
            Visa::updateOrCreate(['id' => $visaData['id'] ?? 0], $visaData);
        }

        // track uploaded files in db, if any
        if ($request->gallery && count($request->gallery)) {
            foreach ($request->gallery as $galleryData) {
                $galleryData['owner_type'] = Country::class;
                $galleryData['owner_id'] = $country->id;
                $galleryData['name'] = $galleryData['name'] ?? null;
                Gallery::create($galleryData);
            }
        }

        // delete those in delete list
        parent::deleteRows($request, Visa::class);

        // delete files from db and storage
        parent::deleteFiles($request);

        return ['success' => true];
    }

    public function destroy(Country $country)
    {
        Visa::where('country_id', $country->id)->delete();
        $country->delete();
        return ['success' => true];
    }
}
