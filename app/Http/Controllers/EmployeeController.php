<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('counseler');
    }

    public function updateSchedule(Request $request)
    {
        $employee = user('employee');
        if ($employee) {
            $employee->schedule = implode('&', $request->all());
            $employee->save();
            return ['success' => true];
        }else {
            abort(404);
        }
    }
}
