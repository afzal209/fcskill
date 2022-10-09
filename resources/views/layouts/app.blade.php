<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    @if (Request::is('admin/signals') ||
        Request::is('admin/news') ||
        Request::is('admin/roles') ||
        Request::is('admin/predictions') ||
        Request::is('admin/tradings') ||
        Request::is('admin/gain_profits'))
        <link href="{{ asset('assets/css/plugins/dataTables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        {{-- <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    @endif

    <link href="{{ asset('assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="">

    @if (\Session::has('doneMessage'))
        <input type="hidden" id="donemessage" value="{{ \Session::get('doneMessage') }}">
    @endif
    @if (\Session::has('errorMessage'))
        <input type="hidden" id="errormessage" value="{{ \Session::get('errorMessage') }}">
    @endif

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img style="width: 60px;" alt="image" class="rounded-circle"
                                src="{{ asset('assets/img/profile_small.png') }}" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{ auth()->user()->name }}</span>
                                <span class="text-muted text-xs block">
                                    @if (auth()->user()->user_role == 1)
                                        Admin
                                    @else
                                        Editor
                                    @endif
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            {{ config('app.name') }}
                        </div>
                    </li>

                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    {{-- @if (auth()->user()->user_role == 1)
                        <li class="{{ Request::is('admin/roles') ? 'active' : '' }}">
                            <a href="{{ route('roles') }}">
                                <i class="fa fa-users"></i> <span class="nav-label">Roles</span>
                            </a>
                        </li>
                    @endif --}}
                    <li class="{{ Request::is('admin/gain_profits') ? 'active' : '' }}">
                        <a href="{{ route('gain_profits') }}">
                        <i class="fa fa-get-pocket" aria-hidden="true"></i> <span class="nav-label">Gain / Profit</span>
                        </a>
                    </li>    
                    <li class="{{ Request::is('admin/signals') ? 'active' : '' }}">
                        <a href="{{ route('signals') }}">
                            <i class="fa fa-signal"></i> <span class="nav-label">Signals</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/predictions') ? 'active' : '' }}">
                        <a href="{{ route('predictions') }}">
                            <i class="fa fa-lightbulb-o"></i> <span class="nav-label">Prediction Ideas</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/tradings') ? 'active' : '' }}">
                        <a href="{{ route('tradings') }}">
                            <i class="fa fa-money"></i> <span class="nav-label">Trading Tips</span>
                        </a>
                    </li>
                    @if (auth()->user()->user_role == 1)
                        <li class="{{ Request::is('admin/market_education') ? 'active' : '' }}">
                            <a href="{{ route('market_education') }}">
                                <i class="fa fa-graduation-cap"></i> <span class="nav-label">Market Education</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/brokers-ranking') ? 'active' : '' }}">
                            <a href="{{ route('brokers_ranking') }}">
                                <i class="fa fa-star"></i> <span class="nav-label">Brokers Ranking</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/roles') ? 'active' : '' }}">
                            <a href="{{ route('roles') }}">
                                <i class="fa fa-users"></i> <span class="nav-label">Roles</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/terms-and-conditions') ? 'active' : '' }}">
                            <a href="{{ route('terms_and_conditions') }}">
                                <i class="fa fa-gavel"></i> <span class="nav-label">Terms And Conditions</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/news') ? 'active' : '' }}">
                            <a href="{{ route('news') }}">
                                <i class="fa fa-newspaper-o"></i> <span class="nav-label">News</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                            <a href="{{ route('settings') }}">
                                <i class="fa fa-cog"></i> <span class="nav-label">Settings</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to {{ config('app.name') }}</span>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @yield('content')
            <div class="footer">
                <div>
                    <strong>Copyright</strong> {{ config('app.name') }} &copy; {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/toastr/toastr.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var donemessage = $('#donemessage').val();
            if (donemessage != null) {

                toastr.success(donemessage, 'Success');

            }

            var errormessage = $('#errormessage').val();
            if (errormessage != null) {
                toastr.error(errormessage, 'Error');
            }

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });
    </script>

    @if (Request::is('admin/signals') ||
        Request::is('admin/news') ||
        Request::is('admin/roles') ||
        Request::is('admin/predictions') ||
        Request::is('admin/tradings')||
        Request::is('admin/gain_profits'))
        <script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function() {

                $('#table_id').DataTable();

            });
        </script>
    @endif



    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

    @if (Request::is('admin/signals/add') || Request::is('admin/signals/edit/*'))
        <script>
            CKEDITOR.replace('signal_text', {
                filebrowserUploadUrl: "{{ route('upload_signal_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/predictions/add') || Request::is('admin/predictions/edit/*'))
        <script>
            CKEDITOR.replace('prediction_text', {
                filebrowserUploadUrl: "{{ route('upload_predictions_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/tradings/add') || Request::is('admin/tradings/edit/*'))
        <script>
            CKEDITOR.replace('trading_text', {
                filebrowserUploadUrl: "{{ route('upload_tradings_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/market_education'))
        <script>
            CKEDITOR.replace('technical_analysis', {
                filebrowserUploadUrl: "{{ route('upload_market_education_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

            CKEDITOR.replace('fundamental_analysis', {
                filebrowserUploadUrl: "{{ route('upload_market_education_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/terms-and-conditions'))
        <script>
            CKEDITOR.replace('terms_and_conditions', {
                filebrowserUploadUrl: "{{ route('upload_terms_and_conditions_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/brokers-ranking'))
        <script>
            CKEDITOR.replace('forex_brokers_ranking', {
                filebrowserUploadUrl: "{{ route('upload_brokers_ranking_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });

            CKEDITOR.replace('crypto_brokers_ranking', {
                filebrowserUploadUrl: "{{ route('upload_brokers_ranking_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

    @if (Request::is('admin/news/add') || Request::is('admin/news/edit/*'))
        <script>
            CKEDITOR.replace('news_text', {
                filebrowserUploadUrl: "{{ route('upload_signal_image', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endif

</body>

</html>
