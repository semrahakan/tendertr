@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading" style="color: darkblue"><h4>Send Email</h4> </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>['sendEmail'],'method'=>'POST','name'=>'emailsend']) !!}

                        {{Form::label(' title:')}}
                        {{Form::text('title',null, ["class" => 'form-control',"name" =>'title'])}}
                            <br>

                        {{Form::label(' receiver:')}}
                        {{Form::text('receiver',null, ["class" => 'form-control',"name" =>'receiver',"id" =>'receiver'])}}
                            <br>
                            <br>
                        {{Form::label(' content:')}}
                        {{Form::textArea('contents',null, ["class" => 'form-control'])}}
                            <br>
                        {{Form::submit('Send',['class'=> 'btn btn-primary ','onclick'=>'myFunction()'])}}

                        {!! Form::close() !!}

                    </div>
                </div>



    <script>
        function myFunction() {

            var x = document.forms["emailsend"]["receiver"].value;

            if (x == null || x == "") {
                swal("Please write an email adress!!", "Your email  has not been sent", "error")
            }
        }
    </script>

@endsection