@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue"> Material Information</div>
        {!! Form::model($material,['route'=>[ 'materials.update' ,$material->id],'method'=>'PUT','name'=>'UpdateMaterial','onsubmit'=>'return validateFormMaterial()']) !!}


        <br>
            {{Form::label('Name:')}}
            {{Form::text('material_name',null, ["class" => 'form-control','placeholder'=>'material name'])}}
            <br>



            <div class="row">
                <div class="col-sm-6">
                    {{Form::submit('Save',['class'=> 'btn btn-primary btn-block','name'=>'saveChanges'])}}
                </div>
                <div class="col-sm-6">
                    {!!Html::linkRoute('materials.show','Cancel',array($material->id),array('class'=>'btn btn-danger btn-block')) !!}
                </div>
            </div>


        {!! Form::close() !!}
    </div>
    <script>
        function validateFormMaterial() {
            var x = document.forms["UpdateMaterial"]["material_name"].value;

            if (x == null || x == "")  {
                swal("Please write something!", "You cannot submit null items!", "error")
                return false;
            }
            else {
                swal("Good!!", "Your contact has created!", "success")
            }
        }

    </script>


@endsection