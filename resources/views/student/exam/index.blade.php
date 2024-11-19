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

        @include('student.navigation')
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
                                    <li class="breadcrumb-item"><a href="#">Student Panel</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List of Exams</li>
                                    <li class="breadcrumb-item active" aria-current="page">My Exams</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-bordered mb-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Target</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Negative Marking</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($exams as $exam)
                                                @if(!$exam->students()->get()->pluck('id')->contains(auth()->id()))
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="d-flex align-items-center">
                                                                {{ $exam->title }}
                                                            </div>
                                                        </th>

                                                        <td>{{ $exam->target }}</td>
                                                        <td>{{ $exam->price }}</td>
                                                        <td>{{ $exam->negative_marking_percent }}</td>
                                                        <td>
                                                            <div class="hstack gap-2 flex-wrap">

                                                                    <form action="{{ route('student.exam.store', $exam->id) }}" method="POST">
                                                                        @csrf
                                                                        <a href="javascript:;" onclick="enrollConfirmation(event)" class="text-success fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Enroll">
                                                                            <i class="ri-restart-line"></i>
                                                                        </a>
                                                                    </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif

                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $exams->links('pagination::bootstrap-5') }}


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

        <script>
            function enrollConfirmation(ev) {
                ev.preventDefault();
                var form = ev.target.closest('form'); // Get the closest form element
                swal({
                        title: "Are you sure you want to Enroll to this Exam?",
                        icon: "info",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((willSubmit) => {
                        if (willSubmit) {
                            form.submit(); // Submit the form if the user confirms
                        }
                    });
            }
        </script>

</body>

</html>