@php
$decodeData=decodeData($page_data);
  $blogs= getBlogsPagignate();
@endphp

<section class="masonary-blog-section ptb-120">
                <div class="container">
                <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="section-heading text-center">
                                <h2>{{ $decodeData['title'] }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    @if(count($blogs) > 0)
                        @php $i = 1; @endphp
                        @foreach ($blogs as $item)
                        @if($i <  3)
                        <div class="col-lg-6 col-md-12">
                            <div class="single-article feature-article rounded-custom my-3">
                                <a href="{{ url('blog/'. $item->blog_slug) }}" class="article-img">
                                <img src="{{ asset('storage/uploads/' .$item->blog_image1) }}" alt="{{ $item->image1_alt }}" class="img-fluid">
                                </a>
                                <div class="article-content p-4">
                                    <div class="article-category mb-4 d-block">
                                        <a href="javascript:;" class="d-inline-block text-primary badge bg-primary-soft">
                                            {{ $item->category->category_name }}</a>
                                    </div>
                                    <a href="{{ url('blog/'. $item->blog_slug) }}">
                                        <h2 class="h5 article-title limit-2-line-text">{{ $item->blog_title }}</h2>
                                    </a>
                                    <p class="limit-2-line-text">{{ $item->blog_short_details1 }}.</p>

                                    <a href="javascript:;">
                                        <div class="d-flex align-items-center pt-4">
                                            <div class="avatar">
                                                 <img src="{{ asset('storage/uploads/'.$item->user->profile_image) }}" alt="avatar" width="40" class="img-fluid rounded-circle me-3">
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
                        @else
                  
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
                                                <img src="{{ asset('storage/uploads/'.$item->user->profile_image) }}" alt="avatar" width="40" class="img-fluid rounded-circle me-3">
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
                        @endif
                        @php $i++; @endphp
                                @endforeach
                                @else
                              No News Found
                                @endif
                                </div>


                    <!--pagination start-->
                    <div class="row justify-content-center align-items-center mt-5">
                    <nav aria-label="Page navigation example" class="{{ count($blogs) > 0 ? '' : 'd-none' }} " style="width: auto;">
                        <ul class="pagination">
                            @if ($blogs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                            @endif
                            @php
                            $start = max(1, $blogs->currentPage() - 5);
                            $end = min($blogs->lastPage(), $blogs->currentPage() + 5);
                            @endphp

                            @for ($i = $start; $i <= $end; $i++) <li class="page-item {{ ($blogs->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($blogs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                @endif
                        </ul>
                        <!-- <p>Total Records: {{ $blogs->total() }} Showing {{ $blogs->count() }} records per page</p> -->
                    </nav>
                    </div>
                    <!--pagination end-->
                </div>
            </section>