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
<h1 class="title">Study Abroad</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li>Study Abroad</li>
</ul>
</div>
</div>
</section>


<section class>
<div class="container pb-70">
<div class="row">

    @foreach($abroad as $abroad)
    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="{{url('abroad/details/')}}/{{$abroad->id}}"><img src="{{ asset('storage/' . $abroad->image) }}" alt></a></figure>
    </div>
    <div class="content-box">
    <div class="content">
    <ul class="post-info">
    <li><i class="fa fa-user"></i> by Admin</li>
    </ul>
    <h4 class="title"><a href="{{url('abroad/details/')}}/{{$abroad->id}}">{{$abroad->country}}</a></h4>
    <a href="{{url('abroad/details/')}}/{{$abroad->id}}" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    @endforeach


</div>
</div>
</section>

@include('users.footer')
</body>

</html>