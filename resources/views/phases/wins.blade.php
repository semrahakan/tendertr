@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h3 style="color: darkblue">Winned Tenders</h3></div>
        <table class="table">
            <thead style="color: #ec971f">
            <th>Tender Name</th>
            <th></th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach($tender as $tenders)

                <tr>
                    @if( $tenders->phases->name== 'Wins')
                        @if($tenders->user_id == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id)
                            <td>   {{$tenders->name  }}</td>
                                <td>
                                @foreach($user as $users)
                                {{'Created By;'}}
                                @if( $tenders->created_user_id == $users->id)
                                    {{ $users->name}}
                                    @endif<br>
                                        {{ 'Assigned Users;' }}
                                        @if( $tenders->user_id == $users->id)
                                            {{$users->name  }}
                                        @endif <br>
                                        @if( $tenders->user_id2 == $users->id)
                                            {{$users->name  }}
                                        @endif
                                @endforeach
                            </td>
                            <td>
                                            <div class="col-sm-6">
                                                {!! Form::open(['route'=>['tender.destroy',$tenders->id ],'method'=>'DELETE','name'=>'deleteM']) !!}

                                                {!! Form::submit('Delete',['class'=>'btn btn-danger','id'=>'btn-submit','name'=>'btn-submit','onclick'=>'confirmation(event)']) !!}

                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    @endif
                                @endif
                             </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


@endsection