<form action="employeeForm" method="post">
    @csrf
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email Address</th>
            <th>Job Role</th>
            <th>Delete</th>
        </tr>
        @if($employees)
        @foreach($employees as $i=>$employee)
        <tr>
            <td><input type="text" name="people[{{$employee->id}}][firstname]" value="{{$employee->first_name}}" /></td>
            <td><input type="text" name="people[{{$employee->id}}][lastname]" value="{{$employee->last_name}}" /></td>
            <td><input type="text" name="people[{{$employee->id}}][email]" value="{{$employee->email}}" /></td>
            <td><input type="text" name="people[{{$employee->id}}][job_role]" value="{{$employee->job_role}}" /></td>
            <td><input type="checkbox" name="people[{{$employee->id}}][delete]" value="1" id="{{$i}}" /></td>
        </tr>
        @endforeach

        <tr>
            <td><input type="text" name="newPerson[firstname]" placeholder="Add new..." /></td>
            <td><input type="text" name="newPerson[lastname]" placeholder="Add new..." /></td>
            <td><input type="text" name="newPerson[email]" placeholder="Add new..." /></td>
            <td><input type="text" name="newPerson[jobrole]" placeholder="Add new..." /></td>
        </tr>
    </table>
    {{ $employees->links() }}
    @endif
    <input type="submit" value="Submit!" />
</form>
