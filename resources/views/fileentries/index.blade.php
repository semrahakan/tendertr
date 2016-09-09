@extends('layouts.app')
@section('content')
    <div class="col-md-offset-0" style="margin-top: 20%">
    <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
        <input type="file" name="filefield">
        <input type="submit">
        <input type="hidden" value="{{ Session::token() }}" name="_token">
    </form>
    </div>
    <h1> Pictures list</h1>
    <div class="row">
        <ul class="thumbnails">
            @foreach($entries as $entry)
                <div class="col-md-2">
                    <div class="thumbnail">
                        <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" />
                        <a href="{{route('getentry', $entry->filename)}}" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Download Brochure </a>
                        <div class="caption">
                            <p> {{$entry->original_filename}} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
    @endsection