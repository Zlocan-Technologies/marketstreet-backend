<!-- Container-fluid starts-->
<div class="container-fluid">
            <div class="row">
            <div class="col-sm-12 table-wdt">
                <div class="card">
                  <div class="card-header">
                    <h5>Pending Payments</h5>
                    <div class="w-100 row d-flex justify-content-between align-items-center">
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
                            <i role="button" onclick="changeState(`{{ route('orders-report') }}`)" class="pt-2 mx-1 fa  fa-refresh h4 text-secondary"></i>
                              </div>
                              
                            </div>
                      </div>
                  </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-border-horizontal">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Order No.</th>
                          <th scope="col">total</th>
                          <th scope="col">status</th>
                          <th scope="col">mode</th>

                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($payments as $order)
                        <tr>
                          <th scope="row">{{ $loop->index + 1}}</th>
                          <td>{{ $order->user->firstname }}</td>
                          <td>{{ $order->order_no }}</td>
                          <td>&#x20a6;{{ $order->total }}</td>
                          <td>{{ $order->payment_status }}</td>
                          <td>{{ $order->payment_channel }}</td>

                          <td class="d-flex justify-content-start align-items-center">
                            <i onclick="changeState(`{{ route('show-order', ['id' => $order->id])}}`)" role="button" class="fa fa-circle-o h4 text-primary mx-1 px-1 "></i>
                          </td>
                        </tr>
                        @empty
                          <p>There are currently no Payments</p>
                        @endforelse
                      </tbody>
                    </table>
                     <!--Pagination Links-->
                      <div div="row">
                          <ul class="pagination pagination-primary justify-content-start">
                              <li>{{ $payments->links("pagination::bootstrap-4") }}</li>
                          </ul>   
                      </div>
        <!--End pagination Links-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
 
          <script>
            document.querySelectorAll('.page-item .page-link').forEach( (item)=> {
               item.addEventListener('click', function(e) {
                    e.preventDefault();
                    changeState(e.target.href);
                  })
            });
          </script>

    <style>
      .table-wdt {
        scrollbar-width: auto;
        scrollbar-color: #6fd6ff;
      }

      .table-wdt ::-webkit-scrollbar {
        height: 16px;
      }
      .table-wdt ::-webkit-scrollbar-track {
        background: #6fd6ff;
      }
      .table-wdt ::-webkit-scrollbar-thumb{
        background-color: #fff;
        border-radius: 200px;
        border: 2px solid #6fd6ff;
      }
    </style>