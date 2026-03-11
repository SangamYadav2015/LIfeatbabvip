@php
$decodeData=decodeData($page_data);
$helpFaqData= gethelpCategory();
$bgimg =asset("storage/uploads/".$decodeData["banner_bg_image"]);
@endphp
<style>
    .support-article-title {
        font-family: "Open Sans", sans-serif;
        -webkit-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out;
    }
</style>
<style>
    .support-article-tab button.nav-link {
        --bs-text-opacity: 1;
        font-size: 12px;
        font-weight: 600;
    }

    .customh-5 {
        font-size: 1rem;
    }

    p {
        font-size: 15px !important;
        font-weight: normal;
    }

    .support-article-wrap ul li {

        font-size: 14px;
        list-style: circle;

    }
</style>
<style>
    #autocomplete-results {
        max-height: 150px;
        overflow-y: auto;
        list-style: none;
        padding: 0;
        margin: 0;
        background: #ffffff;
        border-radius: 5px;

        background: #ffffff;
    }

    #autocomplete-results li {
        padding: 8px;
        cursor: pointer;
    }

    #autocomplete-results li:hover {
        background-color: #f0f0f0;
    }

    #autocomplete-results li {
        color: #978888;
        text-align: left;
        border-bottom: 1px solid #b1a8a8;
    }
</style>
<section class="page-header position-relative overflow-hidden ptb-120 bg-dark" style="background: url('{{ $bgimg }}')no-repeat bottom left">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="text-center">
                    <h1 class="display-5 fw-bold"> {{ $decodeData['banner_title'] }}</h1>
                    <p class="lead"> {{ $decodeData['banner_description'] }} </p>
                    <div class="form-block-banner mw-60 m-auto mt-5">
                        <form name="search" class="search-form" id="helpsearch">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="email" class="form-control me-2" name="search" data-name="search" placeholder="Search for a topic or question" id="searchFormhelp" required="" autocomplete="off">
                                    <ul id="autocomplete-results"></ul>
                                </div>
                                <input type="hidden" id="searchFormslug" value="">
                                <div class="col-md-2">
                                    <input type="button" value="Search" data-wait="Please wait..." class="btn btn-primary" id="btn-search-form">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light right-5"></div>
    </div>
</section>

<section class="support-content ptb-120">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-md-4 d-none d-md-block d-lg-block">
                <div class="support-article-sidebar sticky-sidebar">
                    <div class="nav flex-column nav-pills support-article-tab bg-light-subtle rounded-custom p-5" id="v-pills-support" role="tablist" aria-orientation="vertical">
                        <h2 class="customh-5">All Support Categories</h2>

                        @php
                        $i=1;
                        @endphp
                        @foreach ($helpFaqData as $itemCat)
                        @php
                        $cntcatfq= json_decode($itemCat->helpFaq);
                        @endphp
                        <button class="nav-link {{ $i === 1 ? 'active' : '' }}" data-bs-target="#support-tab-{{  $itemCat->id }}" data-bs-toggle="pill" type="button" role="tab" aria-selected="{{ $i === 1 ? 'true' : 'false' }}">{{ $itemCat->category_name }} -({{ count( $cntcatfq) }})</button>
                        @php
                        $i++;
                        @endphp
                        @endforeach

                    </div>

                    @if(isset($decodeData['step_data']) && $decodeData['step_data'] !== null)
                    <div class="bg-light-subtle p-5 mt-4 rounded-custom quick-support">

                        @foreach ($decodeData['step_data'] as $step)
                        <a href="{{ $step["text_url"] }}" class="text-decoration-none text-muted d-flex align-items-center py-2">
                            <div class="quick-support-icon">
                                @if($step['step_image'] !== null)
                                <img src="{{ asset("storage/uploads/".$step["step_image"]) }}" alt="{{ $step["step_image_alt_tag"] }}">
                                @endif
                            </div>
                            <div class="contact-option-text">{{ $step["step_text"] }}</div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 col-md-8">
                <div class="tab-content" id="v-pills-supportContent">
                    <!-- <h2>{{ $decodeData['title'] }}</h2> -->
                    @php
                    $i=1;
                    @endphp
                    @foreach ($helpFaqData as $itemCat)
                    <div class="tab-pane fade {{ $i === 1 ? 'show active' : '' }} " id="support-tab-{{  $itemCat->id }}" role="tabpanel">
                        <div class="support-article-wrap">
                            <h2>{{ $itemCat->category_name }}</h2>
                            <ul class="support-article-list list-unstyled mt-4">
                                @foreach($itemCat->helpFaq as $help)
                                <li class="py-4 border-top border-light">
                                    <a href="{{ url('help/'.$help->slug)}}" class="text-decoration-none d-block text-muted">
                                        <h3 class="h5 support-article-title">{{ $help->question }}</h3>
                                        <p>{!! getFirst20Words($help->answer) !!}</p>
                                        <span class="btn-link text-decoration-none read-more-link">Read More
                                            <i class="fas fa-arrow-right ms-2"></i></span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>