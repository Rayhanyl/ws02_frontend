<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AppController,AuthController,ManageKeysController,SubscriptionController};


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
Route::get('/', [AppController::class, 'index'])->name('index');

Route::get('/loginpage', [AuthController::class, 'loginpage'])->name('loginpage');
Route::post('/authentication', [AuthController::class, 'authentication'])->name('authentication');

Route::get('/registerpage', [AuthController::class, 'registerpage'])->name('registerpage');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgotpassword', [AuthController::class, 'forgetpage'])->name('forgetpage');


Route::middleware(['haslogin'])->group(function () {

    // Application
    Route::get('/myapp', [AppController::class, 'myapp'])->name('myapp');
    Route::get('/applications', [AppController::class, 'listapp'])->name('listapp');
    Route::get('/createapp', [AppController::class, 'createapp'])->name('createapp');
    Route::post('/storeapp', [AppController::class, 'store'])->name('storeapp');
    Route::get('/editapp/{id}', [AppController::class, 'editapp'])->name('editapp');
    Route::post('/update/{id}', [AppController::class, 'update'])->name('update_app');
    Route::get('/delete/{id}', [AppController::class, 'delete'])->name('delete');

    //Manage Keys
    Route::get('/managekeys/{id}', [ManageKeysController::class, 'managekeys'])->name('managekeys');
    
    Route::get('/productionoauth/{id}', [ManageKeysController::class, 'productionoauth'])->name('prodoauth');
    Route::get('/productionapi/{id}', [ManageKeysController::class, 'productionapi'])->name('prodapi');
    Route::post('/generateapikeys' ,[ManageKeysController::class, 'genapikey'])->name('genapikey');

    Route::get('/sandboxoauth/{id}', [ManageKeysController::class, 'sandboxoauth'])->name('sandoauth');
    Route::get('/sandboxapi/{id}', [ManageKeysController::class, 'sandboxapi'])->name('sandapi');

    Route::post('/oauthkeygenerate' ,[ManageKeysController::class, 'oauthgenerate'])->name('oauthgenerate');
    Route::post('/updateoauthkey' ,[ManageKeysController::class, 'updateoauth'])->name('updategenerate');
    Route::post('/accesstoken' ,[ManageKeysController::class, 'generateaccesstoken'])->name('accesstoken');
    
    
    // Subscription
    Route::get('/subscription/{id}', [SubscriptionController::class, 'subscription'])->name('subscription');
    Route::get('/addsubscription/{id}', [SubscriptionController::class, 'addsubs'])->name('addsubscription');
    Route::post('/storesubs', [SubscriptionController::class, 'store'])->name('storesubs');
    Route::get('/updatesubs', [SubscriptionController::class, 'view_update'])->name('editsubs');
    Route::post('/updatesubs', [SubscriptionController::class, 'update'])->name('updatesubs');
    Route::get('/deletesubs/{id}', [SubscriptionController::class, 'deletesubs'])->name('deletesubs');

    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');    
});






