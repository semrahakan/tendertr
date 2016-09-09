@extends('layouts.app')
@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading" style="color: darkblue; ">Tender Phases</div>
                    <div class="panel-body" style="color: dimgray">
                        <table class="table table-hover">
                             <thead style="color: #ec971f">

                                <th>Phase</th>
                                <th>View</th>
                             </thead>
                             <tbody>
                             @foreach($phases as $phase)
                                <tr>

                                     <td> {{ $phase->name  }}</td>
                                     <td> <a href="{{route('phases.show', $phase->id)  }}" class="btn btn-primary btn-sm" style='background-color: #ec971f;'> View</a>

                                @endforeach
                             </tbody>
                        </table>
                    </div>
                </div>


    @endsection