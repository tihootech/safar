<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Gallery;

class AgencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return Agency::all();
    }

    public function getEmployees($aid)
    {
        return Employee::where('agency_id', $aid)->get();
    }

    public function getAgency($aid)
    {
        return Agency::where('id', $aid)->with('employees', 'first_picture', 'logo')->first();
    }

    public function upsert(Request $request)
    {

        // validate incoming data
        $aid = $request->agency['id'] ?? 0;

        $request->validate([
            'agency.name' => 'required|string',
            'agency.latin_name' => 'required|string',
            'agency.manager_name' => 'nullable|string',
            'agency.manager_phone' => 'nullable|string',
            'agency.itguy_name' => 'nullable|string',
            'agency.itguy_phone' => 'nullable|string',
            'agency.license_type' => 'nullable|string',
            'agency.website' => 'nullable|string',
            'agency.email' => 'nullable|string',
            'agency.brief_info' => 'nullable|string',
            'agency.full_info' => 'nullable|string',
            'agency.address' => 'nullable|string',
            'agency.phones' => 'nullable|string',
            'employees.*.first_name' => 'required|string',
            'employees.*.last_name' => 'required|string',
            'employees.*.national_code' => 'nullable|string',
            'employees.*.access_type' => 'nullable|string',
            'employees.*.available_licenses' => 'nullable|string',
            'employees.*.rate' => 'nullable|integer',
            'employees.*.phone' => 'nullable|string',
            'employees.*.email' => 'nullable|string',
            'employees.*.info' => 'nullable|string',
        ]);

        // create or update agency instance
        $agencyData = $request->agency;
        unset($agencyData['employees']);
        $agency = Agency::updateOrCreate(['id' => $aid], $agencyData);

        // create or update employees
        foreach ($request->employees as $employeeData) {
            $employeeData['user_id'] = 0;
            $employeeData['agency_id'] = $agency->id;
            Employee::updateOrCreate(['id' => $employeeData['id'] ?? 0], $employeeData);
        }

        // track uploaded files in db, if any
        if ($request->gallery && count($request->gallery)) {
            foreach ($request->gallery as $galleryData) {
                $galleryData['owner_type'] = Agency::class;
                $galleryData['owner_id'] = $agency->id;
                $galleryData['name'] = $galleryData['name'];
                Gallery::create($galleryData);
            }
        }

        // delete those in delete list
        parent::deleteRows($request, Employee::class);

        // delete files from db and storage
        parent::deleteFiles($request);

        return ['success' => true];
    }

    public function destroy(Agency $agency)
    {
        Employee::where('agency_id', $agency->id)->delete();
        $agency->delete();
        return ['success' => true];
    }
}
