<?php


use Illuminate\Support\Facades\{Route, Auth, DB};
use Illuminate\Http\Request;
use App\Models\{User};
use Carbon\Carbon;
use App\Http\Controllers\{AuthController};
use App\Http\Controllers\Dashboard\DashboardHomeController;
use App\Services\DashboardService;
use App\Http\Controllers\Auth\AdminAuthController;



Route::get('/dashboard',                        [DashboardHomeController::class, 'dashboard'])->name('dashboard');
// Route::get('/',          [DashboardHomeController::class, 'index']);
Route::get('/categories',                       [DashboardHomeController::class, 'categories'])->name('categories');
Route::get('/category/create',                  [DashboardHomeController::class, 'createCategory'])->name('create-category');


//get pending orders
Route::get('/pending-orders', function(){
    try {
        $pendingOrders = DashboardService::getPendingOrders();
        return response()->json([
            'pendingOrders' => $pendingOrders
        ]);
    } catch (\Throwable $th) {
        throw $th;
    }
});


Route::get('/dashboard',                        [DashboardHomeController::class, 'dashboard'])->name('dashboard');
Route::get('/categories',                       [DashboardHomeController::class, 'categories'])->name('categories');
Route::get('/category/create',                  [DashboardHomeController::class, 'createCategory'])->name('create-category');


Route::post('/category/create',                 [DashboardHomeController::class, 'storeCategory'])->name('store-category');
Route::get('/category/edit/{id}',               [DashboardHomeController::class, 'editCategory'])->name('edit-category');
Route::post('/category/edit/{id}',              [DashboardHomeController::class, 'updateCategory'])->name('update-category');
Route::post('/category/delete/{id}' ,           [DashboardHomeController::class, 'deleteCategory']);


//users routes
Route::get('/users',                            [DashboardHomeController::class, 'users'])->name('users');

Route::get('/blocked-users',                    [DashboardHomeController::class, 'blockedUsers'])->name('blocked-users');
//block user
Route::post('/block/user/{id}',                 [DashboardHomeController::class, 'blockUser']);
Route::post('/unblock/user/{id}',               [DashboardHomeController::class, 'unBlockUser']);

//orders route
Route::get('/orders',                           [DashboardHomeController::class, 'orders'])->name('orders');
Route::post('/orders/edit/{id}',                [DashboardHomeController::class, 'updateOrder'])->name('update-order');
Route::get('/order-detail/{id}',                [DashboardHomeController::class, 'showOrder'])->name('show-order');
Route::get('/orders/report',                    [DashboardHomeController::class, 'orderReport'])->name('orders-report');
//payments route
Route::get('/payments',                         [DashboardHomeController::class, 'payments'])->name('view-payments');

//coupon route
Route::get('/coupon/create',                    [DashboardHomeController::class, 'createCoupon'])->name('create-coupon');
Route::get('/coupons',                          [DashboardHomeController::class, 'coupons'])->name('view-coupons');
Route::post('/coupons',                         [DashboardHomeController::class, 'storeCoupon']);
Route::get('/coupons/edit/{id}',                [DashboardHomeController::class, 'editCoupon'])->name('edit-coupon');
Route::post('/coupons/edit/{id}',               [DashboardHomeController::class, 'updateCoupon']);
Route::post('/coupon/delete/{id}' ,             [DashboardHomeController::class, 'deleteCoupon'])->name('delete-coupon');



//App Settings
Route::get('/settings',                         [DashboardHomeController::class, 'appSettings'])->name('app-settings');
Route::post('/settings',                        [DashboardHomeController::class, 'updateSettings'])->name('update-settings');


Route::get('/banners',                          [DashboardHomeController::class, 'viewBanner'])->name('view-banner');
Route::get('/create-banner',                    [DashboardHomeController::class, 'createBanner'])->name('create-banner');
Route::post('/store-banner',                    [DashboardHomeController::class, 'storeBanner'])->name('store-banner');
Route::post('/update-banner/{id}',              [DashboardHomeController::class, 'updateBanner'])->name('update-banner');
Route::post('/delete-banner/{id}',              [DashboardHomeController::class, 'deleteBanner'])->name('delete-banner');

Route::get('/service-charges',                  [DashboardHomeController::class, 'viewCharge'])->name('view-charge');
Route::post('/update-charge',                   [DashboardHomeController::class, 'updateCharge'])->name('update-charge');


//push notifications
Route::post('/push-notification',               [DashboardHomeController::class, 'appNotification'])->name('app-notification');
Route::get('/notifications',                    [DashboardHomeController::class, 'unreadNotifications'])->name('unread-notifications');
Route::post('/markAsRead/{id}',                 [DashboardHomeController::class, 'markAsRead'])->name('mark-as-read'); 
Route::post('/markAllAsRead',                   [DashboardHomeController::class, 'markAllAsRead'])->name('mark-all-as-read'); 
