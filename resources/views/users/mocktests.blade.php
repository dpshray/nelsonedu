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
<h1 class="title">Mock Tests</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li><a href="{{url('mock-tests')}}">Mock Tests</a></li>
</ul>
</div>
</div>
</section>


<section class>
<div class="container pb-100">
<div class="row">
    <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
    <div class="inner-box">
    <div class="image-box">
    <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/nclex-mock-test.jpg')}}" alt></a></figure>
    </div>
    </div>
    </div>

    <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box">
        <div class="image-box">
        <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/nnc-mock-test.jpg')}}" alt></a></figure>
        </div>
        </div>
        </div>

        <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
            <div class="image-box">
            <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/bns-mock-test.jpg')}}" alt></a></figure>
            </div>
            </div>
            </div>

            <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                <div class="image-box">
                <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/mn-mock-test.jpg')}}" alt></a></figure>
                </div>
                </div>
                </div>

                <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                    <div class="image-box">
                    <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/prometric-mock-test.jpg')}}" alt></a></figure>
                    </div>
                    </div>
                    </div>

                    <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                        <div class="image-box">
                        <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/ielts-mock-test.jpg')}}" alt></a></figure>
                        </div>
                        </div>
                        </div>

                        <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                            <div class="image-box">
                            <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/pte-mock-test.jpg')}}" alt></a></figure>
                            </div>
                            </div>
                            </div>

                            <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                <div class="image-box">
                                <figure class="image"><a href="https://nelson.dworklabs.com/login"><img src="{{asset('user-assets/images/resource/oet-mock-test.jpg')}}" alt></a></figure>
                                </div>
                                </div>
                                </div>

</div>
</div>
</section>


@include('users.footer')
</body>
</html>