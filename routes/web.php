<?php

use App\Http\Controllers\ActivoController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\CategoriaActivoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TrasladoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::resource('personas', PersonaController::class)->names('personas');
Route::resource('categorias', CategoriaActivoController::class)->names('categorias');
Route::resource('ubicaciones', UbicacionController::class)->names('ubicaciones');
Route::resource('fotografias', FotografiaController::class)->names('fotografias');
Route::resource('activos', ActivoController::class)->names('activos');
Route::resource('ambientes', AmbienteController::class)->names('ambientes');
Route::resource('mantenimientos', MantenimientoController::class)->names('mantenimientos');
Route::resource('traslados', TrasladoController::class)->names('traslados');
Route::resource('usuarios', UserController::class)->names('usuarios');
Route::resource('roles', RoleController::class)->names('roles');
Route::resource('productos', ProductoController::class)->names('productos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route reporte
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('/reportes', [ReporteController::class, 'validar'])->name('reportes.validar');
//Route estadisticas
Route::get('/estadisticas', [ReporteController::class, 'estadisticas'])->name('estadisticas.index');
