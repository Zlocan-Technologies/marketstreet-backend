<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, 
    UserController,
    ProductController, 
    OrderController,
    TransactionController
};

Route::group(['prefix' => 'v1'], function () {
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
        Route::get("/paystack/", [TransactionController::class, "paystackCallback"]);
        Route::get("/flutterwave/", [TransactionController::class, "flutterwaveCallback"]);
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
        //Route::post("/transfer", [UserController::class, "transfer"]);
        Route::post("/email-notification", [UserController::class, "emailNotification"]);
        Route::post("/push-notification/", [UserController::class, "pushNotification"]);
        Route::post("/fcm-token", [UserController::class, "storeFcmToken"]);
        Route::post("/send-push-notification", [UserController::class, "sendPushNotification"]);
        Route::get("/{userId}/reports", [UserController::class, "fetchReports"]);
    });

    Route::group([
        'prefix' => 'category'
    ], function () {
        Route::get("/", [ProductController::class, "getCategories"]);
        //Route::post("/store", [ProductController::class, "createCategories"]);
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
        Route::post("/dropship", [ProductController::class, "dropship"]);

        Route::get("/{userId}/products", [ProductController::class, "getAllUserProducts"]);
    });

    Route::get("/products", [ProductController::class, "FetchAllStoreProducts"]);
    Route::get("/products/{min}/{max}", [ProductController::class, "FetchProductsByPrice"]);
    Route::get("/wishlist/", [ProductController::class, "getWishlist"]);
    Route::post("/wishlist/{id}", [ProductController::class, "addProductToWishlist"]);

    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::post("/", [OrderController::class, "order"]);
        Route::post("/send-invoice", [OrderController::class, "sendInvoice"]);
        Route::post("/invoice-payment", [OrderController::class, "invoicePayment"]);
    });

    Route::get("/buyer/get-all-orders", [OrderController::class, "listOrdersForBuyer"]);
    Route::get("/{id}", [OrderController::class, "show"]);
    Route::get("/seller/get-all-orders", [OrderController::class, "listOrdersForSeller"]);
    Route::get("/seller/order/{id}", [OrderController::class, "showOrderSeller"]);

    Route::get("/coupon/{code}", [OrderController::class, "fetchCouponData"]);

});

Route::get("/test-order", [OrderController::class, "test"]);