@extends('layouts.app')
@section('content')
    <div class="panel panel-default" >
        <div class="panel-heading" style="color: darkblue; background-color: #A5DC86">Users updated these:</div>
        <div class="panel-body"style="color: dimgray">
            <div class="update-user">
                @foreach($tender as $tenders)
                    @if( ! empty( $tenders ->updated_user_id))
                        @if( $tenders ->user_id == Auth::user()->id || $tenders ->user_id2 == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id )
                            @foreach($user as $users)
                                @if($tenders->updated_user_id == $users->id )
                                    <div class="tender">
                                        <div class="author-info">
                                            <img src="/uploads/avatars/{{ $users->avatar }}"  class="author-image">
                                            <div class="author-name">
                                                <h4>{{ $users->name }} </h4>

                                                <p class="author-time">
                                                    {{ 'Updated time:' }}

                                                    {{date('M j,Y', strtotime( $tenders->updated_at))}}
                                                </p>
                                            </div>

                                        </div>
                                        <div class="tender-content">
                                            <p class="update-content">
                                                {{ 'Updated this:' }}

                                            <a href="{{route('tender.show', $tenders->id)  }}" > {{ $tenders->name}}</a> </p>


                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="panel-heading" style="background-color: #ce8483; color: darkblue">Important Tenders</div>
        <div class="panel-body">
            <div class="well">
                <table class="table">
                    <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tender as $tenders)
                        <tr>
                            @if( $tenders ->user_id == Auth::user()->id || $tenders ->user_id2 == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id  )
                            @if($tenders->priority == "1")
                                    @if(strtotime($tenders->date) > strtotime($today))


                                        <td> <p class="tender-home">{{ 'Tender Name' }}</p> <p>{{ $tenders->name }} </p></td>
                                        <td>  <p class="tender-home">{{ 'Due to:' }} </p>
                                            {{date('M j,Y', strtotime(  $tenders->date)) }}
                                        </td>
                                        <td>
                                            @foreach( $user as $users)
                                                @if($tenders->created_user_id == $users->id )
                                                    <p class="tender-home">{{'Created By'}}</p> {{ $users->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                             @endif
                        @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-heading" style="color: black; background-color: orange">Reminders
           </div>
        <div class="panel-body" style="color: dimgrey">
            <table class="table">
                <thead style="color: #ec971f">
                <th>Reminder</th>
                <th>Delete</th>

                </thead>
                <tbody>
                @foreach($reminder as $reminders)
                    @if($reminders->user_id ==  Auth::user()->id )
                        <tr>
                            <td>
                                {{ substr($reminders->user_reminder,0,20 )}} {{ strlen($reminders->user_reminder)>20 ?"...":"" }}
                                    <button class="btn btn-default btn-detail open_modal" value="{{$reminders->id}}">View</button>
                            </td>

                            <td>  {!! Form::open(['route'=>['reminder.destroy',$reminders->id ],'method'=>'DELETE']) !!}

                                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

                                    {!! Form::close() !!}
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>


        <div class="panel-heading" style="background-color:#ffe45c; color: darkblue">Todays Tenders </div>
        <div class="panel-body">

            <table class="table">
                <thead style="color: #ec971f">
                <th>Tender Name</th>
                <th>Created By</th>
                </thead>
                <tbody>
                @foreach($tender as $tenders)
                    <tr>
                        @if( $tenders ->user_id == Auth::user()->id || $tenders ->user_id2 == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id  )

                            @if( date('M j, Y',strtotime($tenders->date)) == date('M j, Y',strtotime($today)) )
                                <td> {{ $tenders->name }}</td>
                                <td>
                                    @foreach( $user as $users)
                                        @if($tenders->created_user_id == $users->id )
                                            <img src="/uploads/avatars/{{ $users->avatar }}"  class="author-image">   {{ $users->name }}
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reminder</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <label for="inputDetail" class="col-sm-3 control-label">Reminder</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="user_reminder" name="user_reminder" placeholder="details" value=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <meta name="_token" content="{!! csrf_token() !!}" />



    <script src="{{asset('js/ajaxscript.js')}}"></script>


@endsection

