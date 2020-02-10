<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employeeForm', ['employees' => $employees]);
    }

    public function update(Request $request)
    {
        $people = $request->input('people');
        $newPerson = $request->input('newPerson');

        foreach ($people as $id=>$person) {
            $employee = Employee::find($id);

            $employee->fill([
                'first_name' => $person['firstname'],
                'last_name' => $person['lastname'],
                'email' => $person['email'],
            ])
            ->save();
        }

        if(!empty($request->input('newPerson'))) {
            $employee = new Employee();
            $employee->fill([
                'first_name' => $newPerson['firstname'],
                'last_name' => $newPerson['lastname'],
                'email' => $newPerson['email'],
                'job_role' => $newPerson['jobrole'],
            ]);

            $employee->save();
        }
        return redirect('employeeForm');
    }
}
