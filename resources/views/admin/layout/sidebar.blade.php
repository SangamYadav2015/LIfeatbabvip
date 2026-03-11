<!-- ========== Left Sidebar Start ========== -->
@php
$userRole =getMenuUserRole(Auth::id());
@endphp

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{url('admin/dashboard')}}">
                        <i data-feather="home"></i>
                        <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-apps">Apps</li>
                @if(inArrayCheck('manage_menu', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="menu"></i>
                       <span data-key="t-menu">Manage Menu</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.menuList') }}" key="t-products">Menu List</a></li>
                        <li><a href="{{ route('admin.addMenu') }}" data-key="t-product-detail">Create Menu</a></li>
                        <li><a href="{{ route('admin.menuSorting') }}" data-key="t-orders">Menu Sorting</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_section', $userRole->userRole->role) === true)
                <li>
                    <a href="{{ route('admin.sectionList') }}" class="has-arrow">
                        <i data-feather="package"></i>
                        <span data-key="t-package">Manage Section</span>
                    </a>
                </li>
                @endif
                @if(inArrayCheck('manage_section_style', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="pen-tool"></i>
                        <span data-key="t-pen-tool">Manage Section Style</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.sectionstyleList') }}" key="t-products">Section Style List</a></li>
                        <li><a href="{{ route('admin.addSectionStyle') }}" data-key="t-product-detail">Create Section Style</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_pages', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="book"></i>
                        <span data-key="t-users">Manage Pages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.pageList') }}" key="t-products">Pages List</a></li>
                        <li><a href="{{ route('admin.addPage') }}" data-key="t-product-detail">Create Pages</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_user', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-book">Manage Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.departmentList') }}" key="t-products">Manage Department</a></li>
                        <li><a href="{{ route('admin.roleList') }}" key="t-products">Manage User Role</a></li>
                        <li><a href="{{ route('admin.userList') }}" key="t-products">Users List</a></li>
                        <li><a href="{{ route('admin.addUser') }}" data-key="t-product-detail">Create User</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_logs', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="minus-square"></i>
                        <span data-key="t-minus-square">Logs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.logsList') }}" key="t-products">Error Log</a></li>
                    <li><a href="{{ route('admin.invalidLoginAttempt') }}" key="t-products">Invalid Login Attempts</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_news', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage News</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.blogCatrgoryList') }}" key="t-products">Manage News Category</a></li>
                        <li><a href="{{ route('admin.blogList') }}" key="t-products"> News List</a></li>
                        <li><a href="{{ route('admin.blogAdd') }}" data-key="t-product-detail">Create News</a></li>
                        <li><a href="{{ route('admin.blogSetting') }}" data-key="t-product-detail">News Setting</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_help', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Help</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.helpCategory') }}" key="t-products">Manage Help Category</a></li>
                        <li><a href="{{ route('admin.helpFaqList') }}" key="t-products"> Help Question List</a></li>
                        <li><a href="{{ route('admin.helpFaqAdd') }}" data-key="t-product-detail">Create Help Question</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_privacy', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Privacy Policy</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.privacyPolicyCategory') }}" key="t-products">Manage Privacy Category</a></li>
                        <li><a href="{{ route('admin.privacyPolicyList') }}" key="t-products"> Privacy Policy List</a></li>
                        <li><a href="{{ route('admin.privacyPolicyAdd') }}" data-key="t-product-detail">Create Privacy Policy</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_team', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Team</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.teamList') }}" key="t-products"> Team List</a></li>
                        <li><a href="{{ route('admin.addTeam') }}" data-key="t-product-detail">Create Team</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_enquery', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Enquiry</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.enqueryList') }}" key="t-products"> Contact</a></li>
                        <li><a href="{{ route('admin.subscriberList') }}" data-key="t-product-detail">Subscriber</a></li>
                        <li><a href="{{ route('admin.maintinanceEnqueryList') }}" data-key="t-product-detail">Maintenance Enquiry</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_career', $userRole->userRole->role) === true)
                <li class="mm-active">
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Carrer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.getapplicant') }}" key="t-products">All Applicant</a></li>
                    <li><a href="{{ route('admin.companylist') }}" key="t-products">Company List</a></li>
                    <li><a href="{{ route('admin.joblist') }}" data-key="t-product-detail">Manage Job</a></li>                       
                    <li><a href="{{ route('applicants') }}" data-key="t-product-detail">Applied Job</a></li>                       
                    <li><a href="{{ route('admin.addsetting') }}" data-key="t-product-detail">Manage Carrer setting</a></li>
                    <li><a href="{{ route('admin.carrerlist') }}" data-key="t-product-detail">Carrer setting list</a></li>
                    <li>
                        <a href="{{ route('admin.availabilities') }}" data-key="t-product-detail">
                            Interview Availabilities
                        </a>
                    </li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_enquery', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage FAQ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.faq.index') }}" key="t-products"> Faq list</a></li>
                        <li><a href="{{ route('admin.FaqAdd') }}" data-key="t-product-detail">Create Faq</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_location', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Manage Location</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('locations.index')}}" key="t-products">Locations</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('manage_terms', $userRole->userRole->role) === true)
                <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Terms & Condition</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.terms.index')}}" key="t-products">Terms/Condition</a></li>
                    </ul>
                </li>
                @endif
                @if(inArrayCheck('setting', $userRole->userRole->role) === true)
                <li class="mm-active">
                    <a href="#" class="has-arrow">
                        <i data-feather="settings"></i>
                        <span data-key="t-settings">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.siteSetting') }}" key="t-products">Site Setting</a></li>
                        <li><a href="{{ route('admin.footerSetting') }}" key="t-products">Footer Setting</a></li>
                        <li><a href="{{ route('admin.thirdPartySetting') }}" data-key="t-product-detail">Third Party Api Key</a></li>
                    </ul>
                </li>
                @endif

<!-- <li>

    <a href="javascript: void(0);" class="has-arrow">

        <i data-feather="share-2"></i>

        <span data-key="t-multi-level">Multi Level</span>

    </a>

    <ul class="sub-menu" aria-expanded="true">

        <li><a href="javascript: void(0);" data-key="t-level-1-1">Level 1.1</a></li>

        <li>

            <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Level 1.2</a>

            <ul class="sub-menu" aria-expanded="true">

                <li><a href="javascript: void(0);" data-key="t-level-2-1">Level 2.1</a></li>

                <li><a href="javascript: void(0);" data-key="t-level-2-2">Level 2.2</a></li>

            </ul>

        </li>

    </ul>

</li> -->
            </ul>
            <div class="card sidebar-alert shadow-none text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="{{asset('admin/images/favicon.png')}}" alt="BABVIPLOGO">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">BABVIP GROUP CMS</h5>
                        <p class="font-size-13 text-dark">Easy to use and customize your website</p>
                        <a href="{{ url('admin/logout') }}" class="btn btn-danger mt-2"> <i data-feather="log-out"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<!-- Left Sidebar End -->