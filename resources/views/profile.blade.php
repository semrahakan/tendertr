@extends('layouts.app')

@section('content')
        <div class="panel panel-default">
            <div class="panel-heading" style="color:darkblue">Change Your User Data</div>
            <div class="panel-body" style="color: darkblue">
                <div class="well">
                    <label> Update Profile Picture</label>
                     <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float: right;border-radius: 50%; margin-right: 25px;margin-top: -1%">
                        <form enctype="multipart/form-data" action="/profile" method="post" onsubmit= "validateFormPicture()" name="picture">
                            <input type="file" name="avatar" id="avatar" value="choose a file" placeholder="choose a file"><br>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <input type="submit" class="btn btn-primary "  value="Update Profile Picture" id="btn-submit">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                                <br>
                                <div class="col-sm-6" style="margin-top: 5%">
                                    <a href="{{ route('/deleteImage',$user->id) }}" class="btn btn-danger " onclick="confirmationdeletePicture(event)">Delete Profile Picture</a>

                                </div>
                            </div>
                        </form>
                    <br>
                        </div>
<br>
                <div class="well">

                {!! Form::model($user,['route'=>[ 'user.update' ,$user->id],'method'=>'PUT','onsubmit'=>'return validateFormName()','name'=>'changeName'],array('files'=> true))!!}
                    <div class="form-group" style="color: darkblue;">
                         <label for="first_name">Update User Name</label>
                        <input type="text" name="name" class="form-control" style="width: 50%" value=" {{ $user->name }}" id="name" placeholder="user name">
                     </div>

                    <button type="submit" class="btn btn-success ">Change Username</button>
                     <input type="hidden" value="{{ Session::token() }}" name="_token">

                {!! Form::close() !!}
                </div>
            </div>
    </div>

        <script>

            function confirmationdeletePicture(e) {
                var answer = confirm("Are you sure?")
                if (!answer) {
                    e.preventDefault();
                    return false;
                }
            }
        </script>
        <script>
            function validateFormName() {
                var x = document.forms["changeName"]["name"].value;

                if (x == null || x == "" ) {
                    swal("Please write a user name!", "You cannot submit null items!", "error")
                    return false;
                }

            }
        </script>

@endsection