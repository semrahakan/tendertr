@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Send Email</div>
        <div class="panel-body">
            {!! Form::model($contact,['route'=>['sendEmailContact',$contact->id],'name'=>'sendEmail','method'=>'POST','onsubmit'=>'return validateFormMail()']) !!}

            {{Form::label(' title:')}}
            {{Form::text('title',null, ["class" => 'form-control',"name" =>'title'])}}
            <br>

            {{Form::label(' contactEmail:','receiver:')}}

            {{Form::text('contactEmail',null, ["class" => 'form-control',"name" =>'contactEmail' ])  }}

            <br>
            <br>
            {{Form::label(' content:')}}
            {{Form::textarea('contents',null, ["class" => 'form-control',"name" =>'contents',''])}}

            <br>
            {{Form::submit('Send',['class'=> 'btn btn-primary btn-block'])}}

            {!! Form::close() !!}

        </div>
    </div>


    <script>
        function validateFormMail() {
            var x = document.forms["sendEmail"]["contactEmail"].value;
            var y= document.forms["sendEmail"]["contents"].value;
            var t= document.forms["sendEmail"]["title"].value;
            if (x == null || x == "" || y==null || y=="" || t==null || t=="")  {
                swal("Please write something!", "You cannot submit null items!", "error")
                return false;
            }


        }

    </script>

@endsection