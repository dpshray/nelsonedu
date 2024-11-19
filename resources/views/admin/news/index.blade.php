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
                                    <li class="breadcrumb-item active" aria-current="page">List of News/Events</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('admin.news.create')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Add New News/Event
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
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($newes as $news)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $news->title }}
                                                    </div>
                                                </th>

                                                <td>{{ $news->description }}</td>
                                                <td>{{ $news->getFileName($news->image)  }}</td>
                                                <td>
                                                    <div class="hstack gap-2 flex-wrap">
                                                        <a href="{{ route('admin.news.edit', $news->id) }}" class="text-info fs-14 lh-1" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"><i
                                                                class="ri-edit-line"></i></a>
                                                        <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:;" onclick="confirmation(event)" class="text-danger fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>

                                                        </form>
                                                    </div>
                                                </td>
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