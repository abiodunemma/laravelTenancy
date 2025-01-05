<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Models\User;
use app\Http\Controllers\Authcontroller;
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

    Route::get('/login',[Authcontroller::class, 'login'])->name('tenant.login');
    Route::post('/login',[Authcontroller::class, 'loginStore'])->name('tenant.login.store');
    Route::get('/register',[Authcontroller::class, 'register'])->name('tenant.register');
    Route::post('/register',[Authcontroller::class, 'registerStore'])->name('tenant.register.store');
    Route::post('/logout',[Authcontroller::class, 'logout'])->name('tenant.logout');
});
