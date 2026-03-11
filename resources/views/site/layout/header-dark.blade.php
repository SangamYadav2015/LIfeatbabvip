<!--header dark start-->
@php
$decodeData=[];
@endphp
@if(!empty($siteSetting))
@php
$decodeData =decodeData($siteSetting->setting_data);
@endphp
@endif

<header class="main-header w-100">
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark sticky-header affix">
        <div class="container d-flex align-items-center justify-content-lg-between position-relative">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-md-0 text-decoration-none">
                @if(!empty($decodeData) )
                <img src="{{ asset("storage/uploads/".$decodeData["site_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid logo-white" width="130px">
                <img src="{{ asset("storage/uploads/".$decodeData["site_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid logo-color" width="130px">

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
            <!-- <div class="action-btns text-end me-5 me-lg-0 d-none d-md-block d-lg-block">
                <a href="#" class="btn btn-link text-decoration-none me-2">Sign In</a>
                <a href="#" class="btn btn-primary">Get Started</a>
            </div> -->
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