<nav id="main-navbar">

    <a href="{{ route('home') }}" class="logo-image logo">
    </a>
    <div class="navbar-content">
        <div class="part">
            <a href="{{ route('home') }}" class=" {{((in_array($pageName, ["","index"]))? 'navbar-active': "" )}}">الرئيسية</a>
        </div>
        <div class="part navbar-active">
            <a href="/courses" class=" {{ ((in_array($pageName, ["courses", "section-courses", "course-content"]))? 'navbar-active': "") }}">الدورات</a>
        </div>
        {{--<div class="part">
            <a href="#">المدونة</a>
        </div>--}}
        <div class="part">
            <a href="/about-us" class=" {{ ((in_array($pageName, ["about-us"]))? 'navbar-active': "") }}">حول</a>
        </div>
        <div class="part">
            <a href="/contact-us" class=" {{ ((in_array($pageName, ["contact-us"]))? 'navbar-active': "") }}">اتصل بنا</a>
        </div>
    </div>
    <div class="search">
        <form action="{{ route('courses.search') }}" method="POST" class="flex">
            @csrf
            <input type="text" name="search_word" class="navbar-searchbar form-control" placeholder="البحث عن دورة">

            <button type="submit" class="navbar-search-submit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>
        </form>
    </div>


        @php
            $user_id = isset(Auth::user()->id) ? Auth::user()->id : '';
            $user_cart = App\Models\Cart::where('user_id', $user_id)->get()->first();
            $is_cart_empty = $user_cart ? $user_cart->courses->count() == 0 : null;
            $cart_counter = $user_cart ? $user_cart->courses->count() : null;
        @endphp
        <div class="user">
            <a href="/cart" style="transition: 0.3s;" class="{{ $is_cart_empty ? 'active' : '' }}  {{ ((in_array($pageName, ["cart"]))? 'navbar-active': "") }}">
                <svg class="cart" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg>
                @if(! $is_cart_empty)
                    <span id="card-counter" class="card-counter" >{{ $cart_counter }}</span>
                @endif
            </a>
            <div class="profile flex">
                <a href="register" >
                    <div class="user-image">

                    </div>
                </a>

                {{-- Start Register Form --}}
                @guest
                @if (Route::has('login'))
                    <li class="nav-item" style="list-style: none">
                        {{-- <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }}</a> --}}
                        <a class="nav-link" href="{{ route('login') }}"> تسجيل دخول</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item" style="list-style: none">
                        {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                        <a class="nav-link" href="{{ route('register') }}">مستخدم جديد</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown" style="list-style: none">
                    <a style="color: #fff" href="{{ route('profile.index') }}" role="button" >
                        {{ Auth::user()->name }}
                    </a>
                </li>

                <li style="list-style: none">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </li>
            @endguest
                {{-- End Register Form --}}

                {{-- <div class="name">
                    <a href="profile/1">مرحبا بك زياد</a>
                    <a href="#">تسجيل الخروج</a>
                </div> --}}
            </div>
        </div>

</nav>
