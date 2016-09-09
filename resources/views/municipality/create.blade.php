@extends('layouts.app')

@section('content')
                <div class="panel panel-default ">
                    <div class="panel-heading panel-success" style="color: darkblue; ">Municipality Information</div>
                    <div class="panel-body " style="color: dimgray">
                        {!! Form::open(['route'=>['municipality.store'],'method'=>'POST','name'=>'muniSend','onsubmit'=>'return validate()']) !!}

                        {{Form::label(' Municipality Name:')}}
                        {{Form::text('muniName',null, ["class" => 'form-control',"name" =>'muniName',"id" =>'muniName'])}}

                        {{Form::label(' Address:')}}
                        {{Form::text('address',null, ["class" => 'form-control',"name" =>'address',"id" =>'address'])}}

                        {{Form::label(' City:')}}
                        {{Form::text('city',null, ["class" => 'form-control',"name" =>'city',"id" =>'city'])}}


                        {{Form::label('Municipality Phone:')}}
                        {{Form::text('phone',null, ["class" => 'form-control',"name" =>'phone',"id" =>'phone'])}}

                        {{Form::label(' Person Name:')}}
                        {{Form::text('personName',null, ["class" => 'form-control',"name" =>'personName',"id" =>'personName'])}}

                        {{Form::label(' Person Phone')}}
                        {{Form::text('personPhone',null, ["class" => 'form-control',"name" =>'personPhone',"id" =>'personPhone'])}}

                        {{Form::label(' Person Email')}}
                        {{Form::text('personMail',null, ["class" => 'form-control',"name" =>'personMail',"id" =>'personMail'])}}
                        <br>
                        {{Form::submit('Submit',['class'=> 'btn btn-primary','id'=>'send','style'=>'background-color: #ec971f;','value'=>'Send'])}}


                        {!! Form::close() !!}
                    </div>

                </div>


    <script>
        function validate() {

            var x = document.forms["muniSend"]["muniName"].value;
            var y = document.forms["muniSend"]["personMail"].value;
            var z = document.forms["muniSend"]["personPhone"].value;
            var t = document.forms["muniSend"]["personName"].value;
            var a = document.forms["muniSend"]["phone"].value;
            var b = document.forms["muniSend"]["city"].value;
            var c = document.forms["muniSend"]["address"].value;
            var d = document.forms["muniSend"]["muniName"].value;

            if( x == null || x == "" || y==null || y=="" || z == null || z == "" || t==null || t=="" || a == null || a == "" || b==null || b==""|| c == null || c == "" || d==null || d=="" ) {
                swal("Please write items!!", "Your form has not been submitted", "error")
            }
        }
    </script>

@endsection



