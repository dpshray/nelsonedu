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

                <!-- Page Header -->
                <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h1 class="page-title fw-medium fs-18 mb-2">Dashboard</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $title == 'Create' ? 'Add' : 'Edit' }}
                                        Lecture Video
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('teacher.classroom.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Classroom
                            </button>
                        </a>
                        <a href="{{route('teacher.lecture_video.index', $classroom->id)}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Lecture Videos
                            </button>
                        </a>
                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <form method="POST" action="{{ $route }}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf
                                    {{ $title == 'Edit' ? method_field('PUT') : '' }}

                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name" class="form-label"> Class Name</label>
                                            <input type="text" class="form-control" id="name" name="name" disabled value="{{ $classroom->name}}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="file" class="form-label">File Upload</label>
                                            <button type="button" id="browseFile" class=" form-control btn-primary">Browse File</button>
                                            <div style="display: none" class="progress mt-3" style="height: 25px">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                            </div>

                                            <input type="hidden" id="file" name="file">
                                            <x-input-error :messages="$errors->get('file')" class="mt-2" />

                                            <div class="card-footer p-4" style="display: none">
                                                <img id="imagePreview" src="" style="width: 100%; height: auto; display: none" alt="img" />
                                                <video id="videoPreview" src="" controls style="width: 100%; height: auto; display: none"></video>
                                            </div>
                                        </div> -->

                                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                            <label for="link" class="form-label"> Iframe Link</label>
                                            <input type="text" class="form-control" id="link" name="link" value="{{ $lectureVideo->link ?? old('link')}}">
                                            <x-input-error :messages="$errors->get('link')" class="mt-2" />
                                        </div>

                                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">Upload</button>
                                        </div>

                                    </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!--End::row-1 -->

            </div>
        </div>


        @include('admin.footer')


        <script type="text/javascript">
            let browseFile = $('#browseFile');
            let resumable = new Resumable({
                target: "/route",
                query: {
                    _token: "{{csrf_token()}}"
                },
                fileType: ['png', 'jpg', 'jpeg', 'mp4'],
                chunkSize: 1024 * 1024, // it is in bytes, default is 1*1024*1024 = 1mb
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);
            resumable.assignDrop(document.getElementById('browseFile'));


            resumable.on('fileAdded', function(file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                response = JSON.parse(response);

                $('#file').val(response.name);

                // if (response.mime_type.includes("image")) {
                //     $('#imagePreview').attr('src', response.path + '/' + response.name).show();
                // }

                // if (response.mime_type.includes("video")) {
                //     $('#videoPreview').attr('src', response.path + '/' + response.name).show();
                // }

                $('.card-footer').show();
            });

            resumable.on('fileError', function(file, response) { // trigger when there is any error
                console.log('error: ', response)
                alert('file uploading error.')
            });

            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)

                if (value === 100) {
                    progress.find('.progress-bar').addClass('bg-success');
                }
            }

            function hideProgress() {
                progress.hide();
            }
        </script>

</body>

</html>