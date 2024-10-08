<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PerfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cuentas/perfiles', [CuentaController::class, 'ver_perfiles'])->name('cuentas.ver_perfiles');
Route::get('perfiles/create/{id_cuenta}', [PerfileController::class, 'create'])->name('perfiles.create');
Route::get('perfiles/renew/', [PerfileController::class, 'renew'])->name('perfiles.renew');

//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('cuentas', CuentaController::class);
    Route::resource('escuelas', EscuelaController::class);
    Route::resource('proveedors', ProveedorController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('perfiles', PerfileController::class);
});
