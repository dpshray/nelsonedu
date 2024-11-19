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
<h1 class="title">{{$detail->country}}</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li>Study Abroad</li>
</ul>
</div>
</div>
</section>


<section class="blog-details">
<div class="container">
<div class="row">
<div class="col-xl-8 col-lg-7">
<div class="blog-details__left">
<div class="blog-details__img">
<img src="{{ asset('storage/' . $detail->image) }}" alt>
</div>
<div class="blog-details__content">
<h3 class="blog-details__title">{{$detail->country}}</h3>
<p class="blog-details__text-2">{!! $detail->description !!}</p>
</div>
</div>
</div>
<div class="col-xl-4 col-lg-5">
<div class="sidebar">
<div class="sidebar__single sidebar__post">
<h3 class="sidebar__title">Latest Posts</h3>
<ul class="sidebar__post-list list-unstyled">
@foreach($abroad as $abroad)
<li>
<div class="sidebar__post-content">
    <h3>
        <span class="sidebar__post-content-meta"><i class="fas fa-user-circle"></i>Admin</span>
        <a href="{{ url('abroad/details/') }}/{{$abroad->id}}">{{$abroad->country}}</a>
    </h3>
<p>{!! Str::limit($abroad->description, 45, '...more') !!} </p>

</div>
</li>
@endforeach

</ul>
</div>



</div>
</div>
</div>
</div>
</section>


@include('users.footer')
</body>

</html>