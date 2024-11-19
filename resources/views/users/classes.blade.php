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
<h1 class="title">Available Classes</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li><a href="{{url('classes')}}">Classes</a></li>
</ul>
</div>
</div>
</section>


<section class>
<div class="container pb-100">
<div class="row">

@foreach($classroom as $classroom)
<div class="course-block-two col-lg-4 col-md-6 col-sm-12">
<div class="inner-box">
<div class="image-box">
<figure class="image"><a href="{{url('class/details/'. $classroom->id)}}"><img src="{{ asset('storage/' . $classroom->image) }}" alt></a></figure>
<span class="price">{{$classroom->enrollment_cost}}</span>
<div class="value">{{$classroom->target_exam}}</div>
</div>
<div class="content-box">
<ul class="course-info">
<li><i class="fa fa-book"></i> {{$classroom->no_of_lectures}} Lectures</li>
</ul>
<h5 class="title"><a href="{{url('class/details/'. $classroom->id)}}">{{$classroom->name}}</a></h5>
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
</section>


@include('users.footer')
</body>
</html>