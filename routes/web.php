<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlShortnerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::group([], function ($router) {
    $router->get('/home', [HomeController::class, 'index'])->name('home');
    $router->get('/', function () {
        return view('welcome');
    })->name('index');
    $router->group(['prefix' => 'dashboard', 'middleware' => ['auth']], function($router){
        $router->get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        $router->resource('urls', UrlShortnerController::class);
    
    });
    $router->group([], function($router){
        $router->get('/{code}', [UrlShortnerController::class, 'urlshortner'])->name("urlshortner");
    });
});
