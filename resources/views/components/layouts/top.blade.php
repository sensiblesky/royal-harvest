<div class="bg-top navbar-light">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center align-items-stretch">
            <div class="col-md-4 d-flex align-items-center py-4">
                <a class="navbar-brand" href="index.html">Royal Harvest
                    <span>Pixies Bridal Saloon </span></a>
            </div>
            <div class="col-lg-8 d-block">
                <div class="row d-flex">
                    {{-- <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="icon-paper-plane"></span></div>
                        <div class="text">
                            <span>Email</span>
                            <span>info@royalharvest.co.tz</span>
                        </div>
                    </div> --}}
                    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
                        <div class="icon d-flex justify-content-center align-items-center"><span
                                class="icon-phone2"></span></div>
                        <div class="text">
                            <span>Call Us</span>
                            <span>+255 759 389 897</span>
                        </div>
                    </div>
                    {{-- <div class="dropdown col-md topper d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ __('messages.change_language') }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('change.language', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('change.language', 'sw') }}">Swahili</a></li>
                            <li><a class="dropdown-item" href="{{ route('change.language', 'fr') }}">French</a></li>
                        </ul>
                    </div> --}}
                    <div class="dropdown col-md topper d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="languageDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('messages.change_language') }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ route('change.language', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('change.language', 'sw') }}">Swahili</a></li>
                            <li><a class="dropdown-item" href="{{ route('change.language', 'fr') }}">French</a></li>
                        </ul>
                    </div>

                    <div class="col-md topper d-flex align-items-center justify-content-end">
                        <p class="mb-0">
                            <a href="{{ route('booking.index') }}"
                                class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center">
                                <span>{{ __('messages.book_now') }}</span>
                            </a>
                                                        {{-- {{ app()->getLocale() }} --}}

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        {{-- <form action="#" class="searchform order-lg-last">
          <div class="form-group d-flex">
            <input type="text" class="form-control pl-3" placeholder="Search">
            <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
          </div>
        </form> --}}
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}"><a href="/"
                        class="nav-link pl-0">Home</a></li>
                <li class="nav-item {{ Request::routeIs('booking.index') ? 'active' : '' }}"><a
                        href="{{ route('booking.index') }}" class="nav-link">Booking</a></li>
                {{-- <li class="nav-item"><a href="" class="nav-link">Schools</a></li> --}}
                      <!-- Schools Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="schoolsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Schools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="schoolsDropdown">
                        <a class="dropdown-item" href="{{ route('programme') }}">Programmes Offered</a>
                        <a class="dropdown-item" href="{{ route('apply.index')  }}">How to Apply</a>
                    </div>
                </li>
                <li class="nav-item"><a href="" class="nav-link">Services</a></li>
                 		<li class="nav-item {{ Request::routeIs('blogs.index') ? 'active' : '' }}"><a href="{{route('blogs.index')}}" class="nav-link">Blogs</a></li>
                <li class="nav-item"><a href="{{route('about.index')}}" class="nav-link">About</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
