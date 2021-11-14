<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Bars\BarsController;
use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\Api\Events\ScanQrController;
use App\Http\Controllers\Api\People\PersonController;
use App\Http\Controllers\Api\Consummations\ConsummationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/scan-qr-codes',[ScanQrController::class, 'scanQr'])
    ->name('scan.qr.code');

Route::post('/bars/scan-qr-code',[BarsController::class, 'scanQr'])->name('bars.scan.qr.code');
//Route::post('/bars/make-order',[BarsController::class, 'order'])->name('bars.make.order');

Route::post('/search-company',[OrderController::class, 'searchCompany'])
    ->name('search.company');

Route::post('/search-person',[PersonController::class, 'searchPerson'])
    ->name('search.person');

Route::post('/search-table-quantity',[OrderController::class, 'checkTableQuantity'])
    ->name('search.table.quantity');

Route::post('/consummations/edit-vat-number',[ConsummationController::class, 'editVatNumber'])->name('consummations.edit.vat.number');
