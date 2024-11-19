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
                                        Study Abroad
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('admin.study_abroad.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Study Abroad
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
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" value="{{ $studyAbroad->country ??  old('country') }}" required>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />

                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="description" class="form-label"> Description </label>
                                            <textarea class="form-control" name="description" id="description" required>{{ $studyAbroad->description ?? old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="image" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="input-file" name="image" {{ $title == 'Create' ? 'required' : '' }}>
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Add' }} Study Abroad</button>
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