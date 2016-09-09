@extends('layouts.app')

@section('content')
    @if(isset($details))
        <h2>Contact details</h2>
        <p> The Search results for your query <b> {{ $query }} </b> are :</p>
            <table class="table">
                <thead style="color: #ec971f">
                <th></th>
                <th>Contact Name</th>
                <th>Contact Details
                Delete</th>
                </thead>
                <tbody>
                @foreach($details as $user)
                    <tr>
                        <th> <a href="{{ route('contact.show',$user->id) }}"><i class="fa fa-envelope" aria-hidden="true" style="color: #ec971f"> </i> </a></th>

                        <td>{{$user->contactName}}</td>
                        <td> {{'Phone;' }} {{$user->contactPhone  }} <br>
                         {{ 'Email;' }}    {{$user->contactEmail}} <br>
                           {{'Address;'}} {{$user->address  }} <br>
                        <div class="col-xs-6" style="margin-left: -4%" >
                               {!! Form::open(['route'=>['contact.destroy',$user->id ],'method'=>'DELETE','name'=>'deleteM']) !!}

                               {!! Form::submit('Delete',['class'=>'btn btn-danger','id'=>'btn-submit','name'=>'btn-submit','onclick'=>'confirmationdeleteContact2(event)']) !!}

                               {!! Form::close() !!}
                           </div></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @elseif(isset($message))
                <p>{{ $message }}</p>
            @endif


    <script>
        function confirmationdeleteContact2(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>

@endsection