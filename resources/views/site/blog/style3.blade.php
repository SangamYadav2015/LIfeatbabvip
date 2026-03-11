@php
  $decodeData=decodeData($page_data);
  $blogs= getlatestthreeBlogs();
@endphp
<section class="related-blog-list ptb-120 bg-light-subtle">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-4 col-md-12">
                            <div class="section-heading">
                            <h4 class="h5 text-primary">{{ $decodeData['title'] }}</h4>
                            <h2>{{ $decodeData['description'] }}</h2>
                            </div>
                        </div>
                        <!-- <div class="col-lg-7 col-md-12">
                            <div class="text-start text-lg-end mb-4 mb-lg-0 mb-xl-0">
                                <a href="blog.html" class="btn btn-primary">View All Article</a>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                    @foreach ($blogs as $item)

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
                                            <div class="avatar">
                                                <img src="{{ asset('admin/uploads/admin-profile/'.$item->user->profile_image) }}" alt="avatar" width="40" class="img-fluid rounded-circle me-3">
                                            </div>
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