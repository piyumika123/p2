<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/welcome/welcome.css') }}">
        <!-- Add Swiper.js CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="parent-card">
            <img src="{{ asset('images/samupa.png') }}" alt="Cooperative Logo" class="coop-logo">
            <div class="container">
                <div class="card logo-card">
                    <div class="carousel swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel1.jpg') }}" alt="Image 1" class="carousel-image">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel5.jpg') }}" alt="Image 2" class="carousel-image">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel6.jpg') }}" alt="Image 3" class="carousel-image">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel4.jpg') }}" alt="Image 4" class="carousel-image">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel2.jpg') }}" alt="Image 3" class="carousel-image">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/wel3.jpg') }}" alt="Image 4" class="carousel-image">
                            </div>
                        </div>
                        <!-- Add navigation buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- Add pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="card auth-card">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn">Register</a>
                            @endif
                        @endauth
                    @endif
                    <div class="welcome-message">
                    <h1 class="text-4xl font-bold text-center">Welcome to the Cooperative</h1>
                    <p class="text-center">We are a cooperative that provides financial services to our members.</p>
                </div> 
                </div>

                
            </div>
        </div>
        <!-- Add Swiper.js script -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                },
            });
        </script>
    </body>
</html>
