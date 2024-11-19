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
                                        My Classes
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($classrooms as $index => $classroom)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $classroom['name'] }}</h5>
                                    <p class="card-text">Lectures NO: {{ $classroom['no_of_lectures'] }}</p>
                                    <p class="card-text">Cost: {{ $classroom['enrollment_cost'] }}</p>
                                    <p class="card-text">Start Date: {{ $classroom['start_date'] }}</p>

                                    @if ($classroom->pivot->status)
                                        <a href="{{ route('student.classroom.show', $classroom->id) }}" class="btn btn-primary" role="button">Enter Class</a>
                                    @else
                                        <button>Pending</button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach

                    @if(count($classrooms) == 0)
                        <div class="text-center">
                            <h2>No Classes</h2>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- END MAIN-CONTENT -->

        <!-- FOOTER -->

        @include('admin.footer')

</body>

</html>