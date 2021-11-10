<?php

use App\Http\Controllers\Frontend\Payments\LipanampesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::post('v1/access/token', 'API\mpesaController@generateAccessToken');
//  Route::post('v1/hlab/stk/push', 'API\mpesaController@STKPush');
Route::post('/getaccesstoken',[LipanampesaController::class,'getaccesstoken']);
Route::post('/getmpesaaccesstoken',[LipanampesaController::class,'getmpesaaccesstoken']);
//Route::post('/stkpush', [LipanampesaController::class,'stkpush']);
// Route::post('v1/hlab/stk/push', [LipanampesaController::class,'stkpush']);
Route::post('v1/hlab/stk/push', [LipanampesaController::class,'stkkpush']);

