@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> Reminders</div>
        <div class="panel-body" style="color: dimgray" >
            @foreach ($reminder as $reminders)
                @if( $reminders->user_id == Auth::user()->id)
                    @if($reminders->id == DB::table('reminders')->max('id') )
                        <label> <p style="color: darkblue"> The last created reminder is; </p></label>
                    {{ $reminders->user_reminder }}
                        @endif
                @endif
            @endforeach
        </div>
    </div>

@endsection