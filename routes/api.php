<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ambientes/{id}/activos',[AmbienteController::class, 'getActivosAmbientesById']);
Route::get('tables-atributes/{model}',[ReporteController::class, 'getAtributesModel']);

Route::get('reportes/{tipoReporte}/{year}',[ReporteController::class, 'getTipoReporte']);


//Route::get('getServicios',[ReservaApiController::class, 'getServicios']);
