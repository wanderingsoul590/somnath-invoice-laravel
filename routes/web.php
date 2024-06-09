<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\BillsController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [LoginController::class, 'index']);
Route::any('login', [LoginController::class, 'index'])->name('showLoginForm');
Route::post('postLogin', [LoginController::class, 'login'])->name('customlogin');

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgotpasswordform');
Route::post('resetpasswordemail', [ResetPasswordController::class, 'resetPasswordSendEmail'])->name('resetpasswordemail');
Route::get('forgot-password/{token}/{ismobile?}', [ResetPasswordController::class, 'showPasswordResetForm'])->name('resetpasswordform');
Route::post('reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('passwordreset');
Route::any('activation/{token}', [UsersController::class, 'activation'])->name('activation');

Route::post('settimezone', [HomeController::class, 'settimezone'])->name('settimezone');

Route::get('terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('termsandconditions');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacypolicy');

Route::get('404notfound', [HomeController::class, 'notFound'])->name('404notfound');
Route::get('500error', [HomeController::class, 'exceptions'])->name('500error');
Route::get('401unauthorized', [HomeController::class, 'unauthorized'])->name('401unauthorized');

Auth::routes();

Route::get('success', [HomeController::class, 'success'])->name('success');

Route::middleware(['auth'])->group(function (){

    Route::get('logout', [LoginController::class, 'logout'])->name('customlogout');

    Route::group(['prefix' => 'admin'], function() {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
       
       /* My profile */
       Route::get('myprofile', [UsersController::class, 'myProfile'])->name('myprofile');
       Route::post('updatemyprofile', [UsersController::class, 'updateMyProfile'])->name('updatemyprofile');

       /* Change Password */
       Route::post('admin-change-password', [UsersController::class, 'storeChangePassword'])->name('admin-change-password');

       Route::resource('customers', CustomerController::class);
       Route::post('getcustomers',[CustomerController::class, 'postCustomersList'])->name('getcustomers');

       Route::resource('bills', BillsController::class);
       Route::post('getbills',[BillsController::class, 'postBillsList'])->name('getbills');
       Route::get('printbill/{id}',[BillsController::class, 'printbill'])->name('printbill');

    //    Route::post('sendinvoice',[InvoiceController::class, 'sendInvoice'])->name('sendinvoice');
    //    Route::get('donwload-invoice/{pdf}', [InvoiceController::class, 'downloadInvoice'])->name('downloadinvoice');

    });
});

// Route::get('optimize-clear', function () {
//     Artisan::call('optimize:clear');
//     return "Optimize clear successfully.";
// });

// Route::get('migrate', function () {
//     Artisan::call('migrate');
//     return "Migrations have been run successfully.";
// });




