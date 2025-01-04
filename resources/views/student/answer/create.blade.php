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
                                        Exam
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('student.answer.store', $exam->id) }}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gy-4">
                                        @foreach ($questions as $index => $question)
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <label for="type" class="form-label fw-bold">{{$index + 1}}. {{ $question->question }} </label>
                                                @if(!empty($question->question_image))
                                                    <div style="margin-left: 5rem">
                                                        <img src="{{ asset($question->question_image) }}" alt="Image" width="600" height="300">
                                                    </div>
                                                @endif
                                                <div>
                                                    @foreach($question->options as $option)
                                                        <div>
                                                            <input type="{{ $question->type }}" name="{{ 'question_' . $question->id . '[]' }}" value="{{ $option->id }}" {{ $question->type == 'radio' ? 'required' : '' }} >
                                                            <label class="form-label"> {{ $option->option  }} </label>
                                                            @if(!empty($option->image))
                                                                <div style="margin-left: 5rem">
                                                                    <img src="{{ asset($option->image) }}" alt="Image" width="600" height="300">
                                                                </div>
                                                            @endif

                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            
                                        @endforeach

                                    </div>

                                    <div class="mt-5">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>            


            </div>
        </div>

        <!-- END MAIN-CONTENT -->

        <!-- FOOTER -->

        @include('admin.footer')

</body>

</html>