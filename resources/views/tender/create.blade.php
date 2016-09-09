@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue; ">Tender Information</div>
        <div class="panel-body" style="color: dimgray">
            {!! Form::open(['route'=>['tender.store'],'method'=>'POST','name'=>'CreateForm','onsubmit'=>'return validateFormTender()']) !!}

            {{Form::label(' Tender Number:')}}
            {{Form::text('number',null, ["class" => 'form-control',"name" =>'number',"id" =>'number'])}}

            {{Form::label(' Tender Name:')}}
            {{Form::text('name',null, ["class" => 'form-control',"name" =>'name',"id" =>'name'])}}

            {{Form::label(' Tender Type:')}}
            {{Form::text('type',null, ["class" => 'form-control',"name" =>'type',"id" =>'type'])}}


            {{Form::label(' Tender Date:')}}
            {{Form::date('date',null, ["class" => 'form-control',"name" =>'date',"id" =>'date'])}}

            {{Form::label(' Tender Method:')}}
            {{Form::text('method',null, ["class" => 'form-control',"name" =>'method',"id" =>'method'])}}

            {{Form::label(' Tender agreement:')}}
            {{Form::text('agreement',null, ["class" => 'form-control',"name" =>'agreement',"id" =>'agreement'])}}

            <br>
            {{Form::label('Priority')}}
            <select class="selectpicker" data-live-search="true"  name="priority" style="margin-left: 5px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>

            {{Form::label('phases_id','Tender Phases')}}
            <select class="selectpicker" data-live-search="true" style="margin-left: 5px" id="phases_id" name="phases_id"  >
                @foreach($phases as $phase)

                    <option value="{{ $phase->id }}" > {{ $phase->name }}</option>

                @endforeach

            </select>

            <br>

            {{Form::label('Tender state')}}
            <textarea class="form-control" rows="3" name="state"></textarea>


            <label>Comment:</label>
            <textarea class="form-control" rows="5" name="details"></textarea>
            <br>

            {{Form::label('user_id','User assign')}}
            <select class="selectpicker" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" > {{ $user->name }}</option>
                @endforeach
            </select>
            <a data-toggle="collapse" href="#collapse1">Wish to assign second user?</a>
            <div id="collapse1" style="margin-top: -3%; margin-left: 55%">

                <select class="selectpicker" name="user_id2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" > {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>

            <br>
            {{Form::label('material_list','Material List:')}}
            <select class="selectpicker" multiple  name="material_list[]" data-live-search="true" data-selected-text-format="count > 3">
                @foreach($material as $materials)
                    <option value="{{ $materials->id }}" > {{ $materials->material_name }}</option>
                @endforeach
            </select>
            <br>
            <input type="hidden"  name="created_user_id">
            <input type="hidden"  name="mun_id">
            <br>
            {{Form::submit('Send',['class'=> 'btn btn-primary','id'=>'send','style'=>'background-color: #ec971f;','onclick'=>'functionCreate()'])}}


            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue;"> <h5>File Upload </h5></div>
        <div class="panel-body" style="color: dimgray">
            <label>Please select an item that you wish to upload</label>
            <form action="{{URL::to('/upload')  }}" method="post" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                <input type="hidden" name="file">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <script>
        function  validateFormTender() {
            var x = document.forms["CreateForm"]["number"].value;
            var y= document.forms["CreateForm"]["name"].value;
            var z =document.forms["CreateForm"]["type"].value;

            var t = document.forms["CreateForm"]["date"].value;
            var a= document.forms["CreateForm"]["method"].value;
            var b =document.forms["CreateForm"]["agreement"].value;
            var c= document.forms["CreateForm"]["priority"].value;

            var d = document.forms["CreateForm"]["phases_id"].value;
            var e= document.forms["CreateForm"]["state"].value;
            var f =document.forms["CreateForm"]["details"].value;
            var g = document.forms["CreateForm"]["material_list[]"].value;

            if (x == null || x == "" || y==null || y=="" || z==null || z=="" || t==""||t==null || a==null || a=="" || b==null || b=="" || c=="" || c==null || d == null || d == "" || e==null || e=="" || f==null || f=="" ||g == null || g == "" )  {
                swal("Please write  tender information!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>
@endsection

