<!--Content Title header-->
<div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" style="cursor:pointer;"  onclick="changeState(`{{ route('dashboard') }}`)"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"> Dashboard</li>
                    <li class="breadcrumb-item active">Home</li>
                  </ol>
                </div>
              </div>
            </div>

          </div>
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <!--Pending Orders-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div class="card" onclick="changeState(`{{ route('orders') }}`)" style="cursor:pointer; padding: 0 !important">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-bottom: 5px solid #1d97ff !important;
              border-radius: 10px;
            "
          >
            <h6>Pending Order</h6>
            <h2>{{ $allOrders['pending']->count() }}</h2>
          </div>
        </div>
      </div>

      <!--Active Orders-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div class="card" onclick="changeState(`{{ route('orders') }}`)" style="cursor:pointer; padding: 0 !important">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-bottom: 5px solid #06da4c !important;
              border-radius: 10px;
            "
          >
            <h6>Active Orders</h6>
            <h2>{{ $allOrders['shipped']->count() }}</h2>
          </div>
        </div>
      </div>

      <!--Delivered Orders-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div class="card" onclick="changeState(`{{ route('orders') }}`)" style="cursor:pointer; padding: 0 !important">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-radius: 10px;
              border-bottom: 5px solid #063f1e !important;
            "
          >
            <h6>Delivered Orders</h6>
            <h2>{{ $allOrders['delivered']->count() }}</h2>
          </div>
        </div>
      </div>

      <!--Confirmed Orders-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div onclick="changeState(`{{ route('orders') }}`)" class="card" style="cursor:pointer; padding: 0 !important">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-radius: 10px;
              border-bottom: 5px solid #ce1b1b !important;
            "
          >
            <h6>Confirmed Orders</h6>
            <h2>{{ $allOrders['confirmed']->count() }}</h2>
          </div>
        </div>
      </div>

      <!--Categories-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div onclick="changeState(`{{ route('categories') }}`)" class="card" style="cursor:pointer; padding: 0 !important; cursor:pointer;">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-bottom: 5px solid #06da4c !important;
              border-radius: 10px;
            "
          >
            <h6>Categories</h6>
            <h2>{{ $categories->count() }}</h2>
          </div>
        </div>
      </div>

      <!--Customers-->
      <div class="col-sm-3 col-md-3 col-xl-3">
        <div class="card" onclick="changeState(`{{ route('users') }}`)" style="cursor:pointer; padding: 0 !important">
          <div
            class="card-header p-0 px-3 pr-4 pt-3 b-b-info"
            style="
              border-radius: 10px;
              border-bottom: 5px solid #ce1b1b !important;
            "
          >
            <h6>Customers</h6>
            <h2>{{ $customers->count() }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Charts Section-->
<div>
<div class="row date-range-picker">
    <div class="col-xl-6">
      <div class="daterange-card">
        <div class="theme-form">
          <div
            class="form-group d-flex justify-content-between align-items-center"
          >
            <input
              id="dateFilter"
              class="form-control digits"
              type="text"
              name="daterange"
              value=""
            />
            <input
              type="button"
              onclick="filterOrders(event)"
              value="Filter By Date"
              class="btn btn-lg btn-info"
              style="font-size: 16px; margin-left: 8px;"
            />
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row all-chart">
    <div class="col-sm-12 col-xl-6 box-col-6">
      <div class="card">
        <div class="card-header pb-0">
          <h5>Orders</h5>
          <p class="right">Orders from {{ $from }} to {{ $to ?? 'Today'}} : <span class="badge badge-info p-1 h5">{{ array_sum($data) }}</span></p>
        </div>
        <div class="card-body chart-block">
          <div class="chart-container">
            <canvas id="myChart" height="220"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-xl-6 box-col-6">
      <div class="card">
        <div class="card-header pb-0">
          <h5>Revenue</h5>
          <p class="float-right">Total : &#x20a6;{{ gettype($revenue) == 'string' ? $revenue : array_sum($revenue) }}</p>
        </div>
        <input type="hidden" name="labels" value="{{ json_encode($labels) }}" id="labels">
        <input type="hidden" name="labels" value="{{ json_encode($data) }}" id="data">
        <input type="hidden" name="labels" value="{{ json_encode($revenue) }}" id="revenue">

        <div class="card-body chart-block">
          <div class="chart-container">
            <canvas id="myChart2" height="220"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--End Charts-->

<!--Orders Tab -->
  @include('dashboard.ajaxpages.ordersHome')
<!--End Orders Tab-->

<!--Order Confirmation modal-->
<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Confirmation</h5>
        <button
          class="btn-close"
          type="button"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="">Preparation Time</div>
        <div class="d-flex justify-content-between align-items-center">
          <input
            type="time"
            class="form-control rounded-sm"
            style="width: 200px"
            value="00:00:00"
          />
          <button class="btn-primary btn-md border-0 rounded-sm py-2 px-5">
            Add preparation time
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button
          class="btn btn-primary btn-md"
          type="button"
          onclick="prepTime()"
        >
          Continue with default
        </button>
      </div>
    </div>
  </div>
</div>


<style>
  .chart-container{
    height: auto;
  }


  @media screen and (max-width: 767px){
    .chart-container{
      height: 240px;
    }
  }
</style>