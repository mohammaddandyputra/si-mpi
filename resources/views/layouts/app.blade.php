<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Favicon Icon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{ asset('css/quicksand.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css')}}">
    <!--Animate CSS-->
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="{{ asset('css/chartist.min.css')}}">
    <!--Map-->
    <link rel="stylesheet" href="{{ asset('css/jquery-jvectormap-2.0.2.css')}}">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="{{ asset('js/calendar/bootstrap_calendar.css')}}">
    <!--Nice select -->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css')}}">
    
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css')}}">

    

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>SI-MPI</title>
  </head>
  <body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class="container-fluid">

        <!--Header-->
        <div class="row header shadow-sm">
            
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
                <a href="{{ route('home') }}" class="text-secondary logo">
                    <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                        <h3 class="logo"><span class="small">SI-MPI</span></h3>
                   </div>
                </a>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    <div class="col-sm-4 col-8 pl-0">
                        <span class="menu-icon" onclick="toggle_sidebar()">
                            <span id="sidebar-toggle-btn"></span>
                        </span>
                    </div>
                    <!--Search box and avatar-->
                    <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                        
                        <div class="mr-4">
                            @if(\Auth::user())
                                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="mt-2">
                                        {{Auth::user()->name}}
                                    </h6>
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#"><i class="fa fa-user pr-2"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-th-list pr-2"></i> Tasks</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-book pr-2"></i> Projects</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                    <i class="fa fa-power-off pr-2"></i>
                                    <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->

        <div class="row main-content">
            <!--Sidebar left-->
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-3">

                    @if(\Auth::user())

                        <!--Image Avatar-->
                        <div class="text-center">
                            <img src="{{ asset('img/batan.jpg')}}" class="img-fluid" />
                        </div>
                        <!--Image Avatar-->
                        
                        <!--Sidebar Navigation Menu-->
                        <div class="sidebar-menu-container">
                            <ul class="sidebar-menu mt-4 mb-4">
                                <li class="parent">
                                    <a href="{{route('home')}}" class=""><i class="fa fa-dashboard mr-3"></i>
                                        <span class="none">Dashboard </span>
                                    </a>
                                </li>
                                <li class="parent">
                                    <a href="#" onclick="toggle_menu('master'); return false" class=""><i class="fa fa-book mr-3"> </i>
                                        <span class="none">Master <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                    </a>
                                    <ul class="children" id="master">
                                        <li class="child"><a href="{{route('komponen.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Komponen</a></li>
                                        <li class="child"><a href="{{route('teras.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Teras</a></li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a href="#" onclick="toggle_menu('komponen'); return false" class=""><i class="fa fa-book mr-3"> </i>
                                        <span class="none">Komponen <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                    </a>
                                    <ul class="children" id="komponen">
                                        <li class="child"><a href="{{route('gangguan.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Gangguan Komponen</a></li>
                                        <li class="child"><a href="{{route('perbaikan.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Perbaikan Komponen</a></li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a href="#" onclick="toggle_menu('mpi'); return false" class=""><i class="fa fa-book mr-3"> </i>
                                        <span class="none">MPI <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                    </a>
                                    <ul class="children" id="mpi">
                                        <li class="child"><a href="{{route('mpi.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> MPI & Grafik</a></li>
                                        <li class="child"><a href="{{route('scr.index')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> SCR</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--Sidebar Naigation Menu-->
                    @endif

                </div>
            </div>
            <!--Sidebar left-->
                
                @yield('content')
                
        </div>
    <!--Main Content-->
    
    </div>
<!--Page Wrapper-->

<!-- Page JavaScript Files-->

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--Popper JS-->
<script src="{{ asset('js/popper.min.js')}}"></script>
<!--Bootstrap-->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<!--Sweet alert JS-->
<script src="{{ asset('js/sweetalert.js')}}"></script>
<!--Progressbar JS-->
<script src="{{ asset('js/progressbar.min.js')}}"></script>
<!--Flot.JS-->
<script src="{{ asset('js/charts/jquery.flot.min.js')}}"></script>
<script src="{{ asset('js/charts/jquery.flot.pie.min.js')}}"></script>
<script src="{{ asset('js/charts/jquery.flot.categories.min.js')}}"></script>
<script src="{{ asset('js/charts/jquery.flot.stack.min.js')}}"></script>
<!--Chart JS-->
<script src="{{ asset('js/charts/chart.min.js')}}"></script>
<!--Chartist JS-->
<script src="{{ asset('js/charts/chartist.min.js')}}"></script>
<script src="{{ asset('js/charts/chartist-data.js')}}"></script>
<script src="{{ asset('js/charts/demo.js')}}"></script>
<!--Maps-->
<script src="{{ asset('js/maps/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('js/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('js/maps/jvector-maps.js')}}"></script>
<!--Bootstrap Calendar JS-->
<script src="{{ asset('js/calendar/bootstrap_calendar.js')}}"></script>
<!--Nice select-->
<script src="{{ asset('js/jquery.nice-select.min.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>

{{-- Sweet alert Js --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--Custom Js Script-->
<script src="{{ asset('js/custom.js')}}"></script>
<!--Custom Js Script-->
<script>
// //Nice select
$('.bulk-actions').niceSelect();

function printErrorMsg (msg) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg
    })
}

function success (msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    
    Toast.fire({
        icon: 'success',
        title: msg
    })
}


</script>
@yield('script')

</body>
</html>