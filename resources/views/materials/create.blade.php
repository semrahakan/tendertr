@extends('layouts.app')

@section('content')
    <div class="panel panel-default" >
        <div class="panel-heading"><h4 style="color: darkblue">Material Search</h4> </div>
        <form action="/searchMaterial" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">

                <input type="text" class="form-control" name="searchMaterial" id="searchMaterial"
                       placeholder="Search materials by material name"> <span class="input-group-btn">

            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
            </div>
            <br>
        </form>
        <a href="#material" class="btn btn-default pull-right" data-toggle="modal"> Create a material item >> </a>
        <br>
        @if(isset($details))
            <h3 style="color: darkblue">Material details </h3>
            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
            <table class="table table-hover">
                <thead style="color: #ec971f" class="table-responsive">
                <th>Material Name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody class="table-responsive">

                @foreach($details as $user)

                    <tr>
                        <td>{{$user->material_name}}</td>
                        <td> <div class="col-sm-6">
                                        {!!Html::linkRoute('materials.edit','Edit',array($user->id),array('class'=>'btn btn-primary ','id'=>'test-1')) !!}
                            </div></td>
                        <td>
                            <div class="col-sm-6">
                                {!! Form::open(['route'=>['materials.destroy',$user->id ],'method'=>'DELETE','name'=>'deleteM']) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger','onclick'=>'confirmationdeleteMaterial(event)']) !!}

                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif(isset($message))
            <p>{{ $message }}</p>
        @endif


    <!-- creating a material item modal -->
    <div id="material" class="modal fade">
        <div class="modal-dialog">
            <form action="{{ route ('materials.store') }}" method="post" name="form4"  onsubmit="return validateFormMaterial()">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Material Items</h4>
                    </div>
                    <div class="modal-body">
                        <p>Create A Material Item</p>
                        <label> Material Name:</label>
                        <input class="form-control" name="material_name">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-default"  type="submit" name="Create" value="Create" id="create">
                            Create </button>

                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                </div>
            </form>
        </div>
        <div>

        </div>
    </div>
    </div>
    <script>

        $("#searchMaterial").autocomplete({
            source: "{{route('autocompletematerial')}}",
            minLength: 3,
            select: function(event, ui) {
                $("#searchMaterial").val(ui.item.value);
            }
        });

    </script>
    <script>
        function confirmationdeleteMaterial(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>

    <script>
        function validateFormMaterial() {
            var x = document.forms["form4"]["material_name"].value;

            if (x == null || x == "" ) {
                swal("Please write a material name!", "You cannot submit null items!", "error")
                return false;
            }

        }
    </script>
@endsection