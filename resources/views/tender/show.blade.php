
@extends('layouts.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">Detailed Tender Information</div>
        <div class="panel-body" style="color: dimgray">
            <div class="well">
                <dl class="dl-vertical">
                        <dt>Created at:</dt>
                        <dd> {{date('M j, Y h:ia',strtotime($tender->created_at))}}</dd>
                </dl>
                <dl class="dl-vertical" style="margin-left: 20%; margin-top: -7%">
                        <dt>Last Updated</dt>
                        <dd> {{date('M j, Y h:ia',strtotime($tender->updated_at))}}</dd>
                </dl>
                <div class="col-sm-1" style="margin-top: -2%">
                    {!!Html::linkRoute('tender.edit','Edit',array($tender->id),array('class'=>'btn btn-primary ','id'=>'test-1')) !!}

                </div>
                <div class="col-sm-1" style="margin-top: -2%">
                    {!! Form::open(['route'=>['tender.destroy',$tender->id ],'method'=>'DELETE']) !!}

                    {!! Form::submit('Delete',['class'=>'btn btn-danger','id'=>'send','onclick'=>'confirmationdeleteTender(event)']) !!}

                    {!! Form::close() !!}
                </div>
                <div class="col-md-2" style="margin-top: -2%; margin-left: 2%">
                    <input type="button"  class="btn btn-success" id="btn" value="Print" onclick="printDiv();">
                   
              
                </div>
            </div>
            <div class="well" id="divprint">

               <h3 style="color:darkblue">Tender Information</h3>

                {{Form::label('number:')}}
                {{ $tender->number }}
                <br>
                {{Form::label('name:')}}
                {{ $tender->name }}<br>
                {{Form::label('type:')}}
                {{ $tender->type}}<br>
                {{Form::label('date:')}}
                {{$tender->date  }}<br>
                {{Form::label('method:')}}
                {{ $tender->method  }}<br>
                {{Form::label('aggreement:')}}
                {{ $tender->aggreement }}<br>
                {{Form::label('priority:')}}
                {{$tender->priority }}<br>

                {{Form::label('state:')}}
                {{$tender->state }}<br>

                {{Form::label('comment:')}}
                {{$tender->details }}<br>
                    <h3 style="color: darkblue"> Municipality Information</h3>
                    {{Form::label('municipality name:')}}

                    {{$tender->municipality->muniName }}
                    <br>
                    {{Form::label('municipality address:')}}

                    {{$tender->municipality->address }}<br>


                    {{Form::label('municipality city:')}}

                    {{$tender->municipality->city }}<br>

                    {{Form::label('municipality phone:')}}

                    {{$tender->municipality->phone }}<br>

                    {{Form::label('municipality person name:')}}

                    {{$tender->municipality->personName }}<br>

                    {{Form::label('municipality person mail:')}}

                    {{$tender->municipality->personMail }}<br>

                    {{Form::label('tender phase:')}}
                    {{$tender->phases->name }}<br>

                    {{Form::label('material list:')}}
                    @foreach($tender->material as $materials)
                        <span class="label label-default">{{$materials->material_name}}</span>
                    @endforeach

                    <hr>

                </div>
            </div>
        </div>
    <script>
        function confirmationdeleteTender(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>

    <script>
        function printDiv()
        {

            var divToPrint=document.getElementById('divprint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divprint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);

        }
    </script>

@endsection