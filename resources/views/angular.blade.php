<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <base href="/">
        <title>Portal Personas :: GlobalCDB</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
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
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PJ7TF4L');
        </script>
        <!-- End Google Tag Manager -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        <!-- 1. Load libraries -->
        <!-- Polyfill(s) for older browsers -->
        {{ Html::script('core-js/client/shim.min.js') }}
        {{ Html::script('zone.js/dist/zone.js') }}
        {{ Html::script('reflect-metadata/Reflect.js') }}
        {{ Html::script('systemjs/dist/system.src.js') }}
        {{ Html::script('systemjs.config.js') }}
        {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js') }}
        {{ Html::script('chart/chart.js') }}
        {{ Html::style('css/boostrap.min.css') }}
        {{ Html::style('css/app.css') }}
        <script>
            System.import('app').catch(function(err){ console.error(err); });
        </script>

    </head>
    <!-- 3. Display the application -->

    <body class="container">
    <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJ7TF4L" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    <!-- End Google Tag Manager (noscript) -->
      <div class="content-wrapper content-align-center container">
        <my-app class="my-app-container">{{ HTML::image('/images/loading.gif', 'alt', array( 'width' => 100, 'height' => 100, 'text-aling'=>'center' )) }}
        </my-app>
      <div>
    </body>
    <script>

    </script>

</html>
