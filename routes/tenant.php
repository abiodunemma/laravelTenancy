<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Middleware\TenantAuthMiddleware;
use App\Http\Middleware\TenantGuestMiddleware;

use App\Http\Controllers\Authcontroller;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        $users = User::get();
        dd($users->toArray());

        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
Route::middleware([TenantGuestMiddleware::class])->name('tenant.')->group(function(){

    Route::get('/login',[AuthController::class, 'login'])->name('tenant.login');
    Route::post('/login',[AuthController::class, 'loginStore'])->name('tenant.login.store');
    Route::get('/register',[AuthController::class, 'register'])->name('tenant.register');
    Route::post('/register',[AuthController::class, 'registerStore'])->name('tenant.register.store');


});

Route::middleware([TenantAuthMiddleware::class])->name('tenant.')->group(function(){
    Route::post('/logout',[AuthController::class, 'logout'])->name('tenant.logout');
    Route::get('/dashboard',function(){
return view('tenant.dashboard');
    })->name('dashboard');
});

});
