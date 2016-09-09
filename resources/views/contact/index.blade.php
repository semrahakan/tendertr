@extends('layouts.app')
@section('content')
    <div class="panel panel-default ">
        <div class="panel-heading" style="color: darkblue; ">All Contacts
            <a href="#contact2" class="btn btn-default pull-right" data-toggle="modal"> Create a contact>> </a>
        </div>
        <div class="panel-body " style="color: dimgray">
            <table class="table">
                <thead style="color: #ec971f">
                <tr>
                    <th></th>
                    <th>Contact Details</th>

                </tr>
                </thead>
                <tbody>
                @foreach($contact as $contacts)
                    <tr>
                        <th> <a href="{{ route('contact.show',$contacts->id) }}"><i class="fa fa-envelope" aria-hidden="true" style="color: #ec971f"> </i> </a></th>
                        <td> {{$contacts->contactName}} <br >
                          <a style="color: orange">{{ 'phone:' }} </a>
                        {{ $contacts->contactPhone}}
                       <br>
                         <a style="color: orange"> {{ ' email:' }}</a>
                        {{ $contacts->contactEmail}}<br>
                         <a style="color: orange">{{' address'}} </a>
                         {{$contacts->address}}
                            <br>
                        <div class="col-xs-6" style="margin-left: -15%">
                                {!! Form::open(['route'=>['contact.destroy',$contacts->id ],'method'=>'DELETE','name'=>'deleteM']) !!}

                                {!! Form::submit('Delete',['class'=>'btn btn-danger','id'=>'btn-submit','name'=>'btn-submit','onclick'=>'confirmationdeleteContact(event)']) !!}

                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- contact modal -->
        <div id="contact2" class="modal fade">
            <div class="modal-dialog">
                <form action="{{ route ('contact.store') }}" method="post" name="form3"  onsubmit="return validateFormContract()">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Contact</h4>
                        </div>
                        <div class="modal-body">
                            <p>Create A Contact</p>
                            <label> Contact Name:</label>
                            <input class="form-control" name="contactName">
                            <label> Contact Phone:</label>
                            <input class="form-control" name="contactPhone">
                            <label> Contact Email:</label>
                            <input class="form-control" name="contactEmail">
                            <label> Contact Address:</label>
                            <input class="form-control" name="address">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-default"  type="submit" name="createContact" id="create" value="createContact">
                                Create </button>

                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateFormContract() {
            var x = document.forms["form3"]["contactName"].value;
            var y= document.forms["form3"]["contactPhone"].value;
            var z =document.forms["form3"]["contactEmail"].value;
            var t =document.forms["form3"]["address"].value;
            if (x == null || x == "" || y==null || y=="" || z==null || z=="" || t==null || t=="") {
                swal("Please write something!", "You cannot submit null items!", "error")
                return false;
            }

        }
    </script>

    <script>
        function confirmationdeleteContact(e) {
            var answer = confirm("Are you sure?")
            if (!answer) {
                e.preventDefault();
                return false;
            }
        }
    </script>
@endsection

