<header class="main-header header-style-one">

   <div class="main-box">
   <div class="logo-box">
   <div class="logo"><a href="{{url('/')}}"><img src="{{asset('user-assets/images/logo.png')}}" alt></a></div>
   </div>
   
   <div class="nav-outer">
   <nav class="nav main-menu">
   <ul class="navigation">
   <li class=""><a href="{{url('/about-us')}}">About Us</a></li>
   <li class=""><a href="{{url('/classes')}}">Classes</a></li>
   <li class=""><a href="{{url('/mock-tests')}}">Mock Tests</a></li>
   <li class=""><a href="{{url('/notice')}}">Notices</a></li>
   <li class=""><a href="{{url('/study-abroad')}}">Study Abroad</a></li>
   <li class=""><a href="{{url('/contact-us')}}">Contact Us</a></li>
   </ul>
   </nav>
   
   <div class="outer-box">
   <a href="tel:+97715911365" class="info-btn">
   <i class="icon fa fa-phone"></i>
   <small>Call Anytime</small><br> +977 01-5911365
   </a>
@if (Route::has('login'))
   <nav class="-mx-3 flex flex-1 justify-end">
       @auth
           @php
               // Determine the dashboard URL based on user roles using Spatie's hasRole method
               $dashboardUrl = '/dashboard'; // Default URL

               if (auth()->user()->hasRole('Admin')) {
                   $dashboardUrl = '/admin/dashboard';
               } elseif (auth()->user()->hasRole('Teacher')) {
                   $dashboardUrl = '/teacher/dashboard';
               } elseif (auth()->user()->hasRole('Student')) {
                   $dashboardUrl = '/student/dashboard';
               }
           @endphp
           <a
               href="{{ url($dashboardUrl) }}"
               class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white "
           >
               Dashboard
           </a>
       @else
           <a
               href="{{ route('login') }}"
               class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white "
           >
               Log In
           </a>

           @if (Route::has('register'))
               <a
                   href="{{ route('register') }}"
                   class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white "
               >
                   Register
               </a>
           @endif
       @endauth
   </nav>
@endif



   
   <div class="mobile-nav-toggler"></div>
   </div>
   </div>
   </div>
   
   
   <div class="mobile-menu">
   <div class="menu-backdrop"></div>
   
   <nav class="menu-box">
   <div class="upper-box">
   <div class="nav-logo"><a href="{{url('/')}}"><img src="{{asset('user-assets/images/logo-2.png')}}" alt title></a></div>
   <div class="close-btn"><i class="icon fa fa-times"></i></div>
   </div>
   <ul class="navigation clearfix">
   
   </ul>
   <ul class="contact-list-one">
   <li>
   
   <div class="contact-info-box">
   <i class="icon lnr-icon-phone-handset"></i>
   <span class="title">Call Now</span>
   <a href="tel:+977015911365">+977 01-5911365</a>
   </div>
   </li>
   <li>
   
   <div class="contact-info-box">
   <span class="icon lnr-icon-envelope1"></span>
   <span class="title">Send Email</span>
   <a href=""><span class="" data-cfemail="630b060f1323000c0e13020d1a4d000c0e">nelsonedunepal@gmail.com</span></a>
   </div>
   </li>
   <li>
   
   <div class="contact-info-box">
   <span class="icon lnr-icon-clock"></span>
   <span class="title">Send Email</span>
   Sun - Fri 8:00 - 6:30, Saturday - CLOSED
   </div>
   </li>
   </ul>
   <ul class="social-links">
   <li><a href="#"><i class="fab fa-twitter"></i></a></li>
   <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
   <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
   <li><a href="#"><i class="fab fa-instagram"></i></a></li>
   </ul>
   </nav>
   </div>
   
   <div class="search-popup">
   <span class="search-back-drop"></span>
   <button class="close-search"><span class="fa fa-times"></span></button>
   <div class="search-inner">
   <form method="post" action="https://html.kodesolution.com/2022/edulerns-html/index.html">
   <div class="form-group">
   <input type="search" name="search-field" value placeholder="Search..." required>
   <button type="submit"><i class="fa fa-search"></i></button>
   </div>
   </form>
   </div>
   </div>
   
   
   <div class="sticky-header">
   <div class="auto-container">
   <div class="inner-container">
   
   <div class="logo">
   <a href="{{url('/')}}" title><img src="{{asset('user-assets/images/logo.png')}}" alt title></a>
   </div>
   
   <div class="nav-outer">
   
   <nav class="main-menu">
   <div class="navbar-collapse show collapse clearfix">
   <ul class="navigation clearfix">
   
   </ul>
   </div>
   </nav>
   
   <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
   </div>
   </div>
   </div>
   </div>
   </header>