<x-layouts.base title="blogs">

    <x-layouts.hero/>


        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">


                    @foreach ($updates as $key => $update)
                        <div class="col-md-6 col-lg-4 ftco-animate">
                            <div class="blog-entry">
                                <a href="{{ route('blogs.show', $update->id) }}" class="block-20 d-flex align-items-end"
                                    style="background-image: url('{{ asset('storage/' . $update->image) }}');">
                                    <div class="meta-date text-center p-2">
                                        <span class="day">{{ $update->created_at->format('d') }}</span>
                                        <span class="mos">{{ $update->created_at->format('M') }}</span>
                                        <span class="yr">{{ $update->created_at->format('Y') }}</span>
                                    </div>
                                </a>
                                <div class="text bg-white p-4">
                                    <h3 class="heading">{{ $update->title }}</h3>
                                    <p>{{ $update->content }}</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <p class="mb-0"><a href="{{ route('blogs.show', $update->id) }}"
                                                class="btn btn-primary">Read More <span
                                                    class="ion-ios-arrow-round-forward"></span></a></p>
                                        {{-- <p class="ml-auto mb-0">
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
        </section>
        </x-layouts.base>
