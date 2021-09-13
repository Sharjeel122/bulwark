  <!-- nvabar for mobile  -->
    <div class="dashoard-navbar-area container-fluid bg-success">
        <div class="row">
            <div class="col-8 mt-auto my-auto">
                <div class="mobile-toggle-fixed">
                    <button class="navbar-toggler d-block d-sm-none d-md-none d-lg-none sidbar-open-btnn mt-auto my-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i style="    font-size: 36px;
                         color: white;" class="fa fa-bars"></i></span>
                       </button>
                     <div class="d-none d-lg-block d-sm-block d-md-block">
                         <h3 class="logo-text">Cyber Bulwark</h3>
                     </div>
                     <div class="d-block d-lg-none d-sm-none d-md-none mt-auto ">
                       <h3 class="logo-text">Cyber Bulwark</h3>
                   </div>
                     </div>
              </div>

            <div class="col-4 text-right my-auto">
                <div class="ml-auto">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item dropdown notification">
                            <a class="nav-link  text-white  " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog "></i>

                                <div class="ripple-container"></div></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @hasrole('employee1|employee2')
                                <a class="dropdown-item" href="{{ route('employee.dashboard') }}">Profile</a>
                                @endhasrole

                                @hasrole('admin')
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Profile</a>
                                @endhasrole

                                @hasrole('customer')
                                <a class="dropdown-item" href="{{ route('customer.index') }}">Profile</a>
                                @endhasrole
                     <a class="dropdown-item" href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
     <div class="navbar-collapse collapse " id="navbarSupportedContent" >

              <div class="sidbar-link-for-mobile-only d-lg-none d-md-none d-sm-none d-block">

             <ul class="navbar-nav m-auto  left-navs-list">

                   <ul class="sidear-link-list">

                       @hasrole('admin')
                       <li class="{{ Request::is('admin') ? 'active' : '' }} sidear-link-list-items "><a href="{{ route('admin.index') }}"><i
                                   class="fa fa-tachometer"></i> Dashborad</a></li>
                       <li class="{{ Request::is('admin-all-customers') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('admin.customers') }}"><i class="fa fa-eye"></i>
                               View Customers</a></li>
                       <li class="{{ Request::is('admin-all-leads') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('admin.leads') }}"><i
                                   class="fa fa-user-secret"></i> View Leads</a></li>
                       <li class="{{ Request::is('admin-all-employees') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('admin.employees') }}"><i
                                   class="fa fa-smile-o"></i> View Employees</a></li>
                       <li class="{{ Request::is('admin-support-tickers') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('admin.support.tickers') }}"><i
                                   class="fa fa-ticket"></i> Support Ticket</a></li>
                       <li class="{{ Request::is('paypal-plan') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('paypal-plan.index') }}"><i
                                   class="fa fa-handshake-o"></i> Plans</a></li>
                       <li class="{{ Request::is('reports') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('admin.reports') }}"><i
                                   class="fa fa-flag-o"></i> Upload Report</a></li>
                       @endhasrole

                       @hasrole('customer')
                       <li class="{{ Request::is('customer') ? 'active' : '' }} sidear-link-list-items "><a href="{{ route('customer.index') }}"><i
                                   class="fa fa-tachometer"></i> Dashborad</a></li>
                       <li class="{{ Request::is('support-tickers') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('customer.support.tickers') }}"><i
                                   class="fa fa-ticket"></i> Support Ticket</a></li>
                       <li class="{{ Request::is('websites') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('customer.website') }}"><i
                                   class="fa fa-globe"></i> My Websites</a></li>
                       <li class="{{ Request::is('view-reports') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('customer.reports') }}"><i
                                   class="fa fa-flag-o"></i> View Report</a></li>
                       @endhasrole

                       {{--Employee Common Route starts--}}
                       @hasrole('employee1|employee2')
                       <li class="{{ Request::is('employee') ? 'active' : '' }} sidear-link-list-items "><a href="{{ route('employee.index') }}"><i
                                   class="fa fa-tachometer"></i> Dashborad</a></li>
                       <li class="{{ Request::is('employee-reports') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('employee.reports') }}"><i
                                   class="fa fa-flag-o"></i> Upload Report</a></li>
                       <li class="{{ Request::is('employee-support-tickers') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('employee.support.tickers') }}"><i
                                   class="fa fa-ticket"></i> Support Ticket</a></li>
                       <li class="{{ Request::is('employee-all-customers') ? 'active' : '' }} sidear-link-list-items  "><a href="{{ route('employee.customers') }}"><i class="fa fa-eye"></i>
                               View Customers</a></li>
                       @endhasrole
                       {{--Employee Common Route ends--}}

                       <li class="sidear-link-list-items "><a class="dropdown-item" href="{{ route('logout') }}"
                                                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                               <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                       </li>
                   </ul>
               <!--<ul class="sidear-link-list">-->
                   <!--<li class="sidear-link-list-items"><a href="account-setting.html"><i class="fa fa-cog"></i> Account Setting</a></li>-->
                   <!--<li class="sidear-link-list-items "><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>-->
               <!--</ul>-->
            </ul>

          </div>
          </div>
    </div>
