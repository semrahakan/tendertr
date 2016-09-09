@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    @if(isset($details))
        <div class=" panel-heading">Tender details< </div>
        <p> The Search results for your query <b> {{ $query }} </b> are :</p>
    <div class="panel-body">
        <table class="table">
            <thead style="color: #ec971f">
            <th>#</th>
            <th>Municipality Name</th>
            <th> Tender Name </th>
            <th> Phase In: </th>
            <th>Created At</th>
            <th>View/Edit</th>
            <th>Assigned Users</th>
            <th>Created By</th>

            <th>Uploaded File Name:</th>
            </thead>
            <tbody>
            @foreach($details as $tenders)
                <tr>
                    <th>{{ $tenders ->id }} </th>
                    @foreach($municipality as $muni )
                        @if($muni->id == $tenders->municipality_id)
                            <td>{{ $muni->muniName }} </td>
                        @endif
                    @endforeach
                    <td>{{ $tenders ->name }} </td>
                    @foreach($phase as $phases)
                        @if($tenders->phases_id == $phases->id)
                            <td> {{ $phases->name }} </td>
                        @endif
                    @endforeach
                    <td>{{date('M j,Y', strtotime( $tenders->created_at))}}</td>
                    <td><a href="{{route('tender.show', $tenders->id)  }}" class="btn btn-default btn-sm"> View</a>
                        <a href="{{route('tender.edit', $tenders->id)}}" id="editt" class="btn btn-default btn-sm"> Edit</a></td>
                    @foreach($user as $users)
                        @if( $users->id == $tenders->user_id   )
                            <td>
                           {{ $users ->name }}
                        @elseif($users->id == $tenders->user_id2 )
                           {{ $users ->name }}
                            </td>
                        @endif

                        @if( $users->id == $tenders ->created_user_id)
                                    <td>{{ $users ->name }} </td>
                                @endif
                            @endforeach
                            @foreach($entries as $entry)
                                @if( $entry->tender_id == $tenders->id)
                                    <td>
                                        <a href="{{route('getentry', $entry->filename)}}">{{$entry->original_filename}} </a>
                                        <a href="{{ route('/deleteFile', $entry->id) }}" style="color: #ec971f"> Delete</a>

                                    </td>
                                @endif
                            @endforeach

                        </tr>

                    @endforeach

                    </tbody>
                </table>
            @elseif(isset($message))
                <p>{{ $message }}</p>
            @endif

    </div>


</div>
@endsection