@php
$decodeData=[];
@endphp
<!--header dark start-->
@if(!empty($siteSetting))
@php
$decodeData =decodeData($siteSetting->setting_data);
@endphp
@endif
<header class="main-header w-100">
    <nav class="navbar navbar-expand-xl navbar-light sticky-header affix">
        <div class="container d-flex align-items-center justify-content-lg-between position-relative">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-md-0 text-decoration-none">
                @if(!empty($decodeData) )
                <img src="{{ asset("storage/uploads/".$decodeData["site_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid logo-white">
                <img src="{{ asset("storage/uploads/".$decodeData["site_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid logo-color">

                @endif
            </a>

            <a class="navbar-toggler position-absolute right-0 border-0 " href="#offcanvasWithBackdrop" role="button">
                <span class="far fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"></span>
            </a>

            <div class="collapse navbar-collapse justify-content-center">
            <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                    @php
                    $menuList = App\Models\Menu::with('childrenRecursive','pages')
                    ->whereNull('parent_id')
                    ->where('show_header', '1')
                    ->where('status', 'active')
                    ->orderBy('sort_id', 'ASC')
                    ->get();
                    @endphp

                    @foreach($menuList as $menu)
                    <li class="{{ $menu->childrenRecursive->isNotEmpty() ? 'nav-item dropdown' : '' }}">

                        @if($menu->menu_slug === null)
                        @php
                        $menuSlug = $menu->pages ? url(getPageSlug($menu->pages->page_data)) : 'javascript:void(0)';

                        @endphp
                        @else
                        @php
                        $menuSlug = url($menu->menu_slug);
                        @endphp
                        @endif
                        <a class="nav-link {{ $menu->childrenRecursive->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                            href="{{ $menuSlug }}"
                            {{ $menu->childrenRecursive->isNotEmpty() ? 'role=button data-bs-toggle=dropdown aria-expanded=false' : '' }}>
                            {{ $menu->title }}
                        </a>

                        @if($menu->childrenRecursive->isNotEmpty())
                        <div class="dropdown-menu border-0 rounded-custom shadow py-0 bg-white" style="display: none;">
                            <div class="dropdown-grid rounded-custom width-full-3 width-full-new w-100">
                                @foreach($menu->childrenRecursive as $child)
                                @if($child->status === 'active')
                                <div class="dropdown-grid-item bg-white rounded-custom">
                                    <!-- Conditional Heading -->

                                    @if($child->menu_slug === null)
                                    @php
                                    $menuChildrenSlug = $child->pages ? url(getPageSlug($child->pages->page_data)) : 'javascript:void(0)';

                                    @endphp
                                    @else
                                    @php
                                    $menuSlug = url($child->menu_slug);
                                    @endphp
                                    @endif
                                    <h6 class="drop-heading">
                                        <a href="{{ $menuChildrenSlug }}">{{ $child->title }}</a>
                                    </h6>

                                    @if($child->childrenRecursive->isNotEmpty())
                                    @foreach($child->childrenRecursive as $grandchild)
                                    @if($grandchild->status === 'active')

                                    @if($grandchild->menu_slug === null)
                                    @php
                                    $menuSlugGrandchild = $grandchild->pages ? url(getPageSlug($grandchild->pages->page_data)) : 'javascript:void(0)';

                                    @endphp
                                    @else
                                    @php
                                    $menuSlugGrandchild = url($grandchild->menu_slug);
                                    @endphp
                                    @endif
                                    <a href="{{$menuSlugGrandchild }}" class="dropdown-link">
                                        <span class="me-2">
                                            <i class="flaticon-menu"></i> <!-- Customize this icon as needed -->
                                        </span>
                                        <div class="drop-title">{{ $grandchild->title }}</div>
                                    </a>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="action-btns text-end me-5 me-lg-0 d-none d-md-block d-lg-block">
    <!-- If logged in, show dashboard button -->
    @auth('applicant')
    <!-- Profile Dropdown -->
    <div class="dropdown">
        <a class="dropdown-toggle"  id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> {{AUTH::guard('applicant')->user()->name }} <!-- Or use an image or initial for the profile -->
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            <!-- Applicant Profile Link -->
            <li><a class="dropdown-item" href="{{ route('applicant.profile', ['applicantId' => auth()->guard('applicant')->user()->id]) }}">My Profile</a></li>
            <!-- Dashboard Link -->
            <li><a class="dropdown-item" href="{{ route('applicant.dashboard') }}">Dashboard</a></li>
            <!-- Logout Link -->
            <li>
                <form action="{{ route('applicant.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    @endauth

    <!-- If not logged in, show sign in and get started buttons -->
    @guest('applicant')
    <a href="{{ route('see.alljobs') }}" class="btn btn-success me-2">See All Jobs</a>
        <a href="{{ route('applicant.login') }}" class="btn btn-signin me-2">Sign In</a>
        <a href="{{ route('applicant.register') }}" class="btn btn-signup">Sign Up</a>
    @endguest
</div>

        </div>
    </nav>
    <!--offcanvas menu start-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop">
        <div class="offcanvas-header d-flex align-items-center mt-4">
            <a href="{{url('/')}}" class="d-flex align-items-center mb-md-0 text-decoration-none">
                @if(!empty($decodeData) )
                <img src="{{ asset("storage/uploads/".$decodeData["site_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid ps-2" width="300px">
                @endif
            </a>
            <button type="button" class="close-btn text-danger" data-bs-dismiss="offcanvas" aria-label="Close"><i class="far fa-close"></i></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav col-12 col-md-auto justify-content-center main-menu">

                @foreach($menuList as $menu)
                <li class="nav-item dropdown">
                        @php
                            $menuSlug = $menu->pages ? url(getPageSlug($menu->pages->page_data)) : 'javascript:void(0)';
                        @endphp
                    <a class="nav-link dropdown-toggle" href="{{ $menuSlug }}" {{ $menu->childrenRecursive->isNotEmpty() ? 'role="button" data-bs-toggle="dropdown" aria-expanded="false"' : '' }}>
                        {{ $menu->title }}
                    </a>
                    @if($menu->childrenRecursive->isNotEmpty())
                    {!! renderMenu($menu->childrenRecursive) !!}
                    @endif
                </li>
                @endforeach
            </ul>
            <!-- <div class="action-btns mt-4 ps-3">
               <a href="#" class="btn btn-outline-primary me-2">Sign In</a>
                <a href="#" class="btn btn-primary">Get Started</a>
            </div> -->
        </div>

    </div>
    <!--offcanvas menu end-->
</header>
<!--header dark end-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Styling the action buttons container */
.action-btns {
    position: relative;
}

/* Profile Dropdown Button */
.btn-profile {
    background-color: #007bff; /* Primary color */
    color: #fff;
    padding: 10px 15px;
    border-radius: 50%;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
}

.btn-profile:hover {
    background-color: #0056b3;
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3);
}

/* Dropdown Menu */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    transition: background-color 0.3s ease, color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
    color: #007bff;
}

/* Sign In and Sign Up Buttons */
.btn-signin, .btn-signup {
    font-size: 1rem;
    padding: 10px 20px;
    border-radius: 30px;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.btn-signin {
    border: 2px solid #007bff;
    color: #007bff;
    background-color: transparent;
}

.btn-signin:hover {
    background-color: #007bff;
    color: #fff;
    border-color: #0056b3;
}

.btn-signup {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.btn-signup:hover {
    background-color: #0056b3;
}

/* Responsive Fixes */
@media (max-width: 991px) {
    .action-btns {
        text-align: center;
    }

    .btn-signin, .btn-signup {
        margin-top: 10px;
    }
}

</style>