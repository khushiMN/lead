<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\LeadController;

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
    return redirect()->route('login');
})->middleware('auth');

Auth::routes();

//// admin side agent and campaign-----------------------------------------
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::resource('agent', AgentController::class)->middleware('is_admin');
Route::resource('campaign',CampaignController::class)->middleware('is_admin');

//// csv import export routes----------------------------------------------------
Route::post('upload', [UploadController::class,'upload']);
Route::post('userData', [UploadController::class,'userData'])->name('userData');

//// admin and agent profile--------------------------------------------------------
Route::get('profile', [HomeController::class, 'profile'])->name('profile');
Route::get('editProfile', [HomeController::class, 'editProfile'])->name('editProfile');
Route::post('update', [HomeController::class, 'update'])->name('update');

//// campaign delete agent-----------------------------------------------------------
Route::delete('userDelete/{id}', [HomeController::class, 'userDelete'])->name('userDelete');

//// agent side leads--------------------------------------------------------------
Route::get('viewLead/{id}', [HomeController::class, 'viewLead'])->name('viewLead');
Route::get('showLead/{id}', [HomeController::class, 'showLead'])->name('showLead');
Route::get('updateStatus', [LeadController::class, 'updateStatus'])->name('updateStatus');
Route::get('wallet', [LeadController::class, 'wallet'])->name('wallet');
Route::get('reports', [LeadController::class, 'reports'])->name('reports');
Route::get('addLead/{id}', [LeadController::class, 'addLead'])->name('addLead');
Route::post('insertLead', [LeadController::class, 'insertLead'])->name('insertLead');
