<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, 
    ProductController, 
    OrderController,
    UserController
};

Route::group(['prefix' => 'v1'], function () {
    //Route::post("/create-roles", [UserController::class, "createRoles"]);

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post("/register", [AuthController::class, "register"]);
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/password/reset", [AuthController::class, "resetPassword"]);
        Route::post("/password-reset", [AuthController::class, "passwordReset"]);
    });

    Route::get("/banks", [UserController::class, "fetchBanks"]);

    Route::group([
        'prefix' => 'callback'
    ], function () {
        //Route::post("/paystack/", [UserController::class, "transferWebhook"]);
        //Route::post("/flutterwave/", [UserController::class, "transferWebhook"]);
    });

    Route::group([
        'prefix' => 'payout',
        'middleware' => ['verify.paystack']
    ], function () {
        //Route::post("/transfer/webhook", [UserController::class, "transferWebhook"]);
        //Route::post("/transfer/webhook", [UserController::class, "transferWebhook"]);
    });
});


//protected route using Laravel Sanctum
Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']],function(){
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::get("/logout", [AuthController::class, "logout"]);
        Route::post("/refresh", [AuthController::class, "refresh"]);
    });
    
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get("/{userId}", [UserController::class, "getUserData"]);
        Route::post("/profile", [UserController::class, "updateProfileData"]);
        Route::post("/profile/photo", [UserController::class, "updateProfilePhoto"]);
        Route::delete("/delete", [UserController::class, "delete"]);
        Route::get("/bank-detail/{id}", [UserController::class, "getBankDetails"]);
        Route::delete("/bank-detail/{id}", [UserController::class, "deleteBankDetail"]);
        Route::post("/bank-detail/", [UserController::class, "updateBankDetail"]);
        Route::post("/transfer", [UserController::class, "transfer"]);
        Route::post("/newsletter", [UserController::class, "newsletter"]);
        Route::post("/fcm-token", [UserController::class, "storeFcmToken"]);
    });

    Route::group([
        'prefix' => 'category'
    ], function () {
        Route::get("/", [ProductController::class, "getCategories"]);
        Route::post("/store", [ProductController::class, "createCategories"]);
        Route::get("/{categoryId}/products", [ProductController::class, "getProducts"]);
    });

    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get("/{id}", [ProductController::class, "show"]);
        Route::post("/store", [ProductController::class, "store"]);
        Route::post("/review/{id}", [ProductController::class, "review"]);
        Route::post("/update/{id}", [ProductController::class, "update"]);
        Route::delete("/{id}", [ProductController::class, "destroy"]);
    });

    Route::post("/order", [OrderController::class, "order"]);
    Route::get("/buyer/orders", [OrderController::class, "listOrdersForBuyer"]);
    Route::get("/buyer/order/{id}", [OrderController::class, "viewOrder"]);

    Route::get("/seller/orders", [OrderController::class, "listOrdersForSeller"]);
    Route::get("/seller/order/{id}", [OrderController::class, "viewOrderForSeller"]);

});

Route::get("/test-order", [OrderController::class, "test"]);