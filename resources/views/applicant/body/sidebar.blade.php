<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>
                <li>
                    <a href="{{url('applicant/dashboard')}}">
                        <i data-feather="home"></i>
                      <!--  <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span>-->
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-apps">Apps</li>

            <!--    <li>
                    <a href="#" class="has-arrow">
                        <i data-feather="menu"></i>
                        <span data-key="t-menu">Manage Job</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-products">Job List</a></li>
                        <li><a href="#" data-key="t-product-detail">Create Menu</a></li>
                        <li><a href="#" data-key="t-orders">Menu Sorting</a></li>
                    </ul>
                </li>--->
                





                <!-- 
            <li>
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
                        <h5 class="alertcard-title font-size-16">BABVIP GROUP CARRIER</h5>
                        <p class="font-size-13 text-dark">Join us for Better Carrier we valued your Skill</p>
                        <form action="{{ route('applicant.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->