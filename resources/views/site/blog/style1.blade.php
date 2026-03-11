@php
  $decodeData=decodeData($page_data);
  $blogsData= getlatestthreeBlogs();
@endphp
<section class="home-blog-section ptb-120 bg-light-subtle">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="section-heading text-center">
                                <h4 class="h5 text-primary">{{ $decodeData['subtitle'] }}</h4>
                                <h2>{{ $decodeData['title'] }}</h2>
                                <p>{{ $decodeData['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    @php 
                    $i=1;
                    @endphp
                    <div class="row">
                        <div class="blog-grid">
                        @if(isset($blogsData[0]))
                        <div class="featured-post-wrapper">
                                <div class="blog-item">
                                    <div class="blog-content bg-white">
                                        <div class="blog-media">
                                            <img src="{{ asset('storage/uploads/' .$blogsData[0]['blog_image1']) }}" alt="{{ $blogsData[0]['image1_alt'] }}" class="img-fluid">
                                        </div>
                                        <div class="blog-text p-4 p-lg-5">
                                            <span class="featured-badge"><i class="fas fa-bookmark text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Featured"></i></span>
                                            <a href="{{ url('blog/'. $blogsData[0]['blog_slug']) }}" target="_blank">
                                                <h3 class="h5">{{ $blogsData[0]['blog_title'] }}</h3>
                                            </a>
                                            <p>{{ $blogsData[0]['blog_short_details1'] }}</p>
                                            <div class="read-more-link">
                                                <a href="{{ url('blog/'. $blogsData[0]['blog_slug']) }}" target="_blank" class="mt-2 d-inline-flex align-items-center btn btn-sm btn-pill font-weight-bold"><span>Read More</span>
                                                    <i class="fas fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                          
                            <div class="posts-wrapper">
                            @if(isset($blogsData[1]))
                            <div class="blog-item">
                                    <div class="blog-content bg-white">
                                        <div class="blog-media">
                                        <img src="{{ asset('storage/uploads/' .$blogsData[1]['blog_image1']) }}" alt="{{ $blogsData[1]['image1_alt'] }}" class="img-fluid">
                                        </div>
                                        <div class="blog-text p-4 p-lg-5">
                                            <a href="{{ url('blog/'. $blogsData[1]['blog_slug']) }}" target="_blank">
                                                <h3 class="h5">{{ $blogsData[1]['blog_title']}}</h3>
                                            </a>
                                            <p>{{ $blogsData[1]['blog_short_details1'] }}</p>
                                            <div class="read-more-link">
                                                <a href="{{ url('blog/'. $blogsData[1]['blog_slug']) }}" target="_blank" class="mt-2 d-inline-flex align-items-center btn btn-sm btn-pill font-weight-bold"><span>Read More</span>
                                                    <i class="fas fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(isset($blogsData[2]))
                                <div class="blog-item">
                                    <div class="blog-content bg-white">
                                        <div class="blog-media">
                                        <img src="{{ asset('storage/uploads/' .$blogsData[2]['blog_image1']) }}" alt="{{ $blogsData[2]['image1_alt'] }}" class="img-fluid">
                                        </div>
                                        <div class="blog-text p-4 p-lg-5">
                                            <a href="{{ url('blog/'. $blogsData[2]['blog_slug']) }}" target="_blank">
                                                <h3 class="h5">{{ $blogsData[2]['blog_title']}}</h3>
                                            </a>
                                            <p>{{ $blogsData[2]['blog_short_details1'] }}</p>
                                            <div class="read-more-link">
                                                <a href="{{ url('blog/'. $blogsData[2]['blog_slug']) }}" target="_blank" class="mt-2 d-inline-flex align-items-center btn btn-sm btn-pill font-weight-bold"><span>Read More</span>
                                                    <i class="fas fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                         
                        </div>
                    </div>
                    
                </div>
            </section>