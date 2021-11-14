<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Bars\BarController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\Helps\HelpController;
use App\Http\Controllers\Events\EventController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Events\ScanQrController;
use App\Http\Controllers\People\PersonController;
use App\Http\Controllers\Companies\CompanyController;
use App\Http\Controllers\Responses\ResponseController;
use App\Http\Controllers\Participants\ParticipantController;
use App\Http\Controllers\Consummation\ConsummationsController;
use App\Http\Controllers\Consummations\ConsummationController;

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

Route::redirect('/', 'login');

Route::redirect('dashboard', 'companies');

Route::resource('companies', CompanyController::class)
    ->middleware('auth:sanctum');

Route::post('/companies/send-mail',[CompanyController::class, 'sendMail'])
    ->name('companies.send.mail')->middleware('auth:sanctum');

Route::resource('participants', ParticipantController::class)
    ->middleware('auth:sanctum');

Route::post('/participants/send-mail',[ParticipantController::class, 'sendMail'])
    ->name('participants.send.mail')->middleware('auth:sanctum');

Route::post('/participants/send-sms',[ParticipantController::class, 'sendSms'])
    ->name('participants.send.sms')->middleware('auth:sanctum');

Route::post('/participants/send-sms-selected-participants',[ParticipantController::class, 'sendSmsToSelectedParticipants'])
    ->name('participants.send.sms.selected.participants')->middleware('auth:sanctum');

Route::post('/participants/send-mail-selected-participants',[ParticipantController::class, 'sendMailToSelectedParticipants'])
    ->name('participants.send.mail.selected.participants')->middleware('auth:sanctum');

Route::get('/confirm-invitation/{id}',[ParticipantController::class, 'showConfirmInviationForm'])->name('participants.show.confirm.form');

Route::get('/response',[ResponseController::class, 'Response'])->name('response');

Route::post('/confirm-invitation',[ParticipantController::class, 'confirmInviation'])->name('participants.confirm');

Route::get('/refused-invitation/{id}',[ParticipantController::class, 'showRefusedInviationForm'])->name('participants.show.refused.form');

Route::get('/failed',[ResponseController::class, 'refusedResponse'])->name('failed.response');

Route::post('/refused-invitation',[ParticipantController::class, 'refusedInviation'])->name('participants.refused');

Route::get('/condition-general',[ParticipantController::class, 'conditionGeneral'])->name('participants.condition.general');

Route::resource('events', EventController::class)->middleware('auth:sanctum');

Route::post('/events/send-tickets',[EventController::class, 'sendTickets'])
    ->name('events.send.tickets')->middleware('auth:sanctum');

Route::post('/participants/send-ticket',[ParticipantController::class, 'sendTicket'])
    ->name('participants.send.ticket')->middleware('auth:sanctum');

Route::post('/participants/send-tickets',[ParticipantController::class, 'sendTickets'])
    ->name('participants.send.tickets')->middleware('auth:sanctum');

Route::get('/participants/export',[ParticipantController::class, 'exportParticipant'])
    ->name('participants.export')->middleware('auth:sanctum');

Route::get('/events/qr-code/{code}',[EventController::class, 'showQrCode'])
    ->name('events.show.qr.code');

Route::get('/scan-qr-codes',[ScanQrController::class, 'index'])
    ->name('scan.qr.code.index')->middleware('auth:sanctum');

Route::resource('people', PersonController::class)->middleware('auth:sanctum');

Route::resource('orders', OrderController::class)->middleware('auth:sanctum');

Route::get('/orders/creation/company/{id}',[OrderController::class, 'orderCreationCompanyForm'])->name('orders.creation.company');

Route::post('/orders/creation/company',[OrderController::class, 'orderCreationCompany'])->name('orders.creation.company.store');

Route::resource('bars', BarController::class)->middleware('auth:sanctum');

Route::resource('consummations', ConsummationController::class)->middleware('auth:sanctum');

Route::resource('helps', HelpController::class)->middleware('auth:sanctum');

Route::post('/bars/make-order',[BarController::class, 'order'])->middleware('auth:sanctum')->name('bars.make.order');

Route::get('filepond/api/process', [FilepondController::class, 'show']);
