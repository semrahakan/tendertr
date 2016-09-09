@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">All Municipalities</div>
        <div class="panel-body" style="color: dimgray">
            <table class="table">
                <thead style="color: #ec971f">
                <th>Municipality Name</th>
                <th>Employer's Name</th>
                <th>View/Edit</th>
                </thead>
                <tbody>
                @foreach($list as $lists)
                    <tr>
                        <td>{{$lists->muniName}}</td>
                        <td>{{$lists->personName}}</td>
                        <td><a href="{{route('municipality.show', $lists->id)  }}" class="btn btn-default btn-sm"> View</a>
                            <a href="{{route('municipality.edit', $lists->id)}}" class="btn btn-default btn-sm"> Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $list->links() !!}
        </div>
    </div>


@endsection