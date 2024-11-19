<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="transparent" data-width="default" data-menu-styles="light" data-toggled="close">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('admin.head')

<body>
    <!-- LOADER -->
    <div id="loader">
        <img src="{{asset('admin-assets/build/assets/images/media/loader.svg')}}" alt="">
    </div>
    <!-- END LOADER -->

    <!-- PAGE -->
    <div class="page">

        @include('admin.header')


        @include('student.navigation')

        <div class="main-content app-content">
            <div class="container-fluid">
            
               
                <div class="row">
                   
                    <div class="col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header">
                              Lecture Video 
                            </div>
                            <div class="card-body">
                                <div class="plyr__video-embed" id="player1">
                                    <center>
@php
    $url = $lectureVideo->link;

    // Convert YouTube watch or short links to embed links
    if (str_contains($url, 'youtu.be')) {
        $url = str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
    } elseif (str_contains($url, 'watch?v=')) {
        $url = str_replace('watch?v=', 'embed/', $url);
    }
@endphp

<iframe width="560" height="315" src="{{ $url }}" 
    title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
</iframe>


                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

</body>
</html>