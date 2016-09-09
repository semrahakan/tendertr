@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">
                    <dl class="dl-vertical">
                        <dt>Created at:</dt>
                        <dd> {{date('M j, Y h:ia',strtotime($municipality->created_at))}}</dd>
                    </dl>
                    <dl class="dl-vertical">
                        <dt>Last Updated</dt>
                        <dd> {{date('M j, Y h:ia',strtotime($municipality->updated_at))}}</dd>
                    </dl>
                    <hr>
            Municipality Information

        </div>
        <div class="panel-body" style="color: dimgray">
        {!! Form::model($municipality,['route'=>[ 'municipality.update' ,$municipality->id],'method'=>'PUT','name'=>'UpdateMun','onsubmit'=>'return validateFormMun2()']) !!}
            <br>
            {{Form::label('Name:')}}
            {{Form::text('muniName',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('Adress:')}}
            {{Form::text('address',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('City:')}}
            {{Form::text('city',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('Phone:')}}
            {{Form::text('phone',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('Person Name:')}}
            {{Form::text('personName',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('Person Phone:')}}
            {{Form::text('personPhone',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('Person Email:')}}
            {{Form::text('personMail',null, ["class" => 'form-control'])}}
            <br>
            <div class="row">
                <div class="col-sm-6">
                    {{Form::submit('Save',['class'=> 'btn btn-primary btn-block','name'=>'saveChanges'])}}
                </div>
                <div class="col-sm-6">
                    {!!Html::linkRoute('municipality.show','Cancel',array($municipality->id),array('class'=>'btn btn-danger btn-block')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <script>
        function validateFormMun2() {
            var x = document.forms["UpdateMun"]["muniName"].value;
             var y= document.forms["UpdateMun"]["address"].value;
            var z =document.forms["UpdateMun"]["city"].value;

            var t = document.forms["UpdateMun"]["phone"].value;
            var a= document.forms["UpdateMun"]["personName"].value;
            var b =document.forms["UpdateMun"]["personPhone"].value;
            var c= document.forms["UpdateMun"]["personMail"].value;

            if (x == null || x == "" || y==null || y=="" || z==null || z=="" || t==""||t==null || a==null || a=="" || b==null || b=="" || c=="" || c==null )  {
                swal("Please write  municipalities information!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>
@endsection