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
                                        Assign Teacher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('admin.teacher.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Teachers
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
                                <form method="POST" action="{{ route('admin.assign_teacher.store', $classroom->id) }}" data-toggled="validator">
                                    @csrf

                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name" class="form-label"> Class Name</label>
                                            <input type="text" class="form-control" id="name" name="name" disabled value="{{ $classroom->name}}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="teachers" class="form-label">Teachers</label>
                                            <select class="form-control" name="teachers[]" id="teachers" multiple>
                                                @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $assignedTeachers) ? 'selected' : ''  }}>{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('teachers')" class="mt-2" />
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">Assign Teacher</button>
                                        </div>

                                    </div>
                                </form>
                                <form action="{{ route('admin.assign_teacher.destroy', $classroom->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <button onclick="confirmation(event)" type="submit" class="btn btn-danger btn-wave"> Remove Teachers</button>
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