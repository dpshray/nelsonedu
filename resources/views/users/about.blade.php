<!DOCTYPE html>
<html lang="en">
@include('users.head')
<body>
<div class="page-wrapper">

<div class="preloader"></div>

@include('users.header')


<section class="page-title" style="background-image: url({{asset('user-assets/images/background/page-title.jpg')}});">
<div class="auto-container">
<div class="title-outer">
<h1 class="title">About Us</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li><a href="{{url('about-us')}}">About Us</a></li>
</ul>
</div>
</div>
</section>


<section class="about-section">
<div class="anim-icons">
<span class="icon icon-dotted-map"></span>
</div>
<div class="auto-container">
<div class="row">
<div class="order-2 content-column col-lg-6 col-md-12 wow fadeInRight" data-wow-delay="600ms">
<div class="inner-column">
<div class="sec-title">
<span class="sub-title">Get to know us</span>
<h2>Grow your skills learn with us from anywhere</h2>
<div class="text">We are a trusted education consultancy helping students achieve success in NCLEX, study abroad programs, caregiver training, and language proficiency tests. Our expert guidance, proven results, and personalized support ensure that every student is prepared to build a brighter future and succeed globally.
</div>
</div>
<ul class="list-style-one two-column">
<li><i class="icon fa fa-check"></i> Expert trainers</li>
<li><i class="icon fa fa-check"></i> Online learning</li>
<li><i class="icon fa fa-check"></i> Unlimited access</li>
<li><i class="icon fa fa-check"></i> Great results</li>
</ul>
<div class="btn-box">
<a href="{{ url('/about-us') }}" class="theme-btn btn-style-one"><span class="btn-title">Discover more</span></a>
</div>
</div>
</div>

<div class="image-column col-lg-6 col-md-12">
<div class="anim-icons">
<span class="icon icon-dotted-map-2"></span>
<span class="icon icon-paper-plan"></span>
<span class="icon icon-dotted-line"></span>
</div>
<div class="inner-column wow fadeInLeft">
<figure class="image-1 overlay-anim wow fadeInUp"><img src="{{asset('user-assets/images/resource/about-1.png')}}" alt></figure>
<figure class="image-2 overlay-anim wow fadeInRight"><img src="{{asset('user-assets/images/resource/about-2.jpg')}}" alt></figure>
</div>
</div>
</div>
</div>
</section>


<section class="courses-section">
<div class="auto-container">
<div class="anim-icons">
<span class="icon icon-e wow zoomIn"></span>
</div>
<div class="sec-title">
<span class="sub-title">popular courses</span>
<h2>Pick a course to<br> get started your study</h2>
</div>
<div class="carousel-outer">

    <div class="courses-carousel owl-carousel owl-theme default-nav">
    @foreach($classroom as $classroom)
    <div class="course-block">
    <div class="inner-box">
    <div class="image-box">
        <figure class="image"><a href="{{url('class/details/')}}/{{$classroom->id}}"><img src="{{ asset('storage/' . $classroom->image) }}" alt></a></figure>
        <!--
    <span class="price">{{$classroom->enrollment_cost}}</span>
        -->
    <div class="value">{{$classroom->target_exam}}</div>
    </div>
    <div class="content-box">
    <ul class="course-info">
    <li><i class="fa fa-book"></i> {{$classroom->no_of_lectures}} Lectures</li>
    </ul>
    <h5 class="title"><a href="{{url('class/details/')}}/{{$classroom->id}}">{{$classroom->name}}</a></h5>
    <div class="other-info">
        <div class="rating-box">
            <span class="text">{{ Str::limit($classroom->description, 30, '...') }}</span>
        </div>
    </div>
    </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>
<div class="bottom-text">
<div class="content">
<strong>Get Access</strong> to more skillful courses you can explore <a href="page-courses.html" class="theme-btn btn-style-one small">Explore All Courses</a>
</div>
</div>
</div>
</section>


<section class="features-section">
<div class="auto-container">
<div class="row">

<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp">
<div class="inner-box ">
<i class="icon flaticon-online-learning"></i>
<h5 class="title">Online<br> Certifications</h5>
</div>
</div>

<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="400ms">
<div class="inner-box ">
<i class="icon flaticon-elearning"></i>
<h5 class="title">Top<br> Instructors</h5>
</div>
</div>

<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="800ms">
<div class="inner-box ">
<i class="icon flaticon-web-2"></i>
<h5 class="title">Unlimited <br>Online Courses</h5>
</div>
</div>

<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="1200ms">
<div class="inner-box ">
<i class="icon flaticon-users"></i>
<h5 class="title">Experienced <br>Members</h5>
</div>
</div>
</div>
</div>
</section>


<section class="team-section">
    <div class="auto-container">
    <div class="text-center sec-title">
    <span class="sub-title">qualified teachers</span>
    <h2>Get to Know Our <br>Dedicated Teaching Professionals</h2>
    </div>
    <div class="row">
    
    <div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="#"><img src="{{asset('user-assets/images/resource/roma.jpg')}}" alt></a></figure>
    <span class="share-icon fa fa-share-alt"></span>
    <div class="social-links">
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-pinterest-p"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    </div>
    <div class="info-box">
    <h4 class="name"><a href="#">Roma Balami</a></h4>
    <span class="designation">Founder & Executive Director</span>
    </div>
    </div>
    </div>
    
    <div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="#"><img src="{{asset('user-assets/images/resource/sunita.jpg')}}" alt></a></figure>
    <span class="share-icon fa fa-share-alt"></span>
    <div class="social-links">
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-pinterest-p"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    </div>
    <div class="info-box">
    <h4 class="name"><a href="#">Sunita Dhungana
</a></h4>
    <span class="designation">Program Director</span>
    </div>
    </div>
    </div>

    <div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
<div class="inner-box">
<div class="image-box">
<figure class="image"><a href="#"><img src="{{asset('user-assets/images/resource/tara.jpg')}}" alt></a></figure>
<span class="share-icon fa fa-share-alt"></span>
<div class="social-links">
<a href="#"><i class="fab fa-twitter"></i></a>
<a href="#"><i class="fab fa-facebook-f"></i></a>
<a href="#"><i class="fab fa-pinterest-p"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
</div>
</div>
<div class="info-box">
<h4 class="name"><a href="#">Tara Kr. Karn</a></h4>
<span class="designation">Trainer</span>
</div>
</div>
</div>

<div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
<div class="inner-box">
<div class="image-box">
<figure class="image"><a href="#"><img src="{{asset('user-assets/images/resource/bijaya.jpg')}}" alt></a></figure>
<span class="share-icon fa fa-share-alt"></span>
<div class="social-links">
<a href="#"><i class="fab fa-twitter"></i></a>
<a href="#"><i class="fab fa-facebook-f"></i></a>
<a href="#"><i class="fab fa-pinterest-p"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
</div>
</div>
<div class="info-box">
<h4 class="name"><a href="#">Bijaya Manandhar</a></h4>
<span class="designation">Caregiver Trainer</span>
</div>
</div>
</div>
    <!--
    <div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="page-team-details.html"><img src="{{asset('user-assets/images/resource/team-3.jpg')}}" alt></a></figure>
    <span class="share-icon fa fa-share-alt"></span>
    <div class="social-links">
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-pinterest-p"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    </div>
    <div class="info-box">
    <h4 class="name"><a href="page-team-details.html">Mike hardson</a></h4>
    <span class="designation">Developer</span>
    </div>
    </div>
    </div>
    
    <div class="team-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="page-team-details.html"><img src="{{asset('user-assets/images/resource/team-4.jpg')}}" alt></a></figure>
    <span class="share-icon fa fa-share-alt"></span>
    <div class="social-links">
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-pinterest-p"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    </div>
    <div class="info-box">
    <h4 class="name"><a href="page-team-details.html">Christine eve</a></h4>
    <span class="designation">Artisit</span>
    </div>
    </div>
    </div>
    -->
    </div>
    </div>
    </section>


@include('users.footer')
</body>
</html>