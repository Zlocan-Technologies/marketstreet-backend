<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a onclick="changeState(`{{ route('dashboard') }}`)" style="cursor:pointer;"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a>
        <div class="back-btn"></div>
      </div>
      <div class="logo-icon-wrapper"><a onclick="changeState(`{{ route('dashboard') }}`)" style="cursor:pointer;"><img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a onclick="changeState(`{{ route('dashboard') }}`)" style="cursor:pointer;"><img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">        </i></div>
            </li>

           

            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"  onclick="changeState(`{{ route('dashboard') }}`)" style="cursor:pointer;">
                <span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g> 
                            <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
                    Dashboard</span></a><
            </li>
                
            {{--  menu starts  --}}
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" style="cursor:pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g> 
                    <g> 
                      <path d="M15.7499 9.47167V6.43967C15.7549 4.35167 14.0659 2.65467 11.9779 2.64967C9.88887 2.64567 8.19287 4.33467 8.18787 6.42267V9.47167" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M2.94995 14.2074C2.94995 8.91344 5.20495 7.14844 11.969 7.14844C18.733 7.14844 20.988 8.91344 20.988 14.2074C20.988 19.5004 18.733 21.2654 11.969 21.2654C5.20495 21.2654 2.94995 19.5004 2.94995 14.2074Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg><span>Menu</span></a>
              <ul class="sidebar-submenu">
                <li><a onclick="changeState(`{{ route('categories') }}`)" style="cursor:pointer;">Category</a></li>
                <li><a onclick="changeState(`{{ route('orders') }}`)" style="cursor:pointer;">Orders</a></li>
                <li><a onclick="changeState(`{{ route('view-coupons') }}`)" style="cursor:pointer;">Coupon</a></li>
                <li><a onclick="changeState(`{{ route('view-banner') }}`)" style="cursor:pointer;">Banner</a></li>
                <li><a onclick="changeState(`{{ route('view-charge') }}`)" style="cursor:pointer;">Service Charge</a></li>             
              </ul>
            </li>


            {{--  menu ends  --}}



            {{--  users management  --}}

            <li class="sidebar-list"><a class="sidebar-link sidebar-title" style="cursor:pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g> 
                      <g> 
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9724 20.3683C8.73343 20.3683 5.96643 19.8783 5.96643 17.9163C5.96643 15.9543 8.71543 14.2463 11.9724 14.2463C15.2114 14.2463 17.9784 15.9383 17.9784 17.8993C17.9784 19.8603 15.2294 20.3683 11.9724 20.3683Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9725 11.4488C14.0985 11.4488 15.8225 9.72576 15.8225 7.59976C15.8225 5.47376 14.0985 3.74976 11.9725 3.74976C9.84645 3.74976 8.12245 5.47376 8.12245 7.59976C8.11645 9.71776 9.82645 11.4418 11.9455 11.4488H11.9725Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M18.3622 10.3915C19.5992 10.0605 20.5112 8.93254 20.5112 7.58954C20.5112 6.18854 19.5182 5.01854 18.1962 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M18.9431 13.5444C20.6971 13.5444 22.1951 14.7334 22.1951 15.7954C22.1951 16.4204 21.6781 17.1014 20.8941 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M5.58372 10.3915C4.34572 10.0605 3.43372 8.93254 3.43372 7.58954C3.43372 6.18854 4.42772 5.01854 5.74872 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M5.00176 13.5444C3.24776 13.5444 1.74976 14.7334 1.74976 15.7954C1.74976 16.4204 2.26676 17.1014 3.05176 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                </svg><span>User Management</span></a>
              <ul class="sidebar-submenu">
                <li><a onclick="changeState(`{{ route('users') }}`)" style="cursor:pointer;">Users</a></li>
                <li><a onclick="changeState(`{{ route('blocked-users') }}`)" style="cursor:pointer;">Blocked Users</a></li>
              </ul>
            </li>


            {{--  users management ends  --}}

            {{--  Reports  --}}
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" style="cursor:pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g> 
                    <g> 
                      <path d="M15.7499 9.47167V6.43967C15.7549 4.35167 14.0659 2.65467 11.9779 2.64967C9.88887 2.64567 8.19287 4.33467 8.18787 6.42267V9.47167" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M2.94995 14.2074C2.94995 8.91344 5.20495 7.14844 11.969 7.14844C18.733 7.14844 20.988 8.91344 20.988 14.2074C20.988 19.5004 18.733 21.2654 11.969 21.2654C5.20495 21.2654 2.94995 19.5004 2.94995 14.2074Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg><span>Reports</span></a>
              <ul class="sidebar-submenu">
                <li><a onclick="changeState(`{{ route('orders-report') }}`)" style="cursor:pointer;">Orders</a></li>
                <li><a onclick="changeState(`{{ route('view-payments') }}`)" style="cursor:pointer;">Payments</a></li>
              
              </ul>
            </li>


            {{--  Reports  --}}


            {{--  settings  start--}}

            <li class="sidebar-list" onclick="changeState(`{{ route('app-settings')}}`)"><a class="sidebar-link sidebar-title" style="cursor:pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g> 
                      <g> 
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 12C2.75 5.063 5.063 2.75 12 2.75C18.937 2.75 21.25 5.063 21.25 12C21.25 18.937 18.937 21.25 12 21.25C5.063 21.25 2.75 18.937 2.75 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.9935 12H16.0025" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.9945 12H12.0035" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.9955 12H8.0045" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>

                </svg><span>App Settings</span></a>
            </li>


            {{--  settings end --}}

          </ul>

          </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>

  
  <script src="{{ asset('js/sidebar.js') }}"></script>