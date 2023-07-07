<?php
use App\Http\Controllers\AssesmentController;
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
    return view('welcome');
});
Route::match(['get','post'],'/home',[AssesmentController::class,'create']);
Route::match(['get','post'],'/PatientAjaxData',[AssesmentController::class,'PatientAjaxData']);
Route::match(['get','post'],'/MedicineName',[AssesmentController::class,'MedicineName']);
Route::match(['get','post'],'/ShowData',[AssesmentController::class,'ShowData']);
Route::match(['get','post'],'/insert',[AssesmentController::class,'insert']);
Route::match(['get','post'],'/pdf',[AssesmentController::class,'DownloadData']);
