<div class="row">
<div class="w-100 px-3 pt-5 row d-flex justify-content-between align-items-center">
      <div class="col-lg-6 col-sm-6 px-3 py-0">
        <form onsubmit="searchOrder(event)"  method="get">
          <div class="mb-3 m-form__group">
              <div class="h3"> From  - To</div>
            <div class="input-group pt-2 d-flex justify-content-between align-items-center" style="width: 400px; max-width: 100%;">
                <i onclick="searchOrder(event)" style="border-radius: 10px 0px 0px 10px; border-right:none;" class="mt-2 input-group-text fa fa-search text-secondary h5 bg-white"></i>
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
  <div class="col-sm-12 col-xl-6 xl-100">
     @include('dashboard.ajaxpages.ordersHome')
  </div>
</div>

<style>
  .swal-overlay {
    background-color: rgba(0,0,0,0.5);
  }
</style>