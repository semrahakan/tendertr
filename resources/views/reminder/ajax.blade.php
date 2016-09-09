@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="color: darkblue">All Reminders
            <a href="#reminder2" class="btn btn-default pull-right" data-toggle="modal"> Create a reminder>> </a>
        </div>
        <div class="panel-body" >
            <table class="table" >
            @foreach ($products as $product)
                    @if( $product->user_id == Auth::user()->id)
                        <thead>
                        <tr>
                            <th><p> Reminder Is:</p>
                                <div class="timeReminder" style="margin-left: 20%">
                                    {{'Created at:'}}
                                    {{date('M j,Y', strtotime( $product->created_at ))}}
                                    {{ '-Updated at:' }}
                                    {{date('M j,Y', strtotime( $product->updated_at ))}}

                                </div>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody id="products-list" name="products-list">
                        <tr id="product{{$product->id}}">
                        <td>
                            <p class="detail">
                                {{substr($product->user_reminder,0,15)}}  {{ strlen($product->user_reminder)>15 ?"...":"" }}
                            </p>
                        </td>
                            <td>
                                <div class="btnReminder" style="margin-bottom: -3%">
                                    <button class="btn btn-warning btn-detail open_modal" value="{{$product->id}}" name="edit">Edit</button>
                                </div>
                                <br>
                                <a href="{{route('reminder.show', $product->id)}}" class="btn btn-default btn-sm" data-toggle="modal"> View</a>

                            </td>
                        </tr>
                        </tbody>
                    @endif
             @endforeach
            </table>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Reminder</h4>
                    </div>
                    <div class="modal-body" >
                        <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <label for="inputDetail" class="col-sm-3 control-label">Reminder</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="user_reminder" name="user_reminder" placeholder="details" value="" required></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add" onclick="validateReminder3()">Save changes</button>
                        <input type="hidden" id="product_id" name="product_id" value="0">
                    </div>
                </div>
            </div>
        </div>

        <!-- reminder  modal -->
        <div id="reminder2" class="modal fade">
            <div class="modal-dialog">
                <form action="{{ route ('reminder.store') }}" method="post" name="form5" onsubmit="return validateReminder2()">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Reminder</h4>
                        </div>
                        <div class="modal-body">
                            <p>Create A Reminder...</p>

                            <textarea class="form-control" rows="5" name="user_reminder" id="user_reminder" ></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-default"  type="submit" id="createReminder" value="CreateReminder" name="CreateReminder">
                                Create </button>

                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('js/ajaxscript.js')}}"></script>

    <script>
        function validateReminder2() {
            var x = document.forms["form5"]["user_reminder"].value;

            if (x == null || x == "")  {
                swal("Please write a reminder!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>



    <script>
        function validateReminder3() {
            var x = document.getElementById("user_reminder").value;
            if (x == null || x == "")  {
                swal("Please write a reminder!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>


@endsection