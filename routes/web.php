<?php

use App\Http\Controllers\ActivoController;
use App\Http\Controllers\AmbientesController;
use App\Http\Controllers\CategoriaActivoController;
use App\Http\Controllers\DetalleReservasController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TrasladoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\MembresiasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\TiposMembresiasController;
use App\Http\Controllers\UsosController;
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
//Route::resource('ambientes', AmbienteController::class)->names('ambientes');
Route::resource('mantenimientos', MantenimientoController::class)->names('mantenimientos');
Route::resource('traslados', TrasladoController::class)->names('traslados');
Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)->names('roles');


Route::resource('productos', ProductoController::class)->names('productos');
Route::resource('detalle_reservas', DetalleReservasController::class)->names('detalle_reservas');
Route::resource('tiposMembresias', TiposMembresiasController::class)->names('tiposMembresias');
Route::resource('pagos', PagosController::class)->names('pagos');
Route::resource('reservas', ReservasController::class)->names('reservas');
Route::resource('membresias', MembresiasController::class)->names('membresias');
Route::resource('ambientes', AmbientesController::class)->names('ambientes');
Route::resource('usos', UsosController::class)->names('usos');
Route::resource('ingresos', IngresosController::class)->names('ingresos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route reporte
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('/reportes', [ReporteController::class, 'validar'])->name('reportes.validar');
//Route estadisticas
Route::get('/estadisticas', [ReporteController::class, 'estadisticas'])->name('estadisticas.index');
