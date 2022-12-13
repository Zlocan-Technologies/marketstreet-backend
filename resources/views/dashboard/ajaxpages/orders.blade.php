<div class="row">
  <div class="col-sm-12 col-xl-6 xl-100">
    <div class="card">
    <div class="w-100 px-3 pt-5 row d-flex justify-content-between align-items-center">
                        <div class="col-lg-6 col-sm-6 px-3 py-0">
                          <form onsubmit="searchOrder(event)"  method="get">
                            <div class="mb-3 m-form__group">
                                <div class="h3"> From  - To</div>
                              <div class="input-group pt-2 d-flex justify-content-between align-items-center" style="width: 400px; max-width: 100%;">
                                  <i onclick="searchOrder(event)" style="border-radius: 10px 0px 0px 10px; border-right:none;" class="mt-2 input-group-text fa fa-search text-secondary h5 bg-transparent"></i>
                                  <input type="date" name="from" id="from" class="form-control" style="border-left:none; height: 35px; border-radius: 0px 10px 10px 0px;" placeholder="From">
                                  <input type="date" name="to" id="to" class="form-control" style="border-left:none; height: 35px; border-radius: 0px 10px 10px 0px;" placeholder="To">
                                </div>
                              </div>
                            </form>
                          
                        </div>
                        
                        <div class="col-lg-6 col-sm-6 px-3 py-0">
                            <div class="d-flex justify-content-end align-items-center">
                              <div>
                            <i role="button" onclick="changeState(`{{ route('orders') }}`)" class="pt-2 mx-1 fa  fa-refresh h4 text-secondary"></i>
                              </div>
                              
                            </div>
                      </div>
                  </div>

      <div class="card-body">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <!--Pending tab-->
          <li class="nav-item">
            <a
              class="nav-link active"
              id="pills-home-tab"
              data-bs-toggle="pill"
              href="#pills-home"
              role="tab"
              aria-controls="pills-home"
              aria-selected="true"
              >Pending
              <div class="media"></div
            ></a>
          </li>
          <!--Active tab-->
          <li class="nav-item">
            <a
              class="nav-link"
              id="pills-profile-tab"
              data-bs-toggle="pill"
              href="#pills-profile"
              role="tab"
              aria-controls="pills-profile"
              aria-selected="false"
              >Active</a
            >
          </li>

          <!--Confirmed Orders tab-->
          <li class="nav-item">
            <a
              class="nav-link"
              id="confirmed-tab"
              data-bs-toggle="pill"
              href="#confirmed"
              role="tab"
              aria-controls="confirmed"
              aria-selected="false"
              >Confirmed</a
            >
          </li>

           <!--Delivered Orders tab-->
           <li class="nav-item">
            <a
              class="nav-link"
              id="delivered-tab"
              data-bs-toggle="pill"
              href="#delivered"
              role="tab"
              aria-controls="delivered"
              aria-selected="false"
              >Delivered</a
            >
          </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!--Pending Orders tab-->
          <div
            class="tab-pane fade show active"
            id="pills-home"
            role="tabpanel"
            aria-labelledby="pills-home-tab">
            <div class="row d-flex justify-content-between align-items-center">
              @forelse($pendingOrders as $order)
              <div class="col-sm-12 col-md-6 col-xl-6 mt-4">
                <div class="card height-equal shadow-lg">
                  <div class="card-header py-0 pt-4">
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <div class="">
                        <p>Order ID: {{ $order->order_no }}</p>
                      </div>

                      <div>
                        <p>Order Date: {{ $order->created_at->diffForHumans() }}</p>
                      </div>
                    </div>
                    
                    <div class="">
                        <button style="cursor:pointer" onclick="changeState(`{{ route('show-order', ['id' => $order->id ]) }}`)" class="btn btn-outline-info btn-sm">Show Order Info</button>
                      </div>
                    <div
                      class="my-3 d-flex justify-content-start align-items-center"
                    >
                      <div class="mr-2">
                        <img
                          src="https://picsum.photos/200/300"
                          style="width: 30px; height: 30px; border-radius: 50%"
                          alt="img"
                        />
                      </div>
                    </div>

                    <div
                      class="my-3 d-flex justify-content-end align-items-center"
                    >
                      <div>
                        <p>Payment- <b>{{ $order->payment_channel }}</b></p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer py-0">
                    <div
                      class="my-3 d-flex justify-content-between align-items-center"
                    >
                      <!-- <div class="d-flex justify-content-between align-items-center"> -->
                        <p>Order Total: {{ $order->total }}</p>
                        <p>Customer: {{ $order->user->firstname }}</p>
                      <!-- </div> -->

                      <!-- <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <button onclick="confirmOrder(event, {{ $order->id}})" class="btn-info border-0 btn-md ml-2 px-4 py-2">
                          Confirm
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              @empty
                <p>There are Currently no Pending Orders</p>
              @endforelse
              <!--Pagination Links-->
              <div div="row">
                          <ul class="pagination pagination-primary justify-content-end">
                              <li>{{ $pendingOrders->links("pagination::bootstrap-4") }}</li>
                          </ul>   
                      </div>
        <!--End pagination Links-->
            </div>
          </div>

          <!--Active Orders Tab-->
          <div
            class="tab-pane fade"
            id="pills-profile"
            role="tabpanel"
            aria-labelledby="pills-profile-tab">
            <div class="row d-flex justify-content-between align-items-center">
              @forelse($activeOrders as $order)
              <div class="col-sm-12 col-md-6 col-xl-6 mt-4">
                <div class="card height-equal shadow-lg">
                  <div class="card-header py-0 pt-4">
                    <div
                      class="d-flex justify-content-between align-items-center"
                    >
                      <div class="">
                        <p>Order ID: {{ $order->order_no }}</p>
                      </div>

                      <div>
                        <p>Order Date: {{ $order->created_at->diffForHumans() }}</p>
                      </div>
                    </div>
                    
                    <div class="">
                        <button style="cursor:pointer" onclick="changeState(`{{ route('show-order', ['id' => $order->id ]) }}`)" class="btn btn-outline-info btn-sm">Show Order Info</button>
                      </div>
                    <div
                      class="my-3 d-flex justify-content-start align-items-center"
                    >
                      <div class="mr-2">
                        <img
                          src="https://picsum.photos/200/300"
                          style="width: 30px; height: 30px; border-radius: 50%"
                          alt="img"
                        />
                      </div>
                    </div>

                    <div
                      class="my-3 d-flex justify-content-end align-items-center"
                    >
                      <div>
                        <p>Payment- <b>{{ $order->payment_channel }}</b></p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer py-0">
                    <div
                      class="my-3 d-flex justify-content-between align-items-center"
                    >
                      <!-- <div class="d-flex justify-content-between align-items-center"> -->
                        <p>Order Total: {{ $order->total }}</p>
                        <p>Customer: {{ $order->user->firstname }}</p>
                      <!-- </div> -->

                      <!-- <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <button onclick="confirmOrder(event, {{ $order->id}})" class="btn-info border-0 btn-md ml-2 px-4 py-2">
                          Confirm
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              @empty
                <p>There are Currently no Active Orders</p>
              @endforelse
              <!--Pagination Links-->
              <div div="row">
                          <ul class="pagination pagination-primary justify-content-end">
                              <li>{{ $activeOrders->links("pagination::bootstrap-4") }}</li>
                          </ul>   
                      </div>
        <!--End pagination Links-->
            </div>
          </div>


            <!--Confirmed Orders tab-->
          <div  class="tab-pane fade" id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab">
              <div class="row d-flex justify-content-between align-items-center">
                @forelse($confirmedOrders as $order)
                <div class="col-sm-12 col-md-6 col-xl-6 mt-4">
                  <div class="card height-equal shadow-lg">
                    <div class="card-header py-0 pt-4">
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <div class="">
                          <p>Order ID: {{ $order->order_no }}</p>
                        </div>

                        <div>
                          <p>Order Date: {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                      </div>
                      
                      <div class="">
                          <button style="cursor:pointer" onclick="changeState(`{{ route('show-order', ['id' => $order->id ]) }}`)" class="btn btn-outline-info btn-sm">Show Order Info</button>
                        </div>
                      <div
                        class="my-3 d-flex justify-content-start align-items-center"
                      >
                        <div class="mr-2">
                          <img
                            src="https://picsum.photos/200/300"
                            style="width: 30px; height: 30px; border-radius: 50%"
                            alt="img"
                          />
                        </div>
                      </div>

                      <div
                        class="my-3 d-flex justify-content-end align-items-center"
                      >
                        <div>
                          <p>Payment- <b>{{ $order->payment_channel }}</b></p>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer py-0">
                      <div
                        class="my-3 d-flex justify-content-between align-items-center"
                      >
                        <!-- <div class="d-flex justify-content-between align-items-center"> -->
                          <p>Order Total: {{ $order->total }}</p>
                          <p>Customer: {{ $order->user->firstname }}</p>
                        <!-- </div> -->

                        <!-- <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <button onclick="confirmOrder(event, {{ $order->id}})" class="btn-info border-0 btn-md ml-2 px-4 py-2">
                            Confirm
                          </button>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                  <p>There are Currently no Sonfirmed Orders</p>
                @endforelse
                <!--Pagination Links-->
                <div div="row">
                            <ul class="pagination pagination-primary justify-content-end">
                                <li>{{ $confirmedOrders->links("pagination::bootstrap-4") }}</li>
                            </ul>   
                        </div>
          <!--End pagination Links-->
              </div>
          </div>


          <!--Delivered Orders-->
          <div  class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
              <div class="row d-flex justify-content-between align-items-center">
                @forelse($deliveredOrders as $order)
                <div class="col-sm-12 col-md-6 col-xl-6 mt-4">
                  <div class="card height-equal shadow-lg">
                    <div class="card-header py-0 pt-4">
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <div class="">
                          <p>Order ID: {{ $order->order_no }}</p>
                        </div>

                        <div>
                          <p>Order Date: {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                      </div>
                      
                      <div class="">
                          <button style="cursor:pointer" onclick="changeState(`{{ route('show-order', ['id' => $order->id ]) }}`)" class="btn btn-outline-info btn-sm">Show Order Info</button>
                        </div>
                      <div
                        class="my-3 d-flex justify-content-start align-items-center"
                      >
                        <div class="mr-2">
                          <img
                            src="https://picsum.photos/200/300"
                            style="width: 30px; height: 30px; border-radius: 50%"
                            alt="img"
                          />
                        </div>
                      </div>

                      <div
                        class="my-3 d-flex justify-content-end align-items-center"
                      >
                        <div>
                          <p>Payment- <b>{{ $order->payment_channel }}</b></p>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer py-0">
                      <div
                        class="my-3 d-flex justify-content-between align-items-center"
                      >
                        <!-- <div class="d-flex justify-content-between align-items-center"> -->
                          <p>Order Total: {{ $order->total }}</p>
                          <p>Customer: {{ $order->user->firstname }}</p>
                        <!-- </div> -->

                        <!-- <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <button onclick="confirmOrder(event, {{ $order->id}})" class="btn-info border-0 btn-md ml-2 px-4 py-2">
                            Confirm
                          </button>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                  <p>There are Currently no Delivered Orders</p>
                @endforelse
                <!--Pagination Links-->
                <div div="row">
                            <ul class="pagination pagination-primary justify-content-end">
                                <li>{{ $deliveredOrders->links("pagination::bootstrap-4") }}</li>
                            </ul>   
                        </div>
          <!--End pagination Links-->
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .swal-overlay {
    background-color: rgba(0,0,0,0.5);
  }
</style>