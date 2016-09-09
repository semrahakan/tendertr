@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> Make or destory an admin </div>
        <div class="panel-body" style="color: dimgray">
            {!! Form::model($user,['route'=>[ 'admin' ,$user->id],'method'=>'PUT']) !!}
            <br>
            {{Form::label(' Please select yes or no')}}
            <select class="selectpicker" name="admin">
                 <option value="0">No</option>
                <option value="1">Yes</option>
             </select>
            <div class="row">
                <div class="col-sm-6">
                    {{Form::submit('Save',['class'=> 'btn btn-primary','name'=>'saveChanges'])}}
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('indexUser') }}" class="btn btn-danger">Cancel</a>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection