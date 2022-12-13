<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{

    public $coupon_code;
    public $coupon_type;
    public $coupon_value;
    public $percent_off;

    public function __construct($coupon_code, $coupon_type = null, $coupon_value = null, $percent_off = null){
        $this->coupon_code = $coupon_code;
        $this->coupon_type = $coupon_type; 
        $this->coupon_value = $coupon_value;
        $this->percent_off = $percent_off;
    }


    public function create(){
    
       //create coupon
       $coupon = Coupon::firstOrCreate([
           'code' => $this->coupon_code,
           'type'    => $this->coupon_type,
           'value' => $this->coupon_value,
           'percent_off' => $this->percent_off
       ]);

       return $coupon;
    }    

    public function update($coupon_id)
    {
        //find the category
        $coupon = Coupon::findOrFail($coupon_id);
    
        $coupon->update([
            'code' => $this->coupon_code,
            'type'    => $this->coupon_type,
            'value' => $this->coupon_value,
            'percent_off' => $this->percent_off
        ]);  

        $newCoupon= $coupon->refresh();
        return $newCoupon;
    }

    public function delete($coupon_id){
        $coupon = Coupon::findOrFail($coupon_id);
        $coupon->delete();
        return 'Deleted Successfully!';
    }

}