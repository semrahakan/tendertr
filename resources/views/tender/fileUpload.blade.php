
@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">Detailed Tender Information</div>
        <div class="panel-body" style="color: dimgray">
            <div class="well">
                <label>Please select an item that you wish to upload</label>
                <form action="{{URL::to('/upload')  }}" method="post" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    <input type="hidden" name="file">
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                    <input type="submit" >
                </form>
            </div>
        </div>
    </div>

@endsection