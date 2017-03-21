const elixir = require('laravel-elixir');

require('laravel-elixir-vue');
//require('laravel-elixir-typescript');
require('laravel-elixir-ts');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir(mix => {
    mix.sass('app.scss')
    .webpack('app.js')
    .copy('node_modules/@angular', 'public/@angular')
    .copy('node_modules/anular2-in-memory-web-api', 'public/anular2-in-memory-web-api')
    .copy('node_modules/core-js', 'public/core-js')
    .copy('node_modules/reflect-metadata', 'public/reflect-metadata')
    .copy('node_modules/systemjs', 'public/systemjs')
    .copy('node_modules/rxjs', 'public/rxjs')
    .copy('node_modules/zone.js', 'public/zone.js')

    .typescript(
        {
          source: "/resources/assets/typescript/*.ts",
          destination: "public/app",
          target: "es5",
          module: "commonjs",
          moduleResolution: "node",
          sourceMap: true,
          inlineSourceMap: false,
          emitDecoratorMetadata: true,
          experimentalDecorators: true,
          removeComments: false,
          noImplicitAny: false
        }
    );
});
