<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">





    <style>
        .mr-2 {
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite;
            /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    {{-- <!-- jQuery 3 --> --}}
    <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

    {{-- noty --}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

    {{-- morris --}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">

    {{-- <!-- iCheck --> --}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">

    {{-- html in  ie --}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-expanded">

    <div class="wrapper">

        <header class="main-header">

            {{-- <!-- Logo --> --}}
            <a href="{{ asset('dashboard') }}/index2.html" class="logo">
                {{-- <!-- mini logo for sidebar mini 50x50 pixels --> --}}
                <span class="logo-mini"><b>A</b>LT</span>
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small>
                                                        <i class="fa fa-clock-o"></i> 5 mins
                                                    </small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">See All Messages</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <!-- Notifications: style can be found in dropdown.less --> --}}
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    {{-- <!-- inner menu: contains the actual data --> --}}
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <!-- Tasks: style can be found in dropdown.less --> --}}
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-flag-o"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    {{-- <!-- inner menu: contains the actual data --> --}}
                                    <ul class="menu">

                                        {{-- <li>
                                                <a rel="alternate""
                                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}
                                                </a>
                                            </li>
                                        --}}
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{-- <!-- User Account: style can be found in dropdown.less --> --}}
                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset(auth()->user()->image_path) }}" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs">{{ auth()->user()->first_name }}
                                    {{ auth()->user()->last_name }}</span>
                            </a>
                            <ul class="dropdown-menu">

                                {{-- <!-- User image --> --}}
                                <li class="user-header">
                                    <img src="{{ asset(auth()->user()->image_path) }}" class="img-circle"
                                        alt="User Image">

                                    <p>
                                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                        <small>Member since 2 days</small>
                                    </p>
                                </li>

                                {{-- <!-- Menu Footer--> --}}
                                <li class="user-footer">


                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>

        @include('layouts.dashboard._aside')

        @yield('content')

        @include('partials._session')


    </div><!-- end of wrapper -->

    {{-- <!-- Bootstrap 3.3.7 --> --}}
    <script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

    {{-- icheck --}}
    <script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

    {{-- <!-- FastClick --> --}}
    <script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

    {{-- <!-- AdminLTE App --> --}}
    <script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

    {{-- ckeditor standard --}}
    <script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

    {{-- jquery number --}}
    <script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

    {{-- print this --}}
    <script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>

    {{-- morris --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('dashboard_files/plugins/morris/morris.min.js') }}"></script>

    {{-- custom js --}}
    <script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/custom/order.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.sidebar-menu').tree();

            //icheck
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //delete
            $('.delete').click(function(e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "confirm delete",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("yes", 'btn btn-success mr-2', function() {
                            that.closest('form').submit();
                        }),

                        Noty.button("no", 'btn btn-primary mr-2', function() {
                            n.close();
                        })
                    ]
                });

                n.show();

            }); //end of delete

            // // image preview
            // $(".image").change(function () {
            //
            //     if (this.files && this.files[0]) {
            //         var reader = new FileReader();
            //
            //         reader.onload = function (e) {
            //             $('.image-preview').attr('src', e.target.result);
            //         }
            //
            //         reader.readAsDataURL(this.files[0]);
            //     }
            //
            // });



        }); //end of ready
    </script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->
        <script>
            // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
            // IT'S ALL JUST JUNK FOR DEMO
            // ++++++++++++++++++++++++++++++++++++++++++
    
            const sales_chart_options = {
                series: [{
                        name: "Digital Goods",
                        data: [28, 48, 40, 19, 86, 27, 90],
                    },
                    {
                        name: "Electronics",
                        data: [65, 59, 80, 81, 56, 55, 40],
                    },
                ],
                chart: {
                    height: 300,
                    type: "area",
                    toolbar: {
                        show: true,
                    },
                },
                legend: {
                    show: false,
                },
                colors: ["#0d6efd", "#20c997"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                xaxis: {
                    type: "datetime",
                    categories: [
                        "2023-01-01",
                        "2023-02-01",
                        "2023-03-01",
                        "2023-04-01",
                        "2023-05-01",
                        "2023-06-01",
                        "2023-07-01",
                    ],
                },
                tooltip: {
                    x: {
                        format: "MMMM yyyy",
                    },
                },
            };
    
            const sales_chart = new ApexCharts(
                document.querySelector("#revenue-chart"),
                sales_chart_options,
            );
            sales_chart.render();
        </script> <!-- jsvectormap -->
    @stack('scripts')
</body>

</html>
