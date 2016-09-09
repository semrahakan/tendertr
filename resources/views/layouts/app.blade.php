<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Traff-Tec</title>
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="Stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.js" ></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js" ></script>

    <link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.theme.css') }}">
    <script src=" ../../js/jquery.min.js"></script>
    <script src=" ../../jquery-ui/jquery-ui.min.js"></script>

    <!--dropzone-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

    <!-- bootstrap select -->
    <script src=" ../../js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">

    <!-- Sweat alert -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


</head>

<body>
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"> Traff-Tec
                    <img src="http://www.tedesbilgi.com/wp-content/uploads/2015/03/traftec-logo.png"  class="img-responsive" style="margin-top: -35px;">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::to('/home')  }}" style="color: darkblue">Home</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" style="color: darkblue">Login</a></li>
                        <li><a href="{{ url('/adminpage') }}"style="color: darkblue">Create an account </a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: darkblue">Other <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="list-group-item">  <a href="#reminder"  data-toggle="modal" class="list-group-item"  style="color: darkblue">
                                        <i class="glyphicon glyphicon-comment"></i> Add A Reminder</a>
                                </li>
                                <li  class="list-group-item"> <a href="#contact"  data-toggle="modal"  class="list-group-item"  style="color: darkblue">
                                        <i class="fa fa-user" aria-hidden="true"></i> Create a contact </a></li>
                                <li  class="list-group-item"> <a href="{{ url('/index') }}" class="list-group-item"   style="color: darkblue">
                                        <i class="fa fa-envelope" aria-hidden="true"></i> Send Email </a>
                                </li>
                            </ul>
                        </li>
                </ul>
                <form action="/search" method="POST" class="navbar-form navbar-left" role="search" style="margin-left: 5%">
                    <div class="form-group">
                        {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="searchName"
                                       placeholder="Search contacts"> <span class="input-group-btn">

                        <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                     </span>
                            </div>

                    </div>

                </form>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: darkblue"> <img src="/uploads/avatars/{{Auth::user()->avatar }}" style="width: 32px; height: 32px; position: absolute; top: 10px; left: -18px; border-radius: 50%">
                            {{ Auth::user()->name }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('phases.index')}}" style="color: darkblue"> Phases Of Tenders </a></li>
                            <li><a href="{{url('indexUser')}}" style="color: darkblue"> User Edit</a></li>
                            <li><a href="{{ url('/adminpage') }}"style="color: darkblue">Create an account </a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/profile') }}" style="color: darkblue"> <i class="fa fa-btn fa-cogs" ></i>Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}" style="color: darkblue"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        @if( \Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success " role="alert" style="margin-top: 3%">
                <strong>Success:</strong> {{\Illuminate\Support\Facades\Session::get('success')}}

            </div>
        @endif

        @if( \Illuminate\Support\Facades\Session::has('warning'))
            <div class="alert alert-warning " role="alert" style="margin-top: 3%">
                <strong>Success:</strong> {{\Illuminate\Support\Facades\Session::get('warning')}}

            </div>
        @endif
    </nav>

    <div class="row" style="margin-top: 3%">
        <div class="col-sm-4 col-md-3 sidebar">
            <div class="mini-submenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="list-group">
                @if ( ! Auth::guest())

                    <span href="#" class="list-group-item active">Menu
            <span class="pull-right" id="slide-submenu">
                <i class="fa fa-times"></i>
            </span>
        </span>
                    <a href="{{route('municipality.create')  }}"  style="color: darkblue" class="list-group-item">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create Tender </a>
                    <a href="{{ url('ongoingTenders') }}" style="color: darkblue" class="list-group-item">
                        <i class="fa fa-folder-o" aria-hidden="true"></i>Ongoing Tenders</a>

                    <a href="{{route('tender.index')  }}"  style="color: darkblue" class="list-group-item">
                        <i class="fa fa-btn fa-archive" aria-hidden="true"></i> Tender History</a>





                    <a href="{{ route('contact.index')  }}" class="list-group-item" style="color: darkblue">
                        <i class="fa fa-user" aria-hidden="true"></i> All contacts </a>

                    <a href="{{ url('indexReminder') }}" style="color: darkblue" class="list-group-item">
                        <i class="fa fa-bell" aria-hidden="true"></i> All Reminders </a>

                    <a href="{{ url('phaseUpdates') }}" style="color: darkblue" class="list-group-item">
                        <i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Change Tender Phase </a>

                    <a href="{{ route( 'materials.create') }}" style="color: darkblue" class="list-group-item">
                        <i class="fa fa-list-alt" aria-hidden="true"></i> Material List</a>

                    <a href="{{ route('municipality.index') }}" class="list-group-item"  style="color: darkblue">
                        <i class="fa fa-folder-open" aria-hidden="true"></i> Municipalities</a>

                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="list-group-item" style="color: darkblue"><span class="glyphicon glyphicon-folder-close" style="color: darkblue">
                    </span>Old Tenders</a>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="list-group">
                            <li class="list-group-item"> <a href="{{ url('/winsIndex') }}" style="color: darkblue">Wins </a></li>
                            <li class="list-group-item"><a href="{{ url('/lossesIndex') }}" style="color: darkblue">Losses </a></li>

                        </ul>
                    </div>


                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-9">
            @yield('content')
        </div>

    </div>

    <!-- reminder  modal -->
    <div id="reminder" class="modal fade">
        <div class="modal-dialog">
            <form action="{{ route ('reminder.store') }}" method="post" name="form1" onsubmit="return validateReminder()">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Reminder</h4>
                    </div>
                    <div class="modal-body">
                        <p>Create A Reminder...</p>

                        <textarea class="form-control" rows="5" name="user_reminder" id="user_reminder"></textarea>

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
    <!-- contact modal -->
    <div id="contact" class="modal fade">
        <div class="modal-dialog">
            <form action="{{ route ('contact.store') }}" method="post" name="form2"  onsubmit="return validateForm()">
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
                        <button class="btn btn-default"  type="submit" name="createContact" id="create" value="contact">
                            Create </button>

                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<script>

    $("#searchName").autocomplete({
        source: "{{route('autocomplete')}}",
        minLength: 3,
        select: function(event, ui) {
            $("#searchName").val(ui.item.value);
        }
    });

</script>


<script>
    $(function(){

        $('#slide-submenu').on('click',function() {
            $(this).closest('.list-group').fadeOut('slide',function(){
                $('.mini-submenu').fadeIn();
            });

        });

        $('.mini-submenu').on('click',function(){
            $(this).next('.list-group').toggle('slide');
            $('.mini-submenu').hide();
        })
    })

</script>
<script>
    function validateForm() {
        var x = document.forms["form2"]["contactName"].value;
        var y= document.forms["form2"]["contactPhone"].value;
        var z =document.forms["form2"]["contactEmail"].value;
        var t =document.forms["form2"]["address"].value;
        if (x == null || x == "" || y==null || y=="" || z==null || z=="" || t==null || t=="") {
            swal("Please write something!", "You cannot submit null items!", "error")
            return false;
        }
        else {
            swal("Good!!", "Your contact has created!", "success")
        }
    }
</script>
<script>
    function validateReminder() {
        var x = document.forms["form1"]["user_reminder"].value;
        if (x == null || x == "") {
            swal("Please write something!", "You cannot submit null items!", "error")
            return false;
        }
        else {
            swal("Good!!", "Your reminder has created!", "success")
        }
    }

</script>





<script src=" ../../js/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}




</body>
</html>

