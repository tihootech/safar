<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Gallery;
use App\Models\User;

use Illuminate\Validation\Rule;
use App\Rules\NationalCode as NationalCodeRule;


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
            'employees.*.national_code' => ['required', new NationalCodeRule],
            'employees.*.access_type' => ['required', Rule::in(['COUNSELER', 'MANAGER'])],
            'employees.*.rate' => 'nullable|integer',
            'employees.*.phone' => 'required|string',
            'employees.*.email' => 'required|email|string',
            'employees.*.info' => 'nullable|string',
        ]);

        // validate uniqueness of email and national code for each employee
        foreach ($request->employees as $key => $employee) {
            $employee_id = $employee['id'] ?? 0;
            $employee_user_id = $employee['user_id'] ?? 0;
            $request->validate([
                "employees.$key.email" => "unique:employees,email,$employee_id|unique:users,email,$employee_user_id",
                "employees.$key.national_code" => "unique:employees,national_code,$employee_id",
            ]);
        }

        // create or update agency instance
        $agencyData = $request->agency;
        unset($agencyData['employees']);
        $agency = Agency::updateOrCreate(['id' => $aid], $agencyData);

        // create or update employees
        foreach ($request->employees as $employeeData) {

            // if not on edit mode create a new user for this employee
            if (!isset($employeeData['id'])) {
                $user =  User::create([
                    'name' => $employeeData['first_name'] . ' ' . $employeeData['last_name'],
                    'email' => $employeeData['email'],
                    'phone' => $employeeData['phone'],
                    'password' => bcrypt($employeeData['national_code']),
                    'type' => $employeeData['access_type'],
                ]);
                $employeeData['user_id'] = $user->id;
            }else { // if on edit mode, then update user info as well
                $employee = Employee::find($employeeData['id']);
                if ($empUser = $employee->user) {
                    $empUser->update([
                        'name' => $employeeData['first_name'] . ' ' . $employeeData['last_name'],
                        'email' => $employeeData['email'],
                        'phone' => $employeeData['phone'],
                        'type' => $employeeData['access_type'],
                    ]);
                }
            }

            // prepare other data for employee
            $employeeData['agency_id'] = $agency->id;
            $employeeData['schedule'] = (isset($employeeData['hours']) && is_array($employeeData['hours'])) ? implode('&', $employeeData['hours']) : '';
            $employeeData['available_visas'] = (isset($employeeData['vlist']) && is_array($employeeData['vlist'])) ? implode(',', $employeeData['vlist']) : '';
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
        if ($request->deletelist && count($request->deletelist)) {
            $employeesDeleteList = Employee::WhereIn('id', $request->deletelist)->get();
            foreach ($employeesDeleteList as $employeeToBeDeleted) {
                User::where('id', $employeeToBeDeleted->user_id)->delete();
                $employeeToBeDeleted->delete();
            }
        }

        // delete files from db and storage
        parent::deleteFiles($request);

        return ['success' => true];
    }

    public function destroy(Agency $agency)
    {
        $employees = Employee::where('agency_id', $agency->id)->get();
        foreach ($employees as $employee) {
            User::where('id', $employee->user_id)->delete();
            $employee->delete();
        }
        $agency->delete();
        return ['success' => true];
    }
}
