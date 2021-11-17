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

Route::redirect('dashboard', 'people');

Route::get('filepond/api/process', [FilepondController::class, 'show']);
