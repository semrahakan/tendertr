
@extends('layouts.app')

@section('content')
    <div class="panel panel-default" >
        <div class="panel-heading" style="color: darkblue">Create an account</div>
    <div class="panel-body">
        <form action="{{ route ('signup') }}" method="post" name="admin" onsubmit="return validateInputs()">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name" id="name" placeholder="username" > <br>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"  > <br>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" > <br>
            <button class="btn btn-lg btn-primary " name="accountBtn" id="Register" value="Register" type="submit" style="background-color:#ec971f;">
                Register</button>
        </form>
    </div>
</div>


    <script>
        function validateInputs() {

            var x = document.forms["admin"]["name"].value;
            var y = document.forms["admin"]["email"].value;
            var z = document.forms["admin"]["password"].value;


            if( x == null || x == "" || y==null || y=="" || z == null || z == "" ) {
                swal("Please write user informations !", "Your form has not been submitted", "error")
            }
        }
    </script>
@endsection