<x-layouts.app>


    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">Blog</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i
                                class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>





    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">



                @foreach ($updates as $key => $update)
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="blog-entry">
                            <a href="blog-single.html" class="block-20 d-flex align-items-end"
                                style="background-image: url({{ asset('storage/' . $update->image_path) }});">
                                <div class="meta-date text-center p-2">
                                    <span class="day">{{ strtoupper($update->created_at->day) }}</span>
                                    <span class="mos">{{ strtoupper($update->created_at->monthName) }}</span>
                                    <span class="yr">{{ strtoupper($update->created_at->year) }}</span>
                                </div>
                            </a>
                            <div class="text bg-white p-4">
                                <h3 class="heading"><a href="#">{{ $update->title }}</a>
                                </h3>
                                <p>{{ $update->content }}</p>
                                <div class="d-flex align-items-center mt-4">
                                    <p class="mb-0"><a href="{{ route('main.update.show', $update->id) }}"
                                            class="btn btn-primary">Read More <span
                                                class="ion-ios-arrow-round-forward"></span></a></p>
                                    <p class="ml-auto mb-0">
                                        <a href="#" class="mr-2">Admin</a>
                                        <a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            @if ($updates->hasMorePages())

                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">


                            <ul>

                                @if ($updates->onFirstPage())
                                    <li><a href="javascript:void(0)">&lt;</a></li>
                                @else
                                    <li><a href="{{ $updates->previousPageUrl() }}">&lt;</a></li>
                                @endif



                                @foreach ($updates->getUrlRange(1, $updates->lastPage()) as $page => $url)
                                    @if ($page == $updates->currentPage())
                                        <li class="active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach



                                @if ($updates->hasMorePages())
                                    <li><a href="{{ $updates->nextPageUrl() }}">&gt;</a></li>
                                @else
                                    <li><a href="javascript:void(0)" @disabled(true)>&gt;</a></li>
                                @endif

                            </ul>



                        </div>
                    </div>
                </div>

            @endif
        </div>
    </section>




</x-layouts.app>
