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
        Route::post("/sendcode", [AuthController::class, "sendcode"]);
        Route::post("/register", [AuthController::class, "register"]);
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/password/reset", [AuthController::class, "resetPassword"]);
        Route::post("/verify/code", [AuthController::class, "verifyUser"]);
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
        Route::post("/save-fcm-token", [AuthController::class, "saveFCMToken"]);
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
        Route::post("/initiatedeposit", [UserController::class, "initiateDeposit"]);
    });
    Route::get("/states/", [UserController::class, "fetchStates"]);

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
        Route::post("{id}/dropship", [ProductController::class, "dropship"]);
        Route::get("/search/{query}/", [ProductController::class, "searchProducts"]);

        Route::get("/{userId}/products", [ProductController::class, "getAllUserProducts"]);

        Route::post("/test/store", [ProductController::class, "createProducts"]);
    });

    Route::get("/products", [ProductController::class, "FetchAllStoreProducts"]);
    Route::get("/products/trending", [ProductController::class, "fetchTrendingProducts"]);
    Route::get("/products/{min}/{max}", [ProductController::class, "FetchProductsByPrice"]);
    Route::get("/wishlist/", [ProductController::class, "getWishlist"]);
    Route::post("/wishlist/{id}/{action}", [ProductController::class, "Wishlist"]);

    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::post("/", [OrderController::class, "order"]);
        Route::get("/{orderId}/", [OrderController::class, "fetchBuyerOrderData"]);
        Route::get("/sales/{orderId}/", [OrderController::class, "fetchSellerOrderData"]);
        Route::post("/send-invoice", [OrderController::class, "sendInvoice"]);
        Route::post("/invoice-payment", [OrderController::class, "invoicePayment"]);
    });

    Route::get("/user/{id}/orders", [OrderController::class, "listBuyerOrders"]);
    Route::get("/user/{id}/sub-orders", [OrderController::class, "listSellerOrders"]);

    Route::get("/coupon/{code}", [OrderController::class, "fetchCouponData"]);

});

Route::get("/test-order", [OrderController::class, "test"]);