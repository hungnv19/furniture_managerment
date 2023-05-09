<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>HOTLINE: (+84) 0962523872

                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @if (!Auth::check())
                                <a href="{{ asset('/login') }}">Sign in</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ asset('/') }}"><img src="{{ asset('img/noi-that/logo.png') }}" width="160px" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="{{ asset('/') }}">Home</a></li>
                        <li><a href="{{ asset('/shop') }}">Shop</a></li>
                        <li><a href="{{ asset('/about') }}">Giới Thiệu</a> </li>
                        <li><a href="{{ asset('/blog') }}">Tin Tức</a></li>
                        <li><a href="{{ asset('/contact') }}">Liên Hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    @if (Auth::check())
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">

                                {{ Auth::user()->name }}

                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ asset('/profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ asset('/cart') }}">Cart</a>
                                <a class="dropdown-item" href="{{ asset('/logout') }}">Logout</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
</header>
