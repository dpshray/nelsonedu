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

        <!-- HEADER -->

        @include('admin.header')


        <!-- END HEADER -->

        <!-- SIDEBAR -->

        @include('admin.navigation')
        <!-- END SIDEBAR -->

        <!-- MAIN-CONTENT -->

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
                                        Study Materials
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
                        <a href="{{route('teacher.study_material.index', $classroom->id)}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Lecture Notes
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
                                <form method="POST" action="{{ $route}}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf
                                    {{ $title == 'Edit' ? method_field('PUT') : '' }}

                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name" class="form-label"> Class Name</label>
                                            <input type="text" class="form-control" id="name" name="name" disabled value="{{ $classroom->name}}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="file" class="form-label">File Upload</label>
                                            <input type="file" class="form-control" name="file[]" id="file" multiple='multiple'>
                                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                                        </div>
                                        
                                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                            <label for="video_link" class="form-label"> Video Link</label>
                                            <input type="text" class="form-control" id="video_link" name="video_link" value="{{ $lectureVideo->link ?? old('video_link')}}">
                                            <x-input-error :messages="$errors->get('video_link')" class="mt-2" />
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Upload' }}</button>
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

        <!-- END MAIN-CONTENT -->

        <!-- FOOTER -->

        @include('admin.footer')

</body>

</html>