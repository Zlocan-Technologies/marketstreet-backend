<?php

use Illuminate\Support\Facades\{Route, Auth, DB};
use Illuminate\Http\Request;
use App\Models\{User};
use Carbon\Carbon;
use App\Http\Controllers\{AuthController};
use App\Http\Controllers\Dashboard\DashboardHomeController;
use App\Http\Controllers\Auth\AdminAuthController;


Route::group([
], function () {
    Route::get('/email', function () { return view('email.ver'); });

    Route::get("/verify/reset/{email}/{token}", [AuthController::class, "verifyResetToken"]);
    Route::get("/email/verify/{email}/{code}", [AuthController::class, "verifyEmail"]);
});




Route::post('admin/login',[AdminAuthController::class,'postLogin'])->name('adminLoginPost');
Route::get('admin/logout',[AdminAuthController::class,'logout'])->name('adminLogout');







Route::get('/', [AdminAuthController::class,'getLogin'])->name('adminLogin');



Auth::routes();

Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
	Route::get('dashboard',[DashboardHomeController::class,'dashboard'])->name('dashboard')->middleware('adminauth');
});

