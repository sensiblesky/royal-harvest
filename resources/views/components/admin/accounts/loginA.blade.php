<!DOCTYPE html>
<html lang="en">
    <head>
        <title>login</title>
        <meta charset="UTF-8">
        <meta name="description" content="SolMusic HTML Template">
        <meta name="keywords" content="music, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('static/logo.svg')  }}" rel="shortcut icon" />
        <link rel="stylesheet" href="{{ asset('static/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('static/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('static/css/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('static/css/slicknav.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('static/css/style.css') }}" />
    </head>
<body>
    
<section class=" text-center mx-auto">
    <div class="container " >
           
            <div >
                <div class="card" >
                    <div class="section-title mb-0">
                        <img src="{{ asset('static/logo.svg')}}" alt="" width="200">
                        <p>Your Fevarite Backbord 
                        </p> 
                    </div>
                                      
                    <form class="" action="{{ route('account.auth')  }}" method="POST">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                     {{-- @csrf --}}
                                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input name="email" type="text" class="form-control" id="" placeholder="Your Email">
                                  </div>
                                  <div class="form-group">
                                    <input name="password" type="text" class="form-control" id="" placeholder="Your Password">
                                  </div>
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>

                    <form>
                       
                      </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>



















