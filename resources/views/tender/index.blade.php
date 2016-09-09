@extends('layouts.app')

@section('content')
    <div class="panel panel-default" >
        <div class="panel-heading"><h3 style="color: darkblue">TENDERS</h3>
            <a href="{{ url('/getExport2') }}" class="btn btn-info" >Export To Excel</a>
            <a href="{{url('fileentry')}}" class="btn btn-success" data-toggle="modal">Upload Item</a>
            <div class="col-sm-3">
                <form action="/searchTender" method="post" id="frmsearch" class="form-horizontal">
                    <div class="input-group">
                        <input type="text" name="searchTender" class="form-control" placeholder="Search By Name" id="searchTender">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            {{ csrf_field() }}
                        </span>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div class="panel-body">
        @foreach($tender as $tenders)
            @if($tenders->user_id == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id || $tenders->user_id2 == Auth::user()->id)
                <div class="tender">
                    <div class="tender-comment">
                        {{Form::label('Tender Name:')}}
                        {{ $tenders->name }}
                        <a href="{{route('tender.show', $tenders->id)  }}" class="btn btn-default btn-sm"> View</a>
                        <a href="{{route('tender.edit', $tenders->id)}}" id="editt" class="btn btn-default btn-sm"> Edit</a>
                        <br>
                        {{Form::label('Municipality Name:')}}
                        @foreach( $municipality as $municipalities)
                            @if( $tenders->municipality_id == $municipalities->id)
                                {{ $municipalities->muniName }}
                            @endif
                        @endforeach
                    </div>
                    <div class="tender-content">
                        <div class="upload-item">
                            @foreach($entries as $entry)
                                @if( $entry->tender_id == $tenders->id)
                                    {{Form::label('Uploaded Item:')}}
                                    <a href="{{route('getentry', $entry->original_filename)}}">{{$entry->original_filename}} </a>
                                    <a href="{{ route('/deleteFile', $entry->id) }}" style="color: #ec971f" onclick="confirmationdeleteFile(event)"> Delete</a>

                                @endif
                            @endforeach
                        </div>
                        <article style="border: ridge">
                            <p style="margin: 2%">
                                {{Form::label('Number:')}}
                                {{ $tenders->number }}<br>

                                {{Form::label('Type:')}}
                                {{ $tenders->type }}<br>
                                {{Form::label('Date:')}}
                                {{ $tenders->date }}<br>

                                {{Form::label('Method:')}}
                                {{ $tenders->method }}<br>
                                {{Form::label('Agreement:')}}
                                {{ $tenders->agreement }}<br>

                                {{Form::label('Priority:')}}
                                {{ $tenders->priority }}<br>
                                {{Form::label('State:')}}
                                {{ $tenders->state }}<br>
                                {{Form::label('Phase In:')}}
                                @foreach( $phase as $phases)
                                    @if( $tenders->phases_id == $phases->id )
                                        {{ $phases->name }}
                                    @endif
                                @endforeach
                            </p>
                            

                                </article>

                            </div>
                        </div>

                @endif

        @endforeach
    </div>
    <div class="text-center">
        {!! $tender->links() !!}
    </div>
    <script>

        $("#searchTender").autocomplete({
            source: "{{route('autocompleteTender')}}",
            minLength: 3,
            select: function(event, ui) {
                $("#searchTender").val(ui.item.value);
            }
        });

    </script>
    <script>

        function confirmationdeleteFile(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>

@endsection

