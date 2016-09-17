@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4 style="color:darkblue;">Ongoing Tenders </h4>
        </div>
        <div class="panel-body">
            <table class="table">
                @foreach ($products as $product)
                    @if( $product->phases->name != 'Losses' && $product->phases->name != 'Wins' )
                        @if($product->user_id == Auth::user()->id || $product ->created_user_id == Auth::user()->id || $product->user_id2 == Auth::user()->id)
                        <thead>
                        <tr>
                            <th class="table-bordered">
                                @foreach($user as $users)
                                    @if( $product->updated_user_id == null)
                                        @if($product->created_user_id == $users->id )
                                            <p class="author-name2">{{$users->name }}</p>
                                            <img src="/uploads/avatars/{{ $users->avatar }}"  class="author-image">
                                        @endif
                                    @elseif( $product->updated_user_id == $users->id  )
                                        <p class="author-name2">{{$users->name }}</p>
                                        <img src="/uploads/avatars/{{ $users->avatar }}"  class="author-image">
                                    @endif
                                @endforeach</th>
                            <th class="table-bordered">
                                <p class="author-name2" >  {{'wrote this;'}}  </p>
                                {{ substr($product->details,0,20 )}} {{ strlen($product->details)>20 ?"...":"" }}
                            </th>
                            <th><p class="tender-comment">{{'Tender Name:'}} </p>{{$product->name}}
                                <a href="{{route('tender.show', $product->id)  }}" class="btn btn-default btn-sm"> View</a></th>

                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">


                            <tr id="product{{$product->id}}">
                                <td>
                                    <p class="tender-comment">{{'Comment:'}} </p>
                                </td>
                                <td>{{ substr($product->details,0,20 )}} {{ strlen($product->details)>20 ?"...":"" }}
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-detail open_modal" value="{{$product->id}}">Edit</button>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                        @endif
                        @endforeach
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tender</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Product Name" value="">
                                <input type="hidden" id="updated_user_id" name="updated_user_id">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                            <div class="col-sm-9">
                                        <textarea class="form-control" id="details" name="details" placeholder="details" value="" required>
                                        </textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add"onclick="validateTender3()">Save changes</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>
        </div>
    </div>

    <meta name="_token" content="{!! csrf_token() !!}" />

    <script src="{{asset('js/app.js')}}"></script>
    <script>
        function validateTender3() {
            var x = document.getElementById("details").value;
            if (x == null || x == "")  {
                swal("Please write a comment!", "You cannot submit null items!", "error")
                return false;
            }

        }

    </script>
@endsection