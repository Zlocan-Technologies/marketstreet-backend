
<div class="container-fluid bg-white">
  <div class="title-header px-5 py-3">
    <h3>Menu</h3>
  </div>

  <div class="menu-container">
    <div class="categories row d-flex justify-content-start align-items-center">
      <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="card">
          <div
            class="card-header text-md px-2 py-4 d-flex justify-content-between align-items-center"
          >
            <h5 class="f-18">Categories</h5>
            <div class="icons-box">
              <a onclick="changeState(`{{ route('create-category') }}`)" style="text-decoration: none; cursor:pointer;">
                <i
                class="fa fa-plus-square-o f-24"
                style="color: rgb(25, 164, 199)"
              ></i>
              </a>
              
            </div>
          </div>
          <div class="card-body p-0">
            <div class="list-group w-100" id="categories-tab">
              @forelse($categories as $category)
             <a
                onclick="toggleActive(this)"
                class="list-group-item border-0 list-group-item-action flex-column align-items-start"
                href="javascript:void(0)"
              >
                <div
                  class="row d-flex w-100 justify-content-between align-items-center"
                >
                  <h5 class="col-9 mb-1">{{ $category->name }}</h5>
                  <div class="col-3 d-flex w-100 justify-content-end align-items-center">
                  <i
                   onclick="changeState(`{{ route('edit-category', ['id' => $category->id]) }}`)"
                    class="fa fa-edit mr-1"
                    style="color: rgb(25, 164, 199)"
                  ></i> 
                  <i
                    onclick="deleteCategory({{$category->id}})"
                    class="fa fa-trash ml-1"
                    style="color: red"
                  ></i>
                  </div>
                  
                  </div
              ></a> 
              @empty
              <p>There are currently no categories</p>

              @endforelse
            </div>
          </div>
        </div>
      </div>
    
    </div>


  </div>
</div>
<style>
  .list-group .active {
    background-color: #ADD8E6 !important;
    border-left: 2px solid rgb(25, 164, 199) !important;
    color: black !important;
    transition: all 2s linear forwards;
  }
</style>

