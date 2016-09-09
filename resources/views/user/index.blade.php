
@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> User List </div>
        <div class="panel-body" style="color: dimgray">
            <table class=" table" >
                <thead style="color: #ec971f">

                <th>User Name</th>

                <th>Delete User?</th>
                </thead>
                <tbody>

                @foreach($user as $users)
                    <tr>

                        <td>{{$users->name}} <br>
                            {{'Joined At:'}}
                       {{date('M j,Y', strtotime( $users->created_at))}}


                            <a href="{{route('makeAdmin' ,$users->id)}}"  class="btn-sm btn-primary">Make/Destroy user as admin?</a>
                        </td>
                        <td><div class="col-sm-6">
                                {!! Form::open(['route'=>['user.destroy',$users->id ],'method'=>'DELETE','name'=>'deleteM']) !!}

                                {!! Form::submit('Delete',['class'=>'btn btn-danger','onclick'=>'confirmationUser(event)']) !!}

                                {!! Form::close() !!}
                            </div></td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <script>

        function confirmationUser(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }

    </script>
    @endsection