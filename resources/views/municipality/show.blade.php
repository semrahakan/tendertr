@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">Municipality Information
            <dl class="dl-vertical">
                <dt>Created at:</dt>
                <dd> {{date('M j, Y h:ia',strtotime($municipality->created_at))}}</dd>
            </dl>
            <dl class="dl-vertical">
                <dt>Last Updated</dt>
                <dd> {{date('M j, Y h:ia',strtotime($municipality->updated_at))}}</dd>
            </dl>
        </div>
        <div class="panel-body" style="color: dimgray">
            <div class="well">

                {{Form::label('Name:')}}
                {{ $municipality->muniName }}
                <br>
                {{Form::label('Adress:')}}
                {{ $municipality->address }}<br>
                {{Form::label('City:')}}
                {{ $municipality->city }}<br>
                {{Form::label('Phone:')}}
                {{ $municipality->phone  }}<br>
                {{Form::label('Person Name:')}}
                {{ $municipality->personName  }}<br>
                {{Form::label('Person Phone:')}}
                {{ $municipality->personPhone }}<br>
                {{Form::label('Person Email:')}}
                {{ $municipality->personMail }}<br>

                <hr>

                <div class="row">
                    <div class="col-sm-6" id="edit">
                        {!!Html::linkRoute('municipality.edit','Edit',array($municipality->id),array('class'=>'btn btn-primary ')) !!}

                    </div>

                </div>
            </div>
        </div>


    </div>

    <script>
        function confirmationdeleteMun(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>
@endsection