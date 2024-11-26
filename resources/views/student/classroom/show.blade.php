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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Classroom - {{ $classroom->name }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div>
                    <h3>Class Meetings</h3>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($classroom->class_meetings as $class_meeting)
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $class_meeting->topic }}</h5>
                                            <p class="card-text">Start Date: {{ $class_meeting->start_date_time }}</p>
                                            <p class="card-text mt-2">
                                                Join Url: 
                                                <a href="{{ $class_meeting->join_url }}" class="btn btn-primary" target="__blank">Join Meeting</a>
                                                <p class="mt-3">
                                                    {{ $class_meeting->join_url }}
                                                </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-5">
                    <h3>Study Materials</h3>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($classroom->lecture_videos as $index => $lecture_video)
                        <div class="col">

                            <div class="card">
                                <div class="card-body" style="display: flex; justify-content: space-between;">
                                    <h5 class="card-title"> Lecture Video - {{ $index + 1 }}</h5>
                                    <p></p>
                                    <a href="{{ route('student.lecture_video.show', [$lecture_video->id]) }}" class="btn btn-primary">View</a>

                                </div>
                                <div class="card-body">
                                    <h3>Files</h3>
                                </div>
                                @foreach($lecture_video->study_materials as $study_material)
                                    @php $fileName = $study_material->getFileName($study_material->file)  @endphp

                                    <div class="card-body" style="display: flex; justify-content: space-between;">
                                        <h5 class="card-title"> {{ $fileName }} : </h5>
                                        <p></p>
                                        <a href="{{ route('student.study_material.preview', [$study_material->id, 'fileName' => $fileName]) }}" class="btn btn-primary">View</a>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

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
                        title: "Are you sure you want to Enroll to this Class?",
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