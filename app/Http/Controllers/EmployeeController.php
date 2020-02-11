<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\AddUpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employeeForm', ['employees' => $employees]);
    }

    public function update(AddUpdateEmployeeRequest $request)
    {
        $employees = $request->input('employee');

        foreach ($employees as $id=>$person) {
            $employee = Employee::find($id);

            $employee->fill([
                'first_name' => $person['firstname'],
                'last_name' => $person['lastname'],
                'email' => $person['email'],
            ])
            ->save();
        }

        if(!empty($request->input('firstname'))) {
            $employee = new Employee();
            $employee->fill([
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email' => $request->input('email'),
                'job_role' => $request->input('jobrole'),
            ]);

            $employee->save();
        }

        return redirect('employeeForm');
    }
}
