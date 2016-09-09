@extends('layouts.app')
@section('content')
    <div class="panel panel-default ">
        <div class="panel-heading panel-success" style="color: darkblue; "> Change Tender Phase</div>
        <div class="panel-body " style="color: dimgray">
            <div class="well">
                <table class="table">
                    <thead style="color: #ec971f">
                    <th> {{Form::label('Tender name:')}}</th>
                    <th>  {{Form::label('Tender type:')}} </th>
                    <th> Edit </th>
                    </thead>
                    <tbody>
                    @foreach($tender as $tenders)
                        <tr>
                            @if($tenders->phases_id ==$tenders->phases->id)
                                <td> {{ $tenders->name }} </td>
                                <td>  {{$tenders->type}} </td>
                                <td>
                                    <div class="col-sm-1" style="margin-top: -2%">
                                        {!!Html::linkRoute('phaseEdit','Edit',array($tenders->id),array('class'=>'btn btn-primary ','id'=>'test-1')) !!}
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


