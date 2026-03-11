@php
$decodeData=[];
$decodeDataFooter=[];
@endphp
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
@if(!empty($siteSetting))
@php
$decodeData =decodeData($siteSetting->setting_data);
@endphp
@endif
@if(!empty($footerSetting))
@php
$decodeDataFooter =decodeData($footerSetting->setting_data);
@endphp
@endif
<head>
    <!--required meta tags-->
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getPageDataDecode($pageData->page_data, 'meta_title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(getPageDataDecode($pageData->page_data, 'og_graph_image') !== null)
    <meta property="og:image" content="{{ asset('storage/uploads/'.getPageDataDecode($pageData->page_data, 'og_graph_image')) }}" />
    <meta property="og:image:type" content="{{ getImageType(getPageDataDecode($pageData->page_data, 'og_graph_image'))}}">
    @endif
    {!! getPageDataDecode($pageData->page_data, 'page_head_script') !!}
    <!--meta-->
    <meta name="description" content="{{ getPageDataDecode($pageData->page_data, 'meta_description') }}">
    <meta name="author" content="Babvip Creations">
    <meta name="publisher" content="Babvip Creations">

    <!--favicon icon-->
    @if(!empty($siteSetting) && $decodeData["site_favicon"] != '')
    <link rel="icon" href="{{ asset("storage/uploads/".$decodeData["site_favicon"]) }}" type="image/png" sizes="16x16">
    @endif


    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('site/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/custom.css')}}">
    <script src="{{ asset('site/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>

    <style>
        body,
        .multilevel-dropdown-menu {
            font-family: Arial, sans-serif;
        }

        .parent {
            display: block;
            position: relative;
            float: left;
            line-height: 40px;
        }

        .parent a {
            margin: 10px 24px;
            color: #737373;
            text-decoration: none;
            font-weight: bold;
        }

        .parent:hover>ul {
            display: block;
            position: absolute;
        }

        .child {
            display: none;
            z-index: 1000000000000;
        }

        .child li {
            background-color: #ffffff;
            line-height: 40px;
            border-bottom: #1f1c5a 1px solid;
            border-right: #b5b5b5 1px solid;
            width: 100%;
        }

        .child li a {
            color: #000000;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0px;
            min-width: 12em;
        }

        ul ul ul {
            left: 100%;
            top: 0;
            margin-left: 1px;
        }

        .expand {
            font-size: 12px;
            float: right;
            margin-right: 5px;
        }
.width-full-3 .dropdown-grid-item {
    width: 285px;
    padding: 10px;
}
.width-full-new{
            grid-template-columns: 1fr 1fr 1fr !important;
        }
.dropdown-grid-item .drop-heading {
    padding-left: 1rem;
    font-size: 0.8rem;
}
.dropdown-grid-item .drop-title {
    font-size: .7rem;
}
.img-fluid {
    max-width: 100%;
    height: fit-content;
}
.feature-icon {
    width: 90px;
    height: 90px;
    line-height: 65px;
    text-align: center;
    margin: auto;
}
.ptb-120{
    padding: 80px 0px !important;
}
.affix{
    padding:0px;
}
/* //gaurav */
/* //gaurav */
/* //gaurav */
</style>
    {!! !empty($siteSetting) ? html_entity_decode($decodeData['header_script'], ENT_QUOTES, 'UTF-8') : '' !!}
</head>

<body>
{!! getPageDataDecode($pageData->page_data, 'page_body_script') !!}

    <div id="preloader" class="bg-white">
        <div class="preloader-wrap">
            <img src="{{ asset("site/assets/img/loader-white.gif") }}" alt="{{ $decodeData["site_logo_alt"] }}" class="img-fluid preloader-icon" style="width:25%;">
            <!-- <div class="loading-bar">progress</div> -->
        </div>
    </div>
    <div class="main-wrapper">
        @if(!empty($siteSetting) && $decodeData['navigation_type'] === 'dark')
        @include('site.layout.header-dark')
        @elseif(!empty($siteSetting) && $decodeData['navigation_type'] === 'light')
        @include('site.layout.header-light')
        @else
        @include('site.layout.header-dark')
        @endif

        @yield('content')


        @if(!empty($footerSetting) && $decodeDataFooter['footer_type'] === 'dark')
        @include('site.layout.footer-dark')
        @elseif(!empty($footerSetting) && $decodeDataFooter['footer_type'] === 'light')
        @include('site.layout.footer-light')
        @else
        @include('site.layout.footer-dark')
        @endif
    </div>
    <!--build:js-->
    <script src="{{ asset('site/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendors/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendors/parallax.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendors/aos.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendors/massonry.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/app.js') }}"></script>
    {!! !empty($siteSetting) ? html_entity_decode($decodeData['footer_script'], ENT_QUOTES, 'UTF-8') : '' !!}
    <!--endbuild-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.contactForm').on('submit', function(e) {
                $('.submitbtn').html('Please Wait...');
                $('.submitbtn').attr('disabled', true);
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: '{{ route("saveContact") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('.submitbtn').html('Get in Touch');
                        $('.submitbtn').attr('disabled', false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your message has been sent successfully.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Optionally, you can reset the form here
                            $('.contactForm')[0].reset();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.subscribenewsletter').on('submit', function(e) {
                $('.submitbtnsubs').html('Please Wait...');
                $('.submitbtnsubs').attr('disabled', true);
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: '{{ route("saveNewsletter") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('.submitbtnsubs').html('Join Us');
                        $('.submitbtnsubs').attr('disabled', false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Thank You For Subscription.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Optionally, you can reset the form here
                            $('.contactForm')[0].reset();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#searchFormhelp').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 2) { // Start searching after 3 characters
                    $.ajax({
                        url: "{{ route('site.helpAutoComplete') }}",
                        type: "GET",
                        data: $('#helpsearch').serialize(),
                        success: function(data) {
                            $('#autocomplete-results').empty();
                            if (data.length > 0) {
                                $.each(data, function(index, value) {
                                    $('#autocomplete-results').append('<li data="' + value.slug + '">' + value.question + '</li>');
                                });
                            } else {
                                $('#autocomplete-results').append('<li>No results found</li>');
                            }
                        }
                    });
                } else {
                    $('#autocomplete-results').empty();
                }
            });

            // Handle the click event on the autocomplete results
            $(document).on('click', '#autocomplete-results li', function() {
                $('#searchFormhelp').val($(this).text());
                $('#searchFormslug').val($(this).attr('data'));
                $('#autocomplete-results').empty();
            });
        });

        $("#btn-search-form").click(function() {
            if ($("#searchFormslug").val() !== '') {
                var slug = $("#searchFormslug").val();
                window.location.href = '/help/' + slug;
            }
        })
    </script>

</body>
</html>
