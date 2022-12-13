<div class="container-fluid bg-white">
    <!--header nav-->
    <div class="row d-flex justify-content-between align-items-center pt-3">
        <div class="col-6">
           <h3>Order Detail: <b># <span>{{ $order->order_no }}</span></b></h3> 
        </div>
        
        <div class="col-6 d-flex justify-content-end">
             <select name="order_status" style="width: 300px; max-width: 100%;" id="order_status" class="form-control border border-sm border-info text-info">
                <option value="{{ $order->order_status }}">{{ $order->order_status }}</option>
                @foreach($allOrders as $key => $item)
                    @if($key !==  $order->order_status)
                    <option value="{{ $key }}">{{ $key }}</option>
                    @endif
                @endforeach
             </select>
        </div>
       
    </div>

    <!--body section-->
    <div class="row d-flex justify-content-between align-items-start my-5 p-2">
        <!--left section-->
        <div class="col-lg-8 p-3">
            <!--order info top section-->
            <div class="row d-flex justify-content-between align-items-center pt-3">
            <div class="card">
                  <div class="row card-body d-flex align-items-center ">
                    <div class="col-lg-4 col-6 mb-4">
                       <p class="w-100 text-secondary">Order Date</p>
                        <p class="mb-0">
                            {{ $order->created_at }}
                        </p> 
                    </div>

                    <div class="col-lg-4 col-6 mb-4">
                       <p class="w-100 text-secondary">Reference</p>
                        <p class="mb-0">
                            {{ $order->reference }}
                        </p> 
                    </div>

                    <div class="col-lg-4 col-6 mb-4">
                       <p class="w-100 text-secondary">Payment Channel</p>
                        <p class="mb-0">
                            {{ $order->payment_channel }}
                        </p> 
                    </div>

                    <div class="col-lg-4 col-6 mb-4">
                       <p class="w-100 text-secondary">Coupon</p>
                        <p class="mb-0">
                            {{ $order->coupon ?? 'None' }}
                        </p> 
                    </div>
                    
                  </div>
                </div>
            </div>
        </div>

        <!--right section-->
        <div  class="col-lg-4 p-3">
        <div class="row d-flex align-items-center pt-3">
            <div class="card col-12">
                  <div class="row card-body">
                    <div style="width:fit-content;" class="mb-4 d-flex align-items-center">
                        <p class="w-100 text-secondary pr-3">Customer Name:  <br>
                            {{ $order->user->firstname }}</p>
                        </div>

                        <div style="width:fit-content;" class="mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Email: <br> {{ $order->user->email }}</p>
                        </div>

                        <div style="width:fit-content;" class="mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Phone Number: <br>{{ $order->user->phone }}</p>
                        </div>
                        
                  </div>
                </div>
                <div class="card col-12">
                <div class="row card-body">
                    <div class="col-12 mb-4 d-flex align-items-center">
                        <p class="w-100 text-secondary pr-3">Order  Price:  
                            <span class="font-weight-bold float-end">&#x20a6;{{ $order->subtotal }}</span>
                        </p>
                        </div>

                        <div class="col-12 mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Discount: <span class="font-weight-bold float-end">&#x20a6;{{ $order->coupon ?? 0 }}</span></p>
                        </div>

                        <div class="col-12 mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Shipping Cost: <span class="font-weight-bold float-end">&#x20a6;{{ $order->shipping_cost }}</span></p>
                        </div>

                        <div class="col-12 mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Service Charge: <span class="font-weight-bold float-end">&#x20a6;{{ $order->subcharge }}</span></p>
                        </div>

                        <div class="col-12 mb-4 d-flex align-items-center">
                            <p class="w-100 text-secondary pr-3">Sub Total: <span class="font-weight-bold float-end">&#x20a6;{{ $order->subtotal }}</span></p>
                        </div>
                    <hr>
                        <div class="col-12 mb-4 d-flex align-items-center bg-primary">
                            <p class="w-100 h3 py-3 text-white pr-3">Total: <span class="font-weight-bold float-end">&#x20a6;{{ $order->total }}</span></p>
                        </div>
                        
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: 1px solid #6fd6ff !important;
        box-shadow: none !important;
    }

</style>