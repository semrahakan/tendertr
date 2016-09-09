@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> Tender Information
            {!! Form::model($tender,['route'=>[ 'phaseUpdate' ,$tender->id],'method'=>'PUT']) !!}
            <br>

            <br>
            {{ Form::label('phases_id','Tender Phases:') }}
            {{Form::select('phases_id',$phases,null,["class" => 'selectpicker'])}}
            <br>
        </div>
        <div class="panel-body" style="color: dimgray">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd> {{date('M j, Y h:ia',strtotime($tender->created_at))}}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated</dt>
                    <dd> {{date('M j, Y h:ia',strtotime($tender->updated_at))}}</dd>
                </dl>
                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        {{Form::submit('Save',['class'=> 'btn btn-primary btn-block','name'=>'saveChanges'])}}

                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('tender.index') }}" class="btn btn-danger btn-block"> Cancel</a>

                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
@endsection