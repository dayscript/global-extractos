<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{!! asset('css/plugins/bootstrap/css/bootstrap.css') !!}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{!! asset('css/plugins/node-waves/waves.css') !!}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{!! asset('css/plugins/animate-css/animate.css') !!}" rel="stylesheet" />
    <!-- Morris Chart Css-->
    <link href="{!! asset('css/plugins/morrisjs/morris.css') !!}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{!! asset('css/themes/all-themes.css') !!}" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- {{ Html::style('css/app.css') }} -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22304333-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-22304333-2');
    </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    {{ Html::script('core-js/client/shim.min.js') }}
    {{ Html::script('zone.js/dist/zone.js') }}
    {{ Html::script('reflect-metadata/Reflect.js') }}
    {{ Html::script('systemjs/dist/system.src.js') }}
    {{ Html::script('systemjs-admin.config.js') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js') }}
    <script>
        System.import('app-admin').catch(function(err){ console.error(err); });
    </script>
</head>
<body>
    <div id="app">
      <!-- <my-app class="my-app-container">{{ HTML::image('/images/loading.gif', 'alt', array( 'width' => 100, 'height' => 100, 'text-aling'=>'center' )) }}
      </my-app> -->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                @if (Auth::guest())
                <div class="no-login" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                  </ul>
                </div>
                @else
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->identification }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                  </ul>
                </div>
                @endif
            </div>
        </nav>
        @yield('content')
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>



    <!-- Jquery Core Js -->
    <script src="{!! asset('css/plugins/jquery/jquery.min.js')!!}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{!! asset('css/plugins/bootstrap/js/bootstrap.js')!!}"></script>

    <!-- Select Plugin Js -->
    <script src="{!! asset('css/plugins/bootstrap-select/js/bootstrap-select.js')!!}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{!! asset('css/plugins/jquery-slimscroll/jquery.slimscroll.js')!!}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{!! asset('css/plugins/node-waves/waves.js')!!}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{!! asset('css/plugins/jquery-countto/jquery.countTo.js')!!}"></script>

    <!-- Morris Plugin Js -->
    <script src="{!! asset('css/plugins/raphael/raphael.min.js')!!}"></script>
    <script src="{!! asset('css/plugins/morrisjs/morris.js')!!}"></script>

    <!-- ChartJs -->
    <script src="{!! asset('css/plugins/chartjs/Chart.bundle.js')!!}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{!! asset('css/plugins/flot-charts/jquery.flot.js')!!}"></script>
    <script src="{!! asset('css/plugins/flot-charts/jquery.flot.resize.js')!!}"></script>
    <script src="{!! asset('css/plugins/flot-charts/jquery.flot.pie.js')!!}"></script>
    <script src="{!! asset('css/plugins/flot-charts/jquery.flot.categories.js')!!}"></script>
    <script src="{!! asset('css/plugins/flot-charts/jquery.flot.time.js')!!}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{!! asset('css/plugins/jquery-sparkline/jquery.sparkline.js')!!}"></script>

    <!-- Custom Js -->
    <script src="{!! asset('js/admin.js')!!}"></script>
    <script src="{!! asset('js/pages/index.js')!!}"></script>

    <!-- Demo Js -->
    <script src="{!! asset('js/demo.js')!!}"></script>
</body>
</html>
