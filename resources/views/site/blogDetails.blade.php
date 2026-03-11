@extends('site.layout.app')

@section('content')
@php
$decodeData=[];
@endphp
@if(!empty($siteSetting))
@php
$decodeData =decodeData($siteSetting->setting_data);
@endphp
@endif

@if(!empty($newsSetting))
@php
$newssettingdecodeData =decodeData($newsSetting->setting_data);
@endphp
@endif
<style>
    .blog-details-wrap ul{
        padding-left: 0;
        list-style: none;
    }
    .job-details-info  ul{
        padding-left: 0;
        list-style: none;
    }

    .blog-details-wrap ul li{
        position: relative;
    font-size: 15px;
    padding-left: 15px;
    margin-bottom: 15px;
    }
    .job-details-info  ul li{
        position: relative;
    font-size: 15px;
    padding-left: 15px;
    margin-bottom: 15px;
    }

    .job-details-info  ul li:before {
    position: absolute;
    left: 0;
    top: 11px;
    height: 6px;
    width: 6px;
    background: #111827;
    content: "";
    border-radius: 50%;
}
.blog-details-wrap ul li:before {
    position: absolute;
    left: 0;
    top: 11px;
    height: 6px;
    width: 6px;
    background: #111827;
    content: "";
    border-radius: 50%;
}
    
</style>
<section class="page-header position-relative overflow-hidden ptb-120 bg-dark" style="background: url('{{ asset('site/assets/img/page-header-bg.svg') }}')no-repeat bottom left">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <h1 class="fw-bold display-5">{{ $blog->blog_title }}</h1>
            </div>
        </div>
        <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light right-5"></div>
    </div>
</section>

<section class="blog-details ptb-120">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-8 pe-lg-5">
                <div class="blog-details-wrap">
                    {!! $blog->blog_details1 !!}
                    <blockquote class="bg-white custom-shadow p-5 mt-5 rounded-custom border-4 border-primary border-top">
                        <p class="text-muted"><i class="fas fa-quote-left me-2 text-primary"></i>{!! $blog->blog_short_details1 !!}
                            <i class="fas fa-quote-right ms-2 text-primary"></i>
                        </p>
                    </blockquote>
                </div>
                <img src="{{ asset('storage/uploads/' .$blog->blog_image2) }}" class="img-fluid mt-4 rounded-custom" alt="{{ $blog->image2_alt }}">
                <div class="job-details-info mt-5">
                    {!! $blog->blog_details2 !!}
                </div>

                <img src="{{ asset('storage/uploads/' .$blog->blog_image3) }}" class="img-fluid mt-4 rounded-custom" alt="{{ $blog->image3_alt }}">
            </div>
            <div class="col-lg-4">
                <div class="author-wrap text-center bg-light-subtle p-5 sticky-sidebar rounded-custom mt-5 mt-lg-0">
                    @if(!empty($newsSetting) && isset($newssettingdecodeData["news_logo"]))
                    <img src="{{ asset("storage/uploads/".$newssettingdecodeData["news_logo"]) }}" alt="{{ $decodeData["site_logo_alt"] }}" width="120" class="img-fluid shadow-sm rounded-circle">
                    @endif
                    <div class="author-info my-4">
                        <h5 class="mb-0">{{ $newssettingdecodeData["name"] ? $newssettingdecodeData["name"] : ''}}</h5>
                        <span class="small">{{ $newssettingdecodeData["designation"] ? $newssettingdecodeData["designation"] : ''}}</span>
                    </div>
                    <p>{{ $newssettingdecodeData["description"] ? $newssettingdecodeData["description"] : ''}}</p>
                    <ul class="list-unstyled author-social-list list-inline mt-3 mb-0">
                        <ul class="list-unstyled list-inline footer-social-list mb-0">
                            @if(!empty($siteSetting) && $decodeData['facebook_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeData['facebook_page_url'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            @endif

                            @if(!empty($siteSetting) && $decodeData['instagram_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeData['instagram_page_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif

                            @if(!empty($siteSetting) && $decodeData['linkdin_page_url'] !== null)
                            <li class="list-inline-item"><a href="{{ $decodeData['linkdin_page_url'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($newsSetting) && isset($newssettingdecodeData["section1_title"]) && $newssettingdecodeData["section1_title"] !== null)

    <!--newsletter subscription container start-->
    <div class="container">
        <div class="bg-dark ptb-60 px-5 mt-100 position-relative overflow-hidden rounded-custom" style="background: url('{{ asset('storage/uploads/' .$newssettingdecodeData["section1_bg"]) }}')no-repeat center bottom">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="subscribe-info-wrap text-center position-relative z-2">
                        <div class="section-heading">
                            <h4 class="h5 text-warning">{{ $newssettingdecodeData["section1_subtitle"] ? $newssettingdecodeData["section1_subtitle"] : '' }}</h4>
                            <h2>{{ $newssettingdecodeData["section1_title"] ? $newssettingdecodeData["section1_title"] : ''}}</h2>
                            <p>{{ $newssettingdecodeData["section1_description"] ? $newssettingdecodeData["section1_description"] : '' }}</p>
                        </div>
                        <div class="form-block-banner mw-60 m-auto mt-5">
                            <form id="email-form2" name="email-form" class="subscribe-form d-flex subscribenewsletter" method="post">
                            @csrf
                                <input type="email" class="form-control me-2" name="email" data-name="Email" placeholder="Enter your email" id="Email2" required="">
                                <input type="submit" value="Join!" data-wait="Please wait..." class="btn btn-primary submitbtnsubs">
                            </form>
                        </div>
                        <ul class="nav justify-content-center subscribe-feature-list mt-3">
                            <li class="nav-item">
                                <span><i class="far fa-dot-circle text-primary me-2"></i>{{ $newssettingdecodeData["section1_tagline"] ? $newssettingdecodeData["section1_tagline"] : '' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-dark-light left-5"></div>
        </div>
    </div>
    @endif
    <!--newsletter subscription container end-->
</section>

<section class="related-blog-list ptb-120 bg-light-subtle">
    <div class="container">
        @if(!empty($newsSetting) && isset($newssettingdecodeData["section2_title"]) && $newssettingdecodeData["section2_title"] !== null)
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-4 col-md-12">
                <div class="section-heading">
                    <h4 class="h5 text-primary">{{ $newssettingdecodeData["section2_subtitle"] ? $newssettingdecodeData["section2_subtitle"] : '' }}</h4>
                    <h2>{{ $newssettingdecodeData["section2_title"] ? $newssettingdecodeData["section2_title"] : '' }}</h2>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="text-start text-lg-end mb-4 mb-lg-0 mb-xl-0">
                    @if($newssettingdecodeData["section2_button_text"] !== null)
                    <a href="{{ $newssettingdecodeData["section2_button_url"] }}" class="btn btn-primary">{{ $newssettingdecodeData["section2_button_text"] ? $newssettingdecodeData["section2_button_text"] : '' }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            @foreach ($bloglatest as $item)

            <div class="col-lg-4 col-md-6">
                <div class="single-article rounded-custom my-3">
                    <a href="{{ url('blog/'. $item->blog_slug) }}" class="article-img">
                        <img src="{{ asset('storage/uploads/' .$item->blog_image1) }}" alt="{{ $item->image1_alt }}" class="img-fluid">
                    </a>
                    <div class="article-content p-4">
                        <div class="article-category mb-4 d-block">
                            <a href="javascript:;" class="d-inline-block text-warning badge bg-warning-soft">{{ $item->category->category_name }}</a>
                        </div>
                        <a href="{{ url('blog/'. $item->blog_slug) }}">
                            <h2 class="h5 article-title limit-2-line-text">{{ $item->blog_title }}</h2>
                        </a>
                        <p class="limit-2-line-text">{{ $item->blog_short_details1 }}.</p>


                        <a href="javascript:;">
                            <div class="d-flex align-items-center pt-4">
                                @if($item->user->profile_image !== '')
                                <div class="avatar">
                                    <img src="{{ asset('storage/uploads/'.$item->user->profile_image) }}" alt="avatar" width="40" class="img-fluid rounded-circle me-3" style="height:40px;">
                                </div>
                                @endif
                                <div class="avatar-info">
                                    <h6 class="mb-0 avatar-name">{{ $item->user->name }}</h6>
                                    <span class="small fw-medium text-muted">{{ date("M d Y", strtotime($item->created_at)) }}</span>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@if(!empty($newsSetting) && isset($newssettingdecodeData["section3_title"]) && $newssettingdecodeData["section3_title"] !== null)

<section class="cta-subscribe bg-dark ptb-120 position-relative overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="subscribe-info-wrap text-center position-relative z-2">
                    <div class="section-heading">
                        <h4 class="h5 text-warning">{{ $newssettingdecodeData["section3_subtitle"] ? $newssettingdecodeData["section3_subtitle"] : '' }}</h4>
                        <h2>{{ $newssettingdecodeData["section3_title"] ? $newssettingdecodeData["section3_title"] : '' }}</h2>
                        <p>{{ $newssettingdecodeData["section3_description"] ? $newssettingdecodeData["section3_description"] : '' }}</p>
                    </div>
                    <div class="form-block-banner mw-60 m-auto mt-5">
                        @if($newssettingdecodeData["section3_button_text"] !== null)
                        <a href="{{ $newssettingdecodeData["section3_button_url"] }}" class="btn btn-primary">{{ $newssettingdecodeData["section3_button_text"] ? $newssettingdecodeData["section3_button_text"] : '' }}</a>
                        @endif

                        @if($newssettingdecodeData["section3_video_button_text"] !== null)
                        <a href="{{ $newssettingdecodeData["section3_video_button_url"] }}" class="text-decoration-none popup-youtube d-inline-flex align-items-center watch-now-btn ms-lg-3 ms-md-3 mt-3 mt-lg-0"> <i class="fas fa-play"></i> {{ $newssettingdecodeData["section3_video_button_text"] ? $newssettingdecodeData["section3_video_button_text"] : '' }} </a>
                      @endif

                    </div>
                    <ul class="nav justify-content-center subscribe-feature-list mt-4">
                        <li class="nav-item">
                            <span><i class="far fa-check-circle text-primary me-2"></i>{{ $newssettingdecodeData["section3_tagline"] ? $newssettingdecodeData["section3_tagline"] : '' }}</span>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
        <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
    </div>
</section>
@endif


@endsection