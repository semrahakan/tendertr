@extends('layouts.app')

@section('content')
   <div class="panel panel-default">
            <div class="panel-heading" style="color:darkblue;">File Upload</div>
            <h5>  {{'Please enter a tender name and then select an item that you wish to upload'}}</h5>
            <div class="panel-body" >
                <form action="{{URL::to('/uploadSecond')  }}" method="post" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    <div class="upload-second">
                        {{Form::label(' Tender Name:')}}

                        <select class="selectpicker" name="tender_id">
                            @foreach($tender as $tenders)
                                <option value="{{ $tenders->id }}" > {{ $tenders->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="file">
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                    <input type="submit" value="Submit">
                </form>

            </div>
   </div>
@endsection