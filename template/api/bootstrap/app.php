<?php

/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// custom Router
$app->router = new \App\Supports\Router($app);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('auth');
$app->configure('permission');
$app->configure('eloquent_model_generator');
$app->configure('ide-helper');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
]);

$app->routeMiddleware([
    //    'auth' => App\Http\Middleware\Authenticate::class,
    'auth' => App\Http\Middleware\JwtMiddleware::class,
    'extauth' => App\Http\Middleware\ExtJwt::class,
    'role' => App\Http\Middleware\RoleMiddleware::class,
    'permission' => App\Http\Middleware\PermissionMiddleware::class,
    'role_or_permission' => App\Http\Middleware\RoleOrPermissionMiddleware::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->alias('cache', Illuminate\Cache\CacheManager::class);  // if you don't have this already

$app->register(Spatie\Permission\PermissionServiceProvider::class);
$app->register(App\Providers\AppServiceProvider::class);
//$app->register(App\Providers\AuthServiceProvider::class);
$app->register(Intervention\Image\ImageServiceProvider::class);
$app->register(Illuminate\Database\Eloquent\LegacyFactoryServiceProvider::class);
$app->register(Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
$app->register(\App\Providers\GeneratorServiceProvider::class);
$app->register(KitLoong\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/base.php';
});

return $app;
