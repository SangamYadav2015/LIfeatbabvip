@php
$decodeDataSite=[];
$decodeDataFooter=[];
@endphp
<!--header dark start-->
@if(!empty($footerSetting))
@php
$decodeDataFooter =decodeData($footerSetting->setting_data);
@endphp
@endif

@if(!empty($siteSetting))
@php
$decodeDataSite =decodeData($siteSetting->setting_data);
@endphp
@endif
<!--footer section start-->
<footer class="footer-section">
    <!--footer top start-->
    <!--for light footer add .footer-light class and for dark footer add .bg-dark .text-white class-->
    <div class="footer-top footer-light ptb-120" style="">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-8 col-lg-4 mb-md-4 mb-lg-0">
                    <div class="footer-single-col">
                        <div class="footer-single-col mb-4">
                            @if(!empty($decodeDataFooter) && $decodeDataFooter["footer_logo"] !== null )
                            <img src="{{ asset("storage/uploads/".$decodeDataFooter["footer_logo"]) }}" alt="Footer Logo" class="img-fluid logo-white">
                            <img src="{{ asset("storage/uploads/".$decodeDataFooter["footer_logo"]) }}" alt="Footer Logo" class="img-fluid logo-color">

                            @endif
                        </div>
                        <p>{!! !empty($footerSetting) ? $decodeDataFooter['footer_description'] : '' !!}</p>

                        <form class="newsletter-form position-relative d-block d-lg-flex d-md-flex subscribenewsletter" method="post">
                            @csrf
                            <input type="text" class="input-newsletter form-control me-2" placeholder="Enter your email" name="email" required="" autocomplete="off">
                            <input type="submit" value="Subscribe" data-wait="Please wait..." class="btn btn-primary mt-3 mt-lg-0 mt-md-0 submitbtnsubs">
                        </form>
                        <div class="ratting-wrap mt-4">
                            <h6 class="mb-0">{!! !empty($footerSetting) ? $decodeDataFooter['rating_title'] : '' !!}</h6>
                            <ul class="list-unstyled rating-list list-inline mb-0">
                                @if(!empty($footerSetting))
                                @for($i=1; $i <= $decodeDataFooter['rating']; $i++) <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    @endfor
                                    @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 mt-4 mt-md-0 mt-lg-0">
                    @php
                    // Fetch all parent menus with their children
                    $menuList = App\Models\Menu::with('childrenRecursive', 'pages')
                    ->whereNull('parent_id')
                    ->where('show_footer', '1')
                    ->where('status', 1)
                    ->orderBy('sort_id', 'ASC')
                    ->get();
                    @endphp

                    <div class="row mt-4">
                        @foreach($menuList as $menu)
                        <div class="col-md-4 col-lg-4 mt-4 mt-md-0 mt-lg-0"> <!-- 4 columns: col-md-3 (12/4 = 3) -->
                            <div class="footer-single-col">
                            <h3>{{ $menu->title }}</h3>
                                <ul class="list-unstyled footer-nav-list mb-lg-0">
                                    @foreach($menu->childrenRecursive as $child)
                                    @if($child->menu_slug === null)
                                    @php
                                    $menuSlugChild = $child->pages ? getPageSlug($child->pages->page_data) : '#';
                                    @endphp
                                    @else
                                    @php
                                    $menuSlugChild = $child->menu_slug;
                                    @endphp
                                    @endif
                                    <li class="">
                                        <a href="{{ url($menuSlugChild) }}">{{ $child->title }} </a>
                                        @if($child->childrenRecursive->isNotEmpty())
                                        <ul class="">
                                            @foreach($child->childrenRecursive as $grandchild)

                                            @if($grandchild->menu_slug === null)
                                            @php
                                            $menuSlugGrandchild = $grandchild->pages ? getPageSlug($grandchild->pages->page_data) : '#';
                                            @endphp
                                            @else
                                            @php
                                            $menuSlugGrandchild = $grandchild->menu_slug;
                                            @endphp
                                            @endif
                                            <li><a href="{{ url($menuSlugGrandchild) }}">{{ $grandchild->title }}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--footer top end-->

    <!--footer bottom start-->
    <div class="footer-bottom footer-light py-4">
        <div class=" container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-7 col-lg-7">
                    <div class="copyright-text">
                        <p class="mb-lg-0 mb-md-0">{{ !empty($footerSetting) && ($decodeDataFooter['footer_tag_line'] !== null) ? $decodeDataFooter['footer_tag_line'] : ''}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="footer-single-col text-start text-lg-end text-md-end">
                        <ul class="list-unstyled list-inline footer-social-list mb-0">
                            @if(!empty($siteSetting) && $decodeDataSite['facebook_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeDataSite['facebook_page_url'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            @endif

                            @if(!empty($siteSetting) && $decodeDataSite['instagram_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeDataSite['instagram_page_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif

                            @if(!empty($siteSetting) && $decodeDataSite['linkdin_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeDataSite['linkdin_page_url'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer bottom end-->
</footer>
<!--footer section end--> <!--footer section end-->