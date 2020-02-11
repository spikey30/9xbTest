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

        $roleExceeded = false;
        foreach ($employees as $id=>$person) {
            $employee = Employee::find($id);

            $employee->fill([
                'first_name' => $person['firstname'],
                'last_name' => $person['lastname'],
                'email' => $person['email'],
            ]);

            if($employee->job_role != $person['job_role'])
            {
                $count = Employee::where('job_role', $person['job_role'])->count();

                if($count == 4) {
                    $roleExceeded = true;
                    break;
                }
            }
            $employee->job_role = $person['job_role'];
            $employee->save();
        }

        if ($roleExceeded) {
                return redirect('employeeForm')->withErrors([
                    'role' => 'role count exceeded for job role ',
                ]);
        }

        if(!empty($request->input('firstname'))) {

            if (count($employees) == 10) {
                return redirect('employeeForm')->withErrors([
                    'employees' => 'employee limit reached',
                ]);
            }

            $newEmployee = new Employee();
            $newEmployee->fill([
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email' => $request->input('email'),
            ]);

            $count = Employee::where('job_role', $request->input('job_role'))->count();

            if ($count == 4){
                return redirect('employeeForm')->withErrors([
                    'role' => 'role count exceeded for job role '. $request->input('job_role'),
                ]);
            } else {
                $newEmployee->job_role = $request->input('job_role');
            }

            $newEmployee->save();
        }

        return redirect('employeeForm');
    }

    public function delete(Employee $employee)
    {
        if ($employee) {
            $employee->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
