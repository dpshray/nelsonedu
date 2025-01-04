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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Add Questions
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <?php $question_id = 0; ?>
                        <a href="{{route('teacher.question.create', $exam->id)}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Add New Question
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
                                                <th scope="col">Question</th>
                                                <th scope="col">Question Image</th>
                                                <th scope="col">Explanation</th>
                                                <th scope="col">Explanation Image</th>
                                                <th scope="col">Question Type</th>
                                                <th scope="col">Marks</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($questions as $question)
                                            <tr>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ substr($question->question , 0,  100) }}...
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        @if (!empty($question->question_image))
                                                            <img src="{{ asset($question->question_image) }}" alt="Image" width="80" height="80">
                                                        @endif
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ substr($question->explanation , 0,  50) }}...
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        @if (!empty($question->explanation_image))
                                                            <img src="{{ asset($question->explanation_image) }}" alt="Image" width="80" height="80">
                                                        @endif

                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $question->type == 'radio' ? 'Single Correct MCQ' : 'Multiple Correct MCQ' }}
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $question->marks }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 flex-wrap">
                                                        <a href="{{ route('teacher.question.edit', [$exam->id, $question->id]) }}" class="text-info fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('teacher.question.destroy', [$exam->id, $question->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
    
                                                            <a href="javascript:;" onclick="confirmation(event)" class="text-danger fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>

                                                        </form>
                                                        <a href="{{ route('teacher.option.create', $question->id) }}" class="text-success fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Options">
                                                            <i class="bi bi-bookmark-plus"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $questions->links('pagination::bootstrap-5') }}

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