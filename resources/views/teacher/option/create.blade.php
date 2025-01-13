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
                                        {{ $title == 'Create' ? 'Add' : 'Edit' }} Options
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <?php $question_id = 0; ?>
                        <a href="{{ route('teacher.question.index', $question->exam) }}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Questions
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <form method="POST" action="{{ $route }}" data-toggled="validator" enctype="multipart/form-data">
                                            @csrf
                                            {{ $title == 'Edit' ? method_field('PUT') : '' }}

                                            <div class="row gy-4">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <label for="option" class="form-label"> Option</label>
                                                    <input type="text" class="form-control" id="option" name="option" value="{{ $option->option ?? old('option') }}">
                                                    <x-input-error :messages="$errors->get('option')" class="mt-2" />
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <label for="correct_answer" class="form-label"> Correct Answer</label>
                                                    <select class="form-control" id="correct_answer" name="correct_answer">
                                                        <option value="0" {{ isset($option) && $option?->correct_answer ? 'selected' : '' }}>No</option>
                                                        <option value="1" {{ isset($option) && $option?->correct_answer ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('correct_answer')" class="mt-2" />

                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <label for="image" class="form-label"> Option Image</label>
                                                    <input class="form-control" type="file" id="image" name="image">
                                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                    <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Add' }} Option</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap table-bordered border-primary">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Option</th>
                                                        <th scope="col">Correct Answer</th>
                                                        <th scope="col">Option Image</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($options as $option)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="d-flex align-items-center">
                                                               
                                                                {{ $option->option }}
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <span class="badge bg-light text-dark">{{ $option->correct_answer ? 'Yes' : 'No' }}</span>
                                                        </td>
                                                        <td>
                                                            @if (!empty($option->image))
                                                                <img src="{{ asset('storage/' . $option->image) }}" alt="Image" width="100" height="50">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-2 flex-wrap">
                                                                <a href="{{ route('teacher.option.edit', [$question->id, $option->id]) }}" class="text-info fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <i class="ri-edit-line"></i>
                                                                </a>
                                                                <form action="{{ route('teacher.option.destroy', [$question->id, $option->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <a href="javascript:;" onclick="confirmation(event)" class="text-danger fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                        <i class="ri-delete-bin-5-line"></i>
                                                                    </a>
                                                                </form>

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