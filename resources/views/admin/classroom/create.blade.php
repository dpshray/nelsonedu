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
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $title == 'Create' ? 'Add' : 'Edit' }}
                                        Classes
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('teacher.classroom.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Classes
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
                                <form id="form" method="POST" action="{{ $route }}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf
                                    @csrf
                                    {{ $title == 'Edit' ? method_field('PUT') : '' }}
                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name" class="form-label">Class Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $classroom->name ?? old('name') }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <label for="no_of_lectures" class="form-label">Number of Lectures</label>
                                            <input type="number" class="form-control" id="no_of_lectures" name="no_of_lectures" value="{{ $classroom->no_of_lectures ?? old('no_of_lectures') }}">
                                            <x-input-error :messages="$errors->get('no_of_lectures')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <label for="enrollment_cost" class="form-label">Enrollment Cost</label>
                                            <input type="number" class="form-control" id="enrollment_cost" name="enrollment_cost" value="{{ $classroom->enrollment_cost ?? old('enrollment_cost') }}">
                                            <x-input-error :messages="$errors->get('enrollment_cost')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="target_exam" class="form-label">Target Exam</label>
                                            <input type="text" class="form-control" id="target_exam" name="target_exam" value="{{ $classroom->target_exam ?? old('target_exam') }}">
                                            <x-input-error :messages="$errors->get('target_exam')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="start_date" class="form-label">Class Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $classroom->start_date ?? old('start_date') }}">
                                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="image" class="form-label">Class Banner Image</label>
                                            <input class="form-control" type="file" id="input-file" name="image">
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="description" class="form-label">Class Description Summary</label>
                                            <textarea class="form-control" name="description" id="description">{{ $classroom->description ?? old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Create' }} Class</button>
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