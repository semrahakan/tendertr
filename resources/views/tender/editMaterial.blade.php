@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> Tender Information</div>
        <div class="panel-body">

            {!! Form::model($tender,['route'=>[ 'materialUpdate' ,$tender->id],'method'=>'PUT']) !!}

            {{ Form::label('materials','Materials:',["class" => 'form-spacing-top']) }}
            {{Form::select('materials[]',$tags,null,['class'=>'selectpicker','multiple'])}}
            <br>

            <div class="row">
                <div class="col-sm-6">
                    {{Form::submit('Save',['class'=> 'btn btn-primary btn-block','name'=>'saveChanges'])}}

                </div>
                <div class="col-sm-6">
                    {!!Html::linkRoute('tender.show','Cancel',array($tender->id),array('class'=>'btn btn-danger btn-block')) !!}
                </div>
            </div>

        </div>

    </div>
@endsection