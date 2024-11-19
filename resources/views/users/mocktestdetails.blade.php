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
<h1 class="title">{{$detail->title}}</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
</ul>
</div>
</div>
</section>


<section class="course-details">
<div class="container">
<div class="row flex-xl-row-reverse">

<div class="col-xl-8 col-lg-8">
<div class="courses-details__content">
<img src="{{ asset('storage/' . $detail->image) }}" alt />
<h2 class="mt-4">Mock Test Overview</h2>
<p>{{$detail->description}}</p>
<div class="content mt-40">

<div class="row mt-30">

</div>
</div>

</div>
</div>


<div class="col-xl-4 col-lg-4">
<div class="course-sidebar">
<ul class="course-details-info">
<li class="course-details-info-link">
<span class="course-details-info-icon"><i class="far fa-flag"></i></span>
Target: <span>{{$detail->target}}</span>
</li>
<li class="course-details-info-link">
<span class="course-details-info-icon"><i class="far fa-bell"></i></span>
Negative Marking: <span>{{$detail->negative_marking_percent}}%</span>
</li>
</ul>
<div class="course-details-price">
<p class="course-details-price-text">Mock Test price</p>
<p class="course-details-price-amount">NPR {{$detail->price}}</p>
<a href="{{url('/login')}}" class="theme-btn btn-style-two course-details-price-btn">Buy This Mock Test</a>
</div>

</div>
</div>

</div>
</div>
</section>


@include('users.footer')
</body>

</html>