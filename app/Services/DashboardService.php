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


    public static function getDailyOrders($from = '2022-11-21', $to = '2022-11-28'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $orders = Self::queryOrders()->select(DB::raw('count(id) as `data`, sum(total) as total'),DB::raw('Day(created_at) day'))
                ->groupby('day')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('day', 'asc')
                ->get();
        // return empty template if there are not orders found
        if(count($orders) == 0){
            $days = ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"];
            $total = [0,0,0,0,0,0,0];
            return [$days, $total, $total];
        }

        $daysAndData = $orders->pluck('data', 'day')->toArray();
        $revenueArr = $orders->pluck('total')->toArray();
        // return $daysAndData;
        // return $revenueArr;
        $days = array_keys($daysAndData);
        $total = array_values($daysAndData);
        $revenues = array_values($revenueArr);
        $start_day = $from->day;
        $end_day = $from->endOfWeek()->day;
        $labels =  $days;
        $i = 0;

        //labels 
        for ($curr_day = $start_day; $curr_day <= $end_day; $curr_day++) { 
            if($i == 0){
                //for labels
                if(!in_array($curr_day, $labels)){
                    array_unshift($days, $curr_day);
                    array_unshift($total, 0);// add a value of 0  to total value  for empty day in month
                    array_unshift($revenues, 0);// add a value of 0  to total value  for empty day in month
                }

            }else{
                if(!in_array($curr_day, $labels)){
                    $oldDays = array_splice($days, $i, count($days));
                    $oldTotal = array_splice($total, $i, count($total));
                    $oldRevenue = array_splice($revenues, $i, count($revenues));

                    array_push($days, $curr_day);
                    array_push($total, 0);
                    array_push($revenues, 0);

                    $days = array_merge($days, $oldDays);
                    $total = array_merge($total, $oldTotal);
                    $revenues = array_merge($revenues, $oldRevenue);

                }
            }
            $i++;
        }
        
        //add days of week to data
        for ($i=0; $i < count($days) ; $i++) { 
                $days[$i] = $from->day($days[$i])->shortEnglishDayOfWeek;
        }
        // return $orders;
        return [$days, $total, $revenues];

    }

  
    
    public static function getWeeklyOrders($from = '2022-11-01', $to = '2022-11-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        // $label =  Self::createWeeklyLabels($from, $to);
        // return  $label;
        $orders = Self::checkWeekData($from, $to);
        // return $orders;

        if(count($orders) == 0){
            $weeks = ["Wk 1", "Wk 2", "Wk 3", "Wk 4"];
            $total = [0,0,0,0];
            return [$weeks, $total, $total];
        }

        $weeksAndData = $orders->pluck('data', 'week')->toArray();
        $revenueArr = $orders->pluck('total')->toArray();
        // return $daysAndData;
        // return $revenueArr;
        $weeks = array_keys($weeksAndData);
        $total = array_values($weeksAndData);
        $revenues = array_values($revenueArr);
       
        //add days of week to data
        for ($i=0; $i < count($weeks); $i++) { 
            $dt = $from->week(($weeks[$i] + 1 ));
            $weeks[$i] = $dt->shortEnglishMonth . " wk ". $dt->weekNumberInMonth;
        }

        return [$weeks, $total, $revenues];
 
    }

    public static function checkWeekData($from, $to){
        return Self::queryOrders()->select(DB::raw('count(id) as `data`, sum(total) as total'),DB::raw('Month(created_at) month, Week(created_at) week'))
                ->groupby('month', 'week')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('month', 'asc')
                ->orderBy('week', 'asc')
                ->get();
    }


    public static function getMonthlyOrders($from = '2022-01-01', $to = '2023-03-30'){
          
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        //this is when the search is within a year
            $orders = Self::queryOrders()
                ->select(DB::raw('count(id) as `data`, sum(total) as total'),
                    DB::raw('Month(created_at) month, Year(created_at) year'))
                ->groupby('month', 'year')
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->take(12)
                ->get();
        
        // return $orders;
        if(count($orders) == 0){
            $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun"];
            $total = [0,0,0,0,0,0];
            return [$months, $total, $total];
        }

        $monthAndData = $orders->pluck('data', 'month')->toArray();
        $revenueArr = $orders->pluck('total')->toArray();
        // return $daysAndData;
        // return $revenueArr;
        $months = array_keys($monthAndData);
        $total = array_values($monthAndData);
        $revenues = array_values($revenueArr);
        // return $revenues;
        //add months label to data
        for ($i=0; $i < count($months); $i++) { 
            $dt = $from->month($months[$i]);
            $months[$i] = $dt->shortEnglishMonth  . ' '. $orders[$i]["year"];
        }

        return [$months, $total, $revenues];
 
 
    }

    public static function getYearlyOrders($from = '2022-01-01', $to = '2023-12-30'){
          
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

            
        $yearAndData = $orders->pluck('data', 'year')->toArray();
        $revenueArr = $orders->pluck('total')->toArray();
        $year = array_keys($yearAndData);
        $total = array_values($yearAndData);
        $revenues = array_values($revenueArr);
       
        return [$year, $total, $revenues];
 
    }


}