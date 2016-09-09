@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; "> Tender Information
        {!! Form::model($tender,['route'=>[ 'tender.update' ,$tender->id],'method'=>'PUT','name'=>'UpdateTender','onsubmit'=>'return validateFormTender4()']) !!}
            <br>
            {{Form::label('Number:')}}
            {{Form::text('number',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('name:')}}
            {{Form::text('name',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('type:')}}
            {{Form::text('type',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label('date:')}}
            {{Form::date('date',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label(' method:')}}
            {{Form::text('method',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label(' agreement:')}}
            {{Form::text('agreement',null, ["class" => 'form-control'])}}
            <br>

            {{Form::label('Priority')}}
            <select class="selectpicker" data-live-search="true"  name="priority" style="margin-left: 5px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>


            {{ Form::label('phases_id','Tender Phases:') }}
            {{Form::select('phases_id',$phases,null,["class" => 'selectpicker'])}}
            <br>
            {{Form::label(' state:')}}
            {{Form::text('state',null, ["class" => 'form-control'])}}
            <br>
            {{Form::label(' comment:')}}
            {{Form::textarea('details',null, ["class" => 'form-control', 'size' => '30x5'])}}
            <br>
            <a href="{{ route('material',$tender->id) }}" style="color: darkblue">Change Material List</a>

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
                        {!!Html::linkRoute('tender.show','Cancel',array($tender->id),array('class'=>'btn btn-danger btn-block')) !!}
                    </div>
                </div>
            <div>

            </div>


        {!! Form::close() !!}

</div>
    </div>
    </div>
    <script>
        function validateFormTender4() {
            var x = document.forms["UpdateTender"]["number"].value;
            var y= document.forms["UpdateTender"]["name"].value;
            var z =document.forms["UpdateTender"]["type"].value;

            var t = document.forms["UpdateTender"]["date"].value;
            var a= document.forms["UpdateTender"]["method"].value;
            var b =document.forms["UpdateTender"]["agreement"].value;
            var c= document.forms["UpdateTender"]["priority"].value;

            var d = document.forms["UpdateTender"]["phases_id"].value;
            var e= document.forms["UpdateTender"]["state"].value;
            var f =document.forms["UpdateTender"]["details"].value;

            if (x == null || x == "" || y==null || y=="" || z==null || z=="" || t==""||t==null || a==null || a=="" || b==null || b=="" || c=="" || c==null || d == null || d == "" || e==null || e=="" || f==null || f=="" )  {
                swal("Please write  tender information!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>
@endsection