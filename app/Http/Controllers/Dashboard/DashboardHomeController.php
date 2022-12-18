<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Services\CategoryService;
use App\Services\SearchService;
use App\Services\NotificationService;
use App\Services\CouponService;
use App\Services\ImageUploadService;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\NotificationRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Banner;
use App\Models\ServiceCharge;
use DB;
use \Carbon\Carbon;

use Illuminate\Support\Facades\Notification;
use App\Notifications\CouponNotification;
use App\Notifications\CategoryNotification;
use App\Notifications\AdminUserNotification;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
 

class DashboardHomeController extends Controller
{
    public $data;
    public $orders;
    public $pending;
    public $activeOrders;
    public $deliveredOrders;
    public $confirmedOrders;
    public $pendingPayments;
    private $paginationLength = 20;
    public function __construct(DashboardService $dashboardService){


        $this->orders =             $dashboardService->allOrders();
        $this->pending =            collect($this->orders['pending']);
        $this->activeOrders =       collect($this->orders['shipped']);
        $this->deliveredOrders =    collect($this->orders['delivered']);
        $this->confirmedOrders =    collect($this->orders['confirmed']);
        $this->pendingPayments =    collect($this->orders['pending']);

        $this->data =  [
            'customers'          =>   $dashboardService->getCustomers(),
            'categories'         =>  $dashboardService->getCategories(),
            'allOrders'          =>  $this->orders,
            'pendingOrders'      =>  $dashboardService->paginate($this->pending, $this->paginationLength),
            'activeOrders'       =>  $dashboardService->paginate($this->activeOrders, $this->paginationLength),
            'deliveredOrders'    =>  $dashboardService->paginate($this->deliveredOrders, $this->paginationLength),
            'confirmedOrders'    =>  $dashboardService->paginate($this->confirmedOrders, $this->paginationLength),
            'pendingPayments'    =>  $dashboardService->paginate($this->pendingPayments, $this->paginationLength),
        ];
    }
    // login dashboard controllers

    public function dashboard(Request $request){
        
        $from = $request->has('from') ? $request->from : Carbon::now()->subDays(7);
        $to = $request->has('to') ? $request->to : Carbon::now();

        [$labels, $data, $revenue] = DashboardService::getOrdersByDate($from, $to);
        //  return $orders;
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.dashHome', $this->data)
            ->with(['labels' => $labels, 'data' => $data,'revenue' => $revenue, 'from' => $from, 'to' => $to]);
        }
        return view('dashboard.dashboard', $this->data)->with(['labels' => $labels, 'data' => $data, 'revenue' => $revenue, 'from' => $from, 'to' => $to]);
    }

    public function index(){
        return view('dashboard.dashboard');
    }

    public function categories(Request $request){
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.categories')->with($this->data);
        }
        return view('dashboard.menu.index')->with($this->data);
    }

    public function createCategory(Request $request){
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.createCategory')->with($this->data);
        }
        return view('dashboard.menu.createCategory')->with($this->data);
    }

    public function storeCategory(CreateCategoryRequest $request){
        $request->validated();
        
        if(!$request->hasFile('category_image')){
            $request->category_image = null;
        };

        try {
            $categoryService =  new CategoryService($request->category_name, 
                    $request->category_slug, $request->category_description, $request->category_image);
            $category = $categoryService->create();

            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CategoryNotification($category, 'New Category Created!'));


            return response()->json([
                        'message' => 'Created',
                        'data' => $category
                    ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //edit category
    public function editCategory(Request $request, $id){
        $category = Category::findOrFail($id);
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.editCategory', $this->data)->with(['category' => $category]);
        }
        return view('dashboard.menu.editCategory', $this->data)->with(['category' => $category]);
    }


    public function updateCategory(CreateCategoryRequest $request, $id){
        $request->validated();

        if(!$request->hasFile('category_image')){
            $request->category_image = null;
        };

        try {
            $categoryService =  new CategoryService($request->category_name, 
            $request->category_slug, $request->category_description, $request->category_image);
            $category = $categoryService->update($id);
            
            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CategoryNotification($category, 'Category Updated Successfully!'));

            return response()->json([
                        'message' => 'Updated!',
                        'data' => $category
                    ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCategory($id){

        try {
            
            $category = Category::findOrFail($id);
            
            if($category->image !== null ){
                $imageUploadService =  new ImageUploadService();
                $imageUploadService->deleteImage($category->image);
            }
            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CategoryNotification($category, 'Category Deleted Successfully!'));

            $category->delete();

            return response()->json([
                'message' => 'Deleted!'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        

    }

    public function users(Request $request){
        //if there is a search request 
        if($request->has('search_query')){
            $searchService = new SearchService($request->search_query);
            $users = $searchService->findUsers();
        }else{
            $users = User::where('isBlocked', false)->latest()->paginate($this->paginationLength);
        }

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.users', $this->data)->with(['users' => $users]);
        }
        return view('dashboard.user_management.users', $this->data)->with(['users' => $users]);
    }

    public function blockedUsers(Request $request){
        //if there is a search request 
        if($request->has('search_query')){
            $searchService = new SearchService($request->search_query);
            $users = $searchService->findBlockedUsers();
        }else{
            $users = User::where('isBlocked', true)->latest()->paginate($this->paginationLength);
        }

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.blockedUsers', $this->data)->with(['users' => $users]);
        }
        return view('dashboard.user_management.blocked', $this->data)->with(['users' => $users]);
    }

    public function blockUser($id){
        try {
            $user = User::findOrFail($id);
            $user->update([
                'isBlocked' => true
            ]);

            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new AdminUserNotification($user->email ,'User Blocked Successfully!'));

            
            return response()->json([
               'message' => 'User Blocked!'
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function unBlockUser($id){
        try {
            $user = User::findOrFail($id);
            $user->update([
                'isBlocked' => false
            ]);

            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new AdminUserNotification($user->email ,'User UnBlocked Successfully!'));

            return response()->json([
               'message' => 'User UnBlocked!'
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function orders(Request $request){
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.orders', $this->data);
        }
        return view('dashboard.menu.orders',$this->data);
    }
    
    public function OrderReport(Request $request){
        $from = $request->has('from') ? Carbon::parse($request->from) : Carbon::parse('1990-01-01');
        $to = $request->has('to') ? Carbon::parse($request->to) : Carbon::parse(Carbon::now());

        $m1 = $this->pending->merge($this->activeOrders);
        $m2= $m1->merge($this->deliveredOrders);
        $m3 = $m2->merge($this->confirmedOrders);
        $m4 = $m3->whereBetween('created_at', [$from, $to])->flatten();

        $orderReports = DashboardService::paginate($m4, $this->paginationLength); 

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.orderReport', $this->data)->with(['orderReports' => $orderReports]);
        }
        return view('dashboard.menu.orderReport', $this->data)->with(['orderReports' => $orderReports]);
    }

    public function showOrder(Request $request, $id){
        $order = Order::findOrFail($id);
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.order-detail', $this->data)->with(['order' => $order]);
        }
        return view('dashboard.menu.showOrder', $this->data)->with(['order' => $order]);
    }

    public function updateOrder(Request $request, $id){
        $order = Order::findOrFail($id);
        $status = $request->status;
        if(empty($status)){
            return;
        }
        $order->update(['order_status' => $status]);
        if($status == 'confirmed' || $status == 'paid'){
            $order->update(['payment_status' => 'success']);
        }
        return response()->json([
            'message' => 'Order Updated!'
        ]);
    }

    //create coupon view
    public function createCoupon(Request $request){
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.createCoupon', $this->data);
        }
        return view('dashboard.menu.createCoupon', $this->data);
    }

    //store coupon
    public function storeCoupon(CreateCouponRequest $request){
        $request->validated();
        try {
            $couponService = new CouponService($request->coupon_code, 
                                        $request->coupon_type, 
                                        $request->coupon_value, 
                                        $request->percent_off);
            
            $coupon = $couponService->create();
            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CouponNotification($coupon, 'New Coupon Created'));
            return response()->json([
                        'message' => 'Created',
                        'data' => $coupon
                    ], 201); 
                                    
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editCoupon(Request $request, $id){
        $coupon = Coupon::findOrFail($id);
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.editCoupon', $this->data)->with(['coupon' => $coupon]);
        }
        return view('dashboard.menu.editCoupon', $this->data)->with(['coupon' => $coupon]);
    }

    public function updateCoupon(CreateCouponRequest $request, $id){
        $request->validated();

        try {
            $couponService = new CouponService($request->coupon_code, 
            $request->coupon_type, 
            $request->coupon_value, 
            $request->percent_off);

            $coupon = $couponService->update($id);
            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CouponNotification($coupon, 'Coupon Updated Successfully'));

            return response()->json([
                        'message' => 'Updated!',
                        'data' => $coupon
                    ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCoupon($id){

        try {
            
            $coupon = Coupon::findOrFail($id);
            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new CouponNotification($coupon, 'Coupon Deleted Successfully!'));

            $coupon->delete();

            return response()->json([
                'message' => 'Deleted!'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        

    }

    public function coupons(Request $request){
        $coupons = Coupon::latest()->paginate(20);
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.allCoupons', $this->data)->with(['coupons'  => $coupons]);
        }
        return view('dashboard.menu.allCoupons', $this->data)->with(['coupons'  => $coupons]);
    }

    public function payments(Request $request){
        $from = $request->has('from') ? Carbon::parse($request->from) : Carbon::parse('1990-01-01');
        $to = $request->has('to') ? Carbon::parse($request->to) : Carbon::parse(Carbon::now());

        $pendingOrders = $this->pending->whereBetween('created_at', [$from, $to])->flatten();

        $paymentReports = DashboardService::paginate($pendingOrders, $this->paginationLength);

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.viewPayments', $this->data)->with(['payments' => $paymentReports]);
        }
        return view('dashboard.menu.payments', $this->data)->with(['payments' => $paymentReports]);
    }


    public function appSettings(Request $request){

        //get config data from 
        $keys = config('admin');

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.appSettings', $this->data)->with(['keys' => $keys]);
        }
        return view('dashboard.appSettings', $this->data)->with(['keys' => $keys]);
    }

    public function updateSettings(Request $request){

        try {
            $admins = Admin::all();
            
            if($request->has('paystack_public_key')){
                DotenvEditor::load()->backup()->setKey('PAYSTACK_PUBLIC', $request->paystack_public_key)->save();
                DotenvEditor::load()->backup()->setKey('PAYSTACK_SECRET', $request->paystack_secret_key)->save(); 
                 //send notfication
                Notification::send($admins, new AdminUserNotification('Paystack' ,'Paystack Credientials Updated!'));  
            }

            if($request->has('cloudinary_api_key')){
                DotenvEditor::load()->backup()->setKey('CLOUDINARY_API_KEY', $request->cloudinary_api_key)->save();
                DotenvEditor::load()->backup()->setKey('CLOUDINARY_API_SECRET', $request->cloudinary_api_secret)->save();
                DotenvEditor::load()->backup()->setKey('CLOUDINARY_CLOUD_NAME', $request->cloudinary_cloud_name)->save();
                DotenvEditor::load()->backup()->setKey('CLOUDINARY_SECURE', $request->cloudinary_secure)->save();
                DotenvEditor::load()->backup()->setKey('CLOUDINARY_URL', $request->cloudinary_url)->save();
                 //send notfication
                Notification::send($admins, new AdminUserNotification('Cloudinary' ,'Cloudinary Credientials Updated!'));
            }

            if($request->has('flw_secret_key')){
                DotenvEditor::load()->backup()->setKey('FLW_SECRET_KEY', $request->flw_secret_key)->save();
                DotenvEditor::load()->backup()->setKey('FLW_PUBLIC_KEY', $request->flw_public_key)->save();
                DotenvEditor::load()->backup()->setKey('FLW_SECRET_HASH', $request->flw_secret_hash)->save();
                DotenvEditor::load()->backup()->setKey('FLW_ENCRYPTION_KEY', $request->flw_encryption_key)->save();
                 //send notfication
                Notification::send($admins, new AdminUserNotification('Flutterwave' ,'Flutterwave Credientials Updated!'));                
            }   


            return response()->json([
                'message'  => 'Updated successfully'
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
        
    }


    //send to unblocked users
    public function appNotification(NotificationRequest $request){
        $request->validated();

        try {   

            $notificationService = new NotificationService($request->message, 
                $request->notify_type, $request->subject, $request->recipient);

            $notificationService->sendNotification();
            
            return response()->json([
                'message' => $request->message,
                'subject' => $request->subject,
                'type' => $request->notify_type
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

    public function unreadNotifications(){
        $admin = auth()->guard('admin')->user();

        $notifications = array();

        foreach ($admin->unreadNotifications as $notify) {
            $data = [$notify->data, $notify->created_at->diffForHumans()];
           array_push($notifications, [$notify->id => $data]);
        }

        return response()->json([
            'message' => $notifications,
        ]);
    }



    public function markAsRead($id){
        $notification = auth()->guard('admin')->user()->notifications()->find($id);
        if($notification) {
            $notification->markAsRead();
            return response()->json([
                'message' => 'Notification read successfully',
            ]);
        }else{
            return response()->json([
                'message' => 'Notification not found',
            ]);
        }
    }

    public function markAllAsRead(){
        auth()->guard('admin')->user()->unreadNotifications->markAsRead();
        return response()->json([
            'message' => 'Notification read successfully',
        ]);
    }


    public function viewBanner(Request $request){
        $banners  = Banner::latest()->get();
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.viewBanner', $this->data)->with(['banners' => $banners]);
        }
        return view('dashboard.menu.banner', $this->data)->with(['banners' => $banners]);
    }

    public function createBanner(Request $request){
        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.createBanner', $this->data);
        }
        return view('dashboard.menu.createBanner', $this->data);
    }

    public function storeBanner(Request $request){
        if(!$request->hasFile('banner_image')){
            $request->image = null;
             return;
        };


        try {

        $imageUploadService = new ImageUploadService();

        $filename = $imageUploadService->uploadImage($request->banner_image, '/banner');
        
        //default display_status is false
        Banner::create([
            'image' => $filename,
        ]);

        $admins = Admin::all();
        //send notfication
        Notification::send($admins, new AdminUserNotification('Banner Created!', 'New Banner Created!'));


        return response()->json([
                    'message' => 'Banner Created!',
                ]);
        } catch (\Throwable $th) {
            throw $th;
        }
   
    }


    public function updateBanner(Request $request, $id){
        $banner = Banner::find($id);

        if($banner->display_status == true) {
            $banner->update(['display_status' => false]);
        }
        else {
            $banner->update(['display_status' => true]);
        }

        $admins = Admin::all();
        //send notfication
        Notification::send($admins, new AdminUserNotification('Banner Updated!', 'Banner Updated Successfully!'));


        return response()->json([
            'message' => 'Banner Updated Successfully'
        ]);
    }

    public function deleteBanner(Request $request, $id){
        try {
            

            $banner = Banner::find($id);
            //delete banner image
            $imageUploadService = new ImageUploadService();
            $imageUploadService->deleteImage($banner->image, 'banner/');

            $admins = Admin::all();
            //send notfication
            Notification::send($admins, new AdminUserNotification('Banner Deleted!', 'Banner Deleted Successfully!'));

            $banner->delete();

            return response()->json([
                'message' => 'Banner Deleted Successfully'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    
    public function viewCharge(Request $request){
        $serviceCharge = ServiceCharge::first();
        if($serviceCharge ===  null){
            $serviceCharge = ServiceCharge::create([
                'service_charge' => 0.0
            ]);
        }

        if($request->ajax == 'true'){
            return view('dashboard.ajaxpages.UpdateServiceCharge', $this->data)->with(['serviceCharge' => $serviceCharge]);
        }
        return view('dashboard.menu.updateServiceCharge', $this->data)->with(['serviceCharge' => $serviceCharge]);
    }


    public function updateCharge(Request $request){
        $banner = ServiceCharge::first();
        $banner->update([
            'service_charge' => $request->service_charge
        ]);
        $admins = Admin::all();
        //send notfication
        Notification::send($admins, new AdminUserNotification('Service Charge Updated!', 'Service Charge Updated Successfully!'));


        return response()->json([
            'message' => 'Banner Updated Successfully'
        ]);
    }

}