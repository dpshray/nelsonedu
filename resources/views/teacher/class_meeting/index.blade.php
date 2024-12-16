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
                                        List Class Meetings
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <?php $question_id = 0; ?>
                        <a href="{{ route('teacher.class_meeting.create', $classroom->id) }}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Add Class Meeting
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
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Classroom</th>
                                                <th scope="col">Meeting Id</th>
                                                <th scope="col">Topic</th>
                                                <th scope="col">Start Date Time</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($meetings as $meeting)

                                            <tr>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $classroom->name }}
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                            {{ $meeting->meeting_id }}
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                            {{ $meeting->topic }}
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                            {{ $meeting->start_date_time }}
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                            {{ $meeting->duration }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 flex-wrap">
                                                        <a href="{{ route('teacher.class_meeting.show', [$classroom->id, $meeting->id]) }}" class="text-info fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        <!-- <a href="{{ $meeting->start_url }}" class="text-info fs-14 lh-1" target="__blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Start Meeting">
                                                            <i class="ti ti-arrows-shuffle-2"></i>
                                                        </a> -->
                                                        @if (auth()->user()->isAdmin())
                                                            <a href="{{ route('teacher.class_meeting.edit', [$classroom->id, $meeting->id]) }}" class="text-info fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                <i class="ri-edit-line"></i>
                                                            </a>
                                                            
                                                            <form action="{{ route('teacher.class_meeting.destroy', [$classroom->id, $meeting->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
        
                                                                <a href="javascript:;" onclick="confirmation(event)" class="text-danger fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <i class="ri-delete-bin-5-line"></i>
                                                                </a>

                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $meetings->links('pagination::bootstrap-5') }}

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