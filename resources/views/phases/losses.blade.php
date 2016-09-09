@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading" style="color: darkblue; ">Lost Tenders</div>
                    <div class="panel-body" style="color: dimgray">
                        <table class="table">
                            <thead style="color: #ec971f">

                                 <th>Tender Name</th>
                                 <th>Created By </th>
                                 <th>Assigned User</th>
                                 <th>Assigned User</th>
                                 <th>Delete</th>
                            </thead>
                            <tbody>

                                    @foreach($tender as $tenders)
                                      <tr>
                                          @if( $tenders->phases->name== 'Losses')
                                              @if($tenders->user_id == Auth::user()->id || $tenders ->created_user_id == Auth::user()->id)

                                                  <td>   {{$tenders->name  }}  </td>
                                                   @foreach($user as $users)
                                                  <td>
                                                      @if( $tenders->created_user_id == $users->id)
                                                         {{ $users->name}}
                                                       @endif
                                                  </td>
                                                  <td>
                                                      @if( $tenders->user_id == $users->id)
                                                            {{$users->name  }}
                                                      @endif
                                                  </td>
                                                  <td>
                                                      @if( $tenders->user_id2 == $users->id)
                                                          {{$users->name  }}
                                                      @endif
                                                  </td>
                                                      <td>   <div class="col-sm-6">
                                                              {!! Form::open(['route'=>['tender.destroy',$tenders->id ],'method'=>'DELETE','name'=>'deleteM']) !!}

                                                              {!! Form::submit('Delete',['class'=>'btn btn-danger','id'=>'btn-submit','name'=>'btn-submit','onclick'=>'confirmation(event)']) !!}

                                                              {!! Form::close() !!}
                                                          </div></td>
                                              @endforeach
                                            @endif
                                              @endif

                                       </tr>
                                    @endforeach

                            </tbody>
                         </table>
                    </div>
                 </div>


@endsection