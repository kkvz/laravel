<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;

use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\PricingController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\MovieController as MemberMovieController;
use App\Http\Controllers\Member\TransactionController as MemberTransactionController;
use App\Http\Controllers\Member\WebhookController;
use App\Http\Controllers\Member\UserPremiumController;

use App\Models\Movie;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//only for public routes

//member route
Route::view('/','index');

Route::get('/register', [RegisterController::class, 'index'])->name('member.register');
Route::get('/login',[MemberLoginController::class,'index'])->name('member.login');

Route::post('/register',[RegisterController::class,'store'])->name('member.register.store');
Route::post('/login',[MemberLoginController::class,'auth'])->name('member.login.auth');

Route::post('/payment-notification',[WebhookController::class,'handler'])
    ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::view('/payment-finish','member.payment-finish')->name('member.payment.finish');

//admin route
//Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');


