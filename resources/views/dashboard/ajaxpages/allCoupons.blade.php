<!-- Container-fluid starts-->
<div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Coupons</h5>
                    <div class="p-2 w-100 d-flex justify-content-between align-items-center">
                        <div></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <i role="button" onclick="changeState(`{{ route('create-coupon') }}`)" class="fa  fa-plus-square h2 text-primary"></i>
                        </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-border-horizontal">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Code</th>
                          <th scope="col">Type</th>
                          <th scope="col">Value</th>
                          <th scope="col">Percent Off (%)</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($coupons as $coupon)
                        <tr>
                          <th scope="row">{{ $loop->index + 1}}</th>
                          <td>{{ $coupon->code }}</td>
                          <td>{{ $coupon->type }}</td>
                          <td>{{ $coupon->value }}</td>
                          <td>{{ $coupon->percent_off }}</td>
                          <td class="d-flex justify-content-start align-items-center">
                            <i role="button" onclick="deleteCoupon({{ $coupon->id }})" class="fa fa-trash h3 text-danger mx-1 px-1 "></i>
                            <i role="button" onclick="changeState(`{{ route('edit-coupon',['id' => $coupon->id]) }}`)" class="fa fa-edit h3 text-info mx-1 px-1"></i>
                          </td>
                        </tr>
                        @empty
                          <p>There are currently no Coupons</p>
                        @endforelse
                      </tbody>
                    </table>
                     <!--Pagination Links-->
                      <div div="row">
                          <ul class="pagination pagination-primary justify-content-end">
                              <li>{{ $coupons->links("pagination::bootstrap-4") }}</li>
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

          