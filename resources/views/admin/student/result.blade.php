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
                                    <li class="breadcrumb-item"><a href="#">Teacher Panel</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Exam Result </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->
                <h3>Exam: {{ $exam->title }}</h3>
                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Student Email</th>
                                                <th scope="col">Full Marks</th>
                                                <th scope="col">Obtained Marks</th>
                                                <th scope="col">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($examStudents as $index => $estudent)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $estudent->name }}
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $estudent->email }}
                                                    </div>
                                                </th>

                                                <td>{{ $estudent->full_marks }}</td>
                                                <td>{{ $estudent->marks }}</td>
                                                <td>{{ ($estudent->marks / $estudent->full_marks) * 100 }} %</td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
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