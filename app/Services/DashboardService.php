<?php


namespace App\Services;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\SubOrder;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use DB;
use \Carbon\Carbon;

class DashboardService {

    //get customers data
    public static function getCustomers() {
        $customers = User::latest()->get();
        return $customers;
    }


    public static function getCategories() {
        $categories = Category::latest()->get();
        return $categories;
    }


    public static function queryOrders(){
        $orders = Order::query();
        return $orders;
    }

    public static function allOrders(){
        // $orders = Order::all()->groupBy('order_status');
        $pending = Self::queryOrders()->where('order_status', 'pending')->get();
        $shipped = Self::queryOrders()->where('order_status', 'shipped')->get();
        $delivered = Self::queryOrders()->where('order_status', 'delivered')->get();
        $confirmed = Self::queryOrders()->where('order_status', 'confirmed')->get();

        $orders = ['pending' => $pending, 'shipped' => $shipped, 
                    'delivered' => $delivered, 'confirmed' => $confirmed];
        return $orders;
    }

    public static function getPendingOrders() {
        $orders = Order::where('order_status', 'pending')->paginate(10);
        return $orders->makeVisible('created_at');
    }

    
    public static function getActiveOrders() {
        $orders = Order::where('order_status', 'shipped')->paginate(10);
        return  $orders->makeVisible('created_at');
    }


    public static function getDeliveredOrders() {
        $orders = Order::where('order_status', 'delivered')->paginate(10);
        return  $orders->makeVisible('created_at');
    }

    public static function getConfirmedOrders() {
        $orders = Order::where('order_status', 'confirmed')->paginate(10);
        return  $orders->makeVisible('created_at');
    }

    public static function pendingPayments()
    {
        $orders = Order::where('payment_status', 'pending')->paginate(20);
        return $orders;
    }



    //paginate collections
    public static function paginate(Collection $results, $showPerPage)
    {
        $pageNumber = Paginator::resolveCurrentPage('page');
        
        $totalPageNumber = $results->count();

        return self::paginator($results->forPage($pageNumber, $showPerPage), $totalPageNumber, $showPerPage, $pageNumber, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }



    public static function getOrdersByDate($from = '2021-02-01', $to = '2022-11-30'){
       
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        // $to->addDays(1);
        
        //daily orders
        if($from->diffInDays($to) <= 7){
            return Self::getDailyOrders($from, $to);
        }

        //this is weekly orders
        if($from->diffInDays($to) <= 31){
            return Self::getWeeklyOrders($from, $to);
        }

        //this is when the search is within a year
        if($from->diffInMonths($to) <= 12){
            return Self::getMonthlyOrders($from, $to);
        }

        //if the search is over a year
        if($from->diffInMonths($to) > 12){
            return Self::getYearlyOrders($from, $to);
        }
        
    }


    public static function getDailyOrders($from = '2022-11-01', $to = '2022-12-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $dataAndLabels =  Self::createDailyLabels($from, $to);
        return  $dataAndLabels;
    }

    public static function createDailyLabels($from, $to){
        $labels = array();
        $data =  array();
        $revenue = array();
        //check if there is an order for the current date and push the data to array
        $curr_day = $from;
        $start_day = $from->day;
        $end_day = $to->day;
        // return $end_day;
        $i = 0;
        while ($i < 7) {
            $data[] = count(Self::checkOrderDay($curr_day->day, $curr_day->month, $curr_day->year));
            $labels[] = $curr_day->shortEnglishDayOfWeek;
            $revenue[] = collect(Self::checkOrderDay($curr_day->day, $curr_day->month, $curr_day->year))->sum('total');

            //update the current day and start day
            $newDay = Carbon::parse($curr_day);
            //reset current day to tomorrow
            $curr_day = $newDay->addDays(1);
            $start_day = $curr_day->day;
            $i++;
        }
        
        return [$labels, $data, $revenue];
    }


    public static function checkOrderDay($orderDay, $orderMonth, $orderYear){
        return Self::queryOrders()
                ->whereDay('created_at', $orderDay)
                ->whereMonth('created_at', $orderMonth)
                ->whereYear('created_at', $orderYear)
                ->get();
    }

    
    public static function getWeeklyOrders($from = '2022-11-01', $to = '2022-11-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $label =  Self::createWeeklyLabels($from, $to);
        return  $label;
 
    }

    public static function createWeeklyLabels($from, $to){
        $label = array();
        $data = array();
        $revenue = array();

        $orders = Self::checkWeekData($from, $to);
        
        for ($i=0; $i < count($orders); $i++) { 
            $label[] = 'Week  '. $i+1;
            $data [] = $orders[$i]->data;
            $revenue [] = $orders[$i]->total;
        }
        return [$label, $data ,$revenue];
    }

    public static function checkWeekData($from, $to){
        return Self::queryOrders()->select(DB::raw('count(id) as `data`, sum(total) as total'),DB::raw('Month(created_at) month, Week(created_at) week'))
                ->groupby('month', 'week')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('month', 'asc')
                ->orderBy('week', 'asc')
                ->get();
    }


    public static function getMonthlyOrders($from = '2022-01-01', $to = '2022-11-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        //this is when the search is within a year
            $orders = Self::queryOrders()
                ->select(DB::raw('count(id) as `data`, sum(total) as total'),
                    DB::raw('Month(created_at) month'))
                ->groupby('month')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('month', 'asc')
                ->take(12)
                ->get();

            $label = Self::createMonthlyLabels($from, $to, $orders);
            return $label;
            // return $orders;
 
    }

    public static function createMonthlyLabels($from, $to, $orders = []){
        $labels = array();
        $data =  array();
        $revenue = array();
        //check if there is an order for the current date and push the data to array
        $curr_day = $from;
        // return $end_day;
        // $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        // $monthValues = array();
        for ($i=0; $i < 12; $i++) { 
            if(array_key_exists($i, $orders->toArray())){
                $data[] = $orders[$i]->data;
                $labels[] = $curr_day->month($orders[$i]->month)->shortEnglishMonth;
                $revenue[] = $orders[$i]->total;
            }
        }
        
        return [$labels, $data, $revenue];
    }

    public static function getYearlyOrders($from = '2022-01-01', $to = '2022-11-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        //this is when the search is within a year
            $orders = Self::queryOrders()
                ->select(DB::raw('count(id) as `data`, sum(total) as total'),
                    DB::raw('Year(created_at) year'))
                ->groupby('year')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('year', 'asc')
                ->take(12)
                ->get();

            $labels  = Self::createYearlyLabels($from, $to, $orders);
            return $labels;
    }

    public static function createYearlyLabels($from, $to, $orders = []){
        $labels = array();
        $data =  array();
        $revenue = array();
        //check if there is an order for the current date and push the data to array 
       for ($i=0; $i < count($orders); $i++) { 
                $data[] = $orders[$i]->data;
                $labels[] = $orders[$i]->year;
                $revenue = $orders[$i]->total;
        }
        
        return [$labels, $data, $revenue];
    }



}