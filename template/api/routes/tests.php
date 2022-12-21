<?php
/**
 * @var Illuminate\Support\Facades\Route $router
 */

use App\Http\Controllers\Base\TestController;

$router->get('test/index', [TestController::class, 'validating']);
$router->get('test/index2', function(){
    return date('Y-m-d H:i:s');
});
