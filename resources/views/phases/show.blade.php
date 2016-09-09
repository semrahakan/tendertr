@extends('layouts.app')

@section('content')
    <div class="panel panel-default ">
        <div class="panel-heading panel-success" style="color: darkblue; "> Tender Phase</div>
        <div class="panel-body " style="color: dimgray">
            <div class="well">
                <table class="table table-hover">
                    <thead>

                        <th> Tender Name</th>
                        <th> Tender Type /Change</th>

                    </thead>
                    <tbody>
                    @foreach($tender as $tenders)
                        <tr>
                            @if($tenders->phases_id == $phase->id)
                                <td>
                                    {{ $tenders->name }}
                                </td>
                            <td>
                                {{$tenders->type}}
                                <br>
                                {!!Html::linkRoute('phaseEdit','Change',array($tenders->id),array('class'=>'btn btn-primary ','id'=>'test-1')) !!}

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


