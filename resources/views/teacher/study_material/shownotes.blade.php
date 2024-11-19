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


        @include('admin.navigation')

        <div class="main-content app-content">
            <div class="container-fluid">
            
               
                <div class="row">
                   
                    <div class="col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header">
                                Study Notes
                            </div>
                            <div class="card-body">
                                <div class="plyr__video-embed" id="player1">
                                    <center>
                                        <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="600px" />
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            <!-- <video controls controlsList="nodownload">
                <source src="{{ asset('storage/small_video.mp4') }}" type="video/mp4" >
                Your browser does not support the video tag.
            </video> -->
            </div>
        </div>
    </div>

    @include('admin.footer')

</body>
</html>