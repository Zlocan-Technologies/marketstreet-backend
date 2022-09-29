<?php

use Illuminate\Support\Facades\{Route, Auth, DB};
use Illuminate\Http\Request;
use App\Models\{User};
use Carbon\Carbon;
use App\Http\Controllers\{AuthController};

Route::group([
], function () {
    Route::get('/email', function () { return view('email.ver'); });
    
    Route::get("/verify/reset/{email}/{token}", [AuthController::class, "verifyResetToken"]);
    Route::get("/email/verify/{email}/{code}", [AuthController::class, "verifyEmail"]);
});



