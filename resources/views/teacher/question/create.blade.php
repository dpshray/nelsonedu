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
                                    {{ $title == 'Create' ? 'Add' : 'Edit' }} Questions
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                       
                        <a href="{{route('teacher.question.index', $exam->id)}}">
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
                                <form method="POST" action="{{ $route }}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf
                                    {{ $title == 'Edit' ? method_field('PUT') : '' }}

                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="type" class="form-label"> Question Type</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="radio" {{ isset($question->type) && $question?->type == 'radio' ? 'selected' : '' }}>Single Correct MCQ</option>
                                                <option value="checkbox" {{ isset($question->type) && $question?->type == 'checkbox' ? 'selected' : '' }}>Multiple Correct MCQ</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text" id="question" class="form-control" name="question" value="{{ $question->question ?? old('question') }}">
                                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="question_image" class="form-label">Image for Question</label>
                                            <input class="form-control" type="file" id="question_image" name="question_image">
                                            <x-input-error :messages="$errors->get('question_image')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="explanation" class="form-label">Explanation</label>
                                            <textarea class="form-control" rows="5" id="explanation" name="explanation">{{ $question->explanation ?? old('explanation') }}</textarea>
                                            <x-input-error :messages="$errors->get('explanation')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="explanation_image" class="form-label">Image for Explanation</label>
                                            <input class="form-control" type="file" id="explanation_image" name="explanation_image">
                                            <x-input-error :messages="$errors->get('explanation_image')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="marks" class="form-label">Marks</label>
                                            <input type="number" id="marks" class="form-control" name="marks" value="{{ $question->marks ?? old('marks') }}">
                                            <x-input-error :messages="$errors->get('marks')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Add' }} Question</button>
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