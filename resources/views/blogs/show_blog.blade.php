<x-layouts.base>
        <section class="hero-wrap hero-wrap-2" style="background-image: url('{{asset("storage/".$update->image)}}');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">{{$update->title}}</h1>
             <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{route('blogs.index')}}">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>{{$update->title}}<i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

		
		<section class="ftco-section">
			<div class="container">
				<div class="row">
          <div class="col-lg-8 ftco-animate">
            <h2 class="mb-3">{{$update->title}}</h2>
            <p>Posted: {{$update->created_at->diffForHumans()}}</p>
            <p>
              <img src="{{ asset('storage/' . $update->image) }}" alt="" class="img-fluid">
            </p>
           
            <p>{{$update->content}}</p>
            


          </div> <!-- .col-md-8 -->

          <div class="col-lg-4 sidebar ftco-animate">
            {{-- <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon icon-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div> --}}
            

            <div class="sidebar-box ftco-animate">
              <h3>Popular Updates</h3>
              @foreach ($articles as $key=>$article)
                  
            
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url({{asset('storage/'.$article->image)}});"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">{{$article->title}}</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> {{$article->created_at}}</a></div>
                    {{-- <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div> --}}
                    {{-- <div><a href="#"><span class="icon-chat"></span> 19</a></div> --}}
                  </div>
                </div>
              </div>
               @endforeach
            </div>


            
          </div><!-- END COL -->
        </div>
			</div>
		</section>
</x-layouts.base>