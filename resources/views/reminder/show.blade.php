
@extends('layouts.app')

@section('content')

    <div class="panel panel-default" runat="server">
        <div class="panel-heading" style="color: darkblue; ">
            <h4 style="color:darkblue">The Reminder is</h4>
        </div>
        <div class="panel-body" style="color: dimgray" runat="server">
            <div class="well">
               <article >{{ $reminder->user_reminder }} </article>
            </div>
            <div class="row">
                <div class="col-sm-6" runat="server">

                    {!! Form::open(['route'=>['reminder.destroy',$reminder->id ],'method'=>'DELETE']) !!}

                    {!! Form::submit('Delete',['class'=>'btn btn-danger btn-block','id'=>'send','onclick'=>'confirmationdeleteReminder(event)','value' =>'delete']) !!}

                    {!! Form::close() !!}

                </div>
                <div class="col-sm-6" runat="server">
                    <a href="{{url('indexReminder')}}" class="btn btn-primary btn-block">Cancel</a>
                </div>
            </div>


        </div>
    </div>

    <script>
        function confirmationdeleteReminder(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>

    <script>
        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
    </script>
@endsection