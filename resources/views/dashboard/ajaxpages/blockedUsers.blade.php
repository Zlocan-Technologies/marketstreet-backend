<!-- Container-fluid starts-->
<div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Blocked Users</h5>
                    <div class="w-100 row d-flex justify-content-between align-items-center">
                        <div class="col-lg-6 col-sm-6 px-3 py-0">
                          <form onsubmit="searchUser(event)"  method="get">
                            <div class="mb-3 m-form__group">
                              <div class="input-group pt-2 d-flex justify-content-between align-items-center" style="width: 400px; max-width: 100%;">
                                  <i onclick="searchUser(event)" style="border-radius: 10px 0px 0px 10px; border-right:none;" class="mt-2 input-group-text fa fa-search text-secondary h5 bg-transparent"></i>
                                  <input type="text" name="query" id="search_query" class="form-control" style="border-left:none; height: 35px; border-radius: 0px 10px 10px 0px;" placeholder="Search by Name/email/Phone">
                                </div>
                              </div>
                            </form>
                          
                        </div>
                        
                        <div class="col-lg-6 col-sm-6 px-3 py-0">
                            <div class="d-flex justify-content-end align-items-center">
                              <div class="mr-2 d-flex justify-content-center align-items-center">
                              <span>Create Coupon</span>
                                <i role="button" onclick="changeState(`{{ route('create-coupon') }}`)" class="pt-2 mx-1 fa  fa-plus-square h2 text-primary"></i>
                              </div>

                              <div>
                                <i role="button" onclick="changeState(`{{ route('users') }}`)" class="pt-2 mx-1 fa  fa-refresh h4 text-secondary"></i>
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
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($users as $user)
                        <tr>
                          <th scope="row">{{ $loop->index + 1}}</th>
                          <td>{{ $user->firstname }}</td>
                          <td>{{ $user->lastname }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phone }}</td>
                          <td class="d-flex justify-content-start align-items-center">
                            <i role="button" onclick="unBlockUser({{ $user->id }})" class="fa fa-unlock-alt h3 text-success mx-1 px-1 "></i>
                          </td>
                        </tr>
                        @empty
                          <p>There are currently no registered users!</p>
                        @endforelse
                      </tbody>
                    </table>
                     <!--Pagination Links-->
                      <div div="row">
                          <ul class="pagination pagination-primary justify-content-end">
                              <li>{{ $users->links("pagination::bootstrap-4") }}</li>
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

          