<form action="employeeForm" method="post">
    @csrf
    @if($errors->any())
        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
    @endif
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
            <td><input type="text" name="employee[{{$employee->id}}][firstname]" value="{{$employee->first_name}}" /></td>
            <td><input type="text" name="employee[{{$employee->id}}][lastname]" value="{{$employee->last_name}}" /></td>
            <td><input type="text" name="employee[{{$employee->id}}][email]" value="{{$employee->email}}" /></td>
            <td><input type="text" name="employee[{{$employee->id}}][job_role]" value="{{$employee->job_role}}" /></td>
            <td><input type="checkbox" name="employeedelete" value="1" id="{{$employee->id}}" /></td>
        </tr>
        @endforeach

        <tr>
            <td><input type="text" name="firstname" placeholder="Add new..." /></td>
            <td><input type="text" name="lastname" placeholder="Add new..." /></td>
            <td><input type="text" name="email" placeholder="Add new..." /></td>
            <td><input type="text" name="job_role" placeholder="Add new..." /></td>
        </tr>
    </table>
    {{ $employees->links() }}
    @endif
    <input type="submit" value="Submit!" />
</form>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(document).ready( function () {


    $(document).on("click",'input[type=checkbox]',function(e){
        if (confirm('Are you sure you want to delete this ?')) {
            var id = this.id;
            $.ajax({
                url: 'employee/delete/'+id,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response){
                    location.reload();
                },
                error: function (err) {
                    console.log(err);
                }
            });
        } else {
            return false;
        }
    });
    });
</script>
