<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel='stylesheet'/>
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel='stylesheet'/>
    <!-- Graph CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/glyphicons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/halflings.css')}}">
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/icon-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.min.css')}}">

    <!-- //lined-icons -->
    <script src="{{asset('backend/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/js/dataTables.bootstrap.min.js')}}"></script>
    <!--    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
    -->

</head>
<body>
<div class="page-container">
    <!--/content-inner-->
    <div class="left-content">
        <div class="inner-content">

            <nav class="navbar navbar-default" style="background-color: black;height:60px">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><h3 style="color: #218838">Textile Solution</h3></li>
                        </ul>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                            </div>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">{{Session::get('admin_name')}} <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <!-- //header-ends -->
            <!--content-->
            <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                        enabled to use this site.</p>
                </div>
            </noscript>
            <div class="content">
                @yield('admin_content')
            </div>
            <!--content-->
        </div>

    </div>
    <!--//content-inner-->
    <div class="sidebar-menu">
        <header class="logo1">
            <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
        </header>
        <div class="menu">
            <ul id="menu">
                <li><a href="{{route('all_buyer')}}"><i class="fa fa-tachometer"></i> <span>Buyer</span></a></li>
                <li><a href="{{route('all_color')}}"><i class="fa fa-tachometer"></i> <span>Color</span></a></li>
                <li><a href="{{route('all_size')}}"><i class="fa fa-tachometer"></i> <span>Size</span></a></li>
                <li><a href="{{route('units.index')}}"><i class="fa fa-tachometer"></i> <span>Unit</span></a></li>
                @if(Session::get('access_level')== "Admin")
                    <li id="menu-academico"><a href="#"><i class="fa fa-table"></i> <span>Admin Registration</span>
                            <span
                                    class="fa fa-angle-right" style="float: right"></span></a>
                        <ul id="menu-academico-sub">
                            <li id="menu-academico-avaliacoes"><a href="">All Admins</a>
                            </li>
                            <li id="menu-academico-avaliacoes"><a href="">Add Admin</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li id="menu-academico"><a href="#"><i class="fa fa-table"></i> <span>Categories</span> <span
                                class="fa fa-angle-right" style="float: right"></span></a>
                    <ul id="menu-academico-sub">
                        <li id="menu-academico-avaliacoes"><a href="">All Categories</a>
                        </li>
                        <li id="menu-academico-avaliacoes"><a href="">Add Categories</a>
                        </li>
                    </ul>
                </li>
                <li id="menu-academico"><a href="{{route('all_order')}}"><i class="fa fa-file-text-o"></i>
                        <span>Order Management</span></a></li>
                <li><a href="{{route('suppliers.index')}}"><i class="lnr lnr-pencil"></i> <span>Suppliers</span></a>
                </li>
                <li id="menu-academico"><a href=""><i class="fa fa-file-text-o"></i>
                        <span>Add Products</span></a></li>
                <li id="menu-academico"><a href=""><i class="lnr lnr-book"></i> <span>Delivery Men</span></a>
                </li>
                <li><a href="#"><i class="lnr lnr-chart-bars"></i> <span>Forms</span> <span
                                class="fa fa-angle-right"
                                style="float: right"></span></a>
                    <ul>
                        <li><a href="input.html"> Input</a></li>
                        <li><a href="validation.html">Validation</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-menu-->

</div>

<script>
    var toggle = true;

    $(".sidebar-icon").click(function () {
        if (toggle) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position": "absolute"});
        }
        else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function () {
                $("#menu span").css({"position": "relative"});
            }, 400);
        }

        toggle = !toggle;
    });
</script>

<script src="{{asset('backend/js/bootbox.min.js')}}"></script>
<script src="{{asset('backend/js/printPreview.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/menu_jquery.js')}}"></script>
<script>
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        bootbox.confirm("Are you want delete!!", function (confirmed) {
            if (confirmed) {
                window.location.href = link;
            }
            ;
        });
    });
    $('.delete_form_btn').on('click', function (e) {
        e.preventDefault();
        that = this;
        bootbox.confirm("Are you want delete!!", function (confirmed) {
            if (confirmed) {
                $(that).closest('form').submit();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#btnPrint").printPreview({
            obj2print: '#masterContent',
            width: '810'

            /*optional properties with default values*/
            //obj2print:'body',     /*if not provided full page will be printed*/
            //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
            //width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
            //height:screen.height, /*if not provided its height will be equal to screen height*/
            //top:0,                /*if not provided its top position will be zero*/
            //left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
            //resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
            //scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
            //status:'no',          /*yes or no default is yes, * do not work in some browsers*/
            //title:'Print Preview' /*title of print preview popup window*/

        });
    });
</script>

</body>
</html>