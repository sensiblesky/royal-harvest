      @props(['title' => 'Blogs | Updates', ])
      
      
      <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('static/images/bg_5.jpg') }}');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">{{$title}}</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home 
                @if ($title == 'Blogs | Updates')
                <i class="ion-ios-arrow-forward"></i></a></span> <span>Blogs <i class="ion-ios-arrow-forward"></i></span>
                @endif
            </p>
          </div>
        </div>
      </div>
    </section>