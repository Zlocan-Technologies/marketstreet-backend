<div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
    <!--Form container-->
    <div class="mx-auto">
        <div id="messaging" class="messaging d-none p-3 bg-primary text-white">Your Form is currently Processing!</div>
        <form onsubmit="createCoupon(event)" id="couponForm" class="w-100 category-form px-4 py-3">
            @csrf
        <div class="title-header  d-flex justify-content-between align-items-center px-3 py-3">
            <h3 class="px-2 pl-0">Create Coupon</h3>
            <a onclick="changeState(`{{ route('view-coupons') }}`)" style="cursor:pointer; text-decoration: none;">
            <i
                    class="fa fa-angle-left mr-1"
                    style="color: black; font-weight: bold; font-size: 20px;"
                  ></i>
                  Coupon List</a>
        </div>
         <div class="row w-100">
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Code <span class="font-danger ml-2">*</span></label>
                <input type="text" required name="coupon_code" id="coupon_code" class="form-control">
                <button class="btn-sm btn-flat btn-primary" onclick="autoGenerate(event)">Auto</button>
                <!-- <p id="category_name_error" class="hidden error"></p> -->
            </div>
             <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Type</label>
                <input type="text" name="coupon_type" id="coupon_type" class="form-control">
            </div>
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Value</label>
                <input type="number" name="coupon_value" id="coupon_value" class="form-control">
            </div>
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Percent Off <b>(%)</b></label>
                <input type="text" name="percent_off" id="coupon_percent_off" class="form-control">
            </div>
         </div>
         <div class="row">
            <button onclick="createCoupon(event)" id="coupon-btn" type="submit" class="bg-info border-0 btn-lg btn-flat">Submit</button>
         </div>
        </form>
    </div>
</div>



<style>
    .category-form{
        width: 800px;
        max-width: 100%;
        background-color: white;
        box-shadow: 1px 3px 4px #bbb;
    }

    input[type='text'], textarea ,input[type="file"] {
        border-radius: 10px;
    }

    .error {
        color: red;
        font-size: 10px;
        padding: 8px;
    }

</style>