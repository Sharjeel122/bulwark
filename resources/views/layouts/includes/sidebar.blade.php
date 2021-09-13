<!-- dashbaord sidebar   -->
<div class="dashboard-sidebar">
    <div class="dashboard-sidebar">
        <small class="credit">Design & Developed By: <a href="https://edenspell.com/" target="blank">Eden Spell
                Technologies</a></small>
        <div class="admin-detail-area">
            <div class="admin-name-area">
                <h2 class="text-white mb-0"><i class="fa fa-user"></i> {{ Auth::user()->name }}</h2>
                <h2 class="online-active mb-0"><i class=""></i> Online</h2>

            </div>
        </div>
        <div class="sidebar-link-area">
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

                @hasrole('employee1')
               
                @endhasrole

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
            <hr class="admin-sidbar-lines">
            <!-- <ul class="sidear-link-list">
                <li class="sidear-link-list-items"><a href="account-setting.html"><i class="fa fa-cog"></i> Account Setting</a></li>
                <li class="sidear-link-list-items "><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul> -->
        </div>
    </div>
</div>
