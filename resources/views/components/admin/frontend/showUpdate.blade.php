 <x-layouts.app>
 
 
 
 
 <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Blog Single</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home
                 <i class="ion-ios-arrow-forward"></i></a></span>
                  <span class="mr-2"><a href="{{ route('main.updates')}}">Blog <i class="ion-ios-arrow-forward"></i></a></span> 
                  <span>Blog Single <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row">
          <div class="col-lg-8 ftco-animate">
            <h2 class="mb-3">{{ $instance->title  }}</h2>
            {{-- <p>Temporibus ad error suscipit exercitationem hic molestiae totam obcaecati rerum, eius aut, in. Exercitationem atque quidem tempora maiores ex architecto voluptatum aut officia doloremque. Error dolore voluptas, omnis molestias odio dignissimos culpa ex earum nisi consequatur quos odit quasi repellat qui officiis reiciendis incidunt hic non? Debitis commodi aut, adipisci.</p>
            <p> --}}
              <img src="{{asset('storage/'.$instance->image_path) }}" alt="" class="img-fluid">
            </p>
            <p>{{ $instance->content}}</p>
           
            
            {{-- <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
                <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc">
                <h3>George Washington</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
              </div>
            </div> --}}


          
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

            {{-- <div class="sidebar-box ftco-animate">
            	<h3>Category</h3>
              <ul class="categories">
                <li><a href="#">Business <span>(6)</span></a></li>
                <li><a href="#">Finance <span>(8)</span></a></li>
                <li><a href="#">Auto loan <span>(2)</span></a></li>
                <li><a href="#">Real Estate <span>(2)</span></a></li>
                <li><a href="#">Businessman <span>(2)</span></a></li>
              </ul>
            </div> --}}

            <div class="sidebar-box ftco-animate">
                @if($blogs->count()>1)
                <h3>Popular Articles</h3>
                @endif

             @foreach ($blogs as $key=>$blog)
             
             @if ($blog->id!==$instance->id)
                  <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url({{ asset('storage/'.$blog->image_path) }});"></a>
                <div class="text">
                  <h3 class="heading"><a href="{{ route('main.update.show', $blog->id) }}">{{$blog->title }}</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> {{$blog->created_at->diffForHumans()}}</a></div>
                    {{-- <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div> --}}
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
             @endif
                 
             @endforeach
              

           


          </div><!-- END COL -->
        </div>
			</div>
		</section>


        </x-layouts.app>