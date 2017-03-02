<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/images/favicon.png" type="image/png">
        <base href="/">
        <title>Portal Personas :: GlobalCDB</title>

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
      <div class="content-wrapper content-align-center container">
        <my-app class="my-app-container">{{ HTML::image('/images/loading.gif', 'alt', array( 'width' => 100, 'height' => 100, 'text-aling'=>'center' )) }}
        </my-app>
      <div>
    </body>
</html>
