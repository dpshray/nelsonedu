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
                                    <li class="breadcrumb-item active" aria-current="page">Exams</li>
                                    <li class="breadcrumb-item active" aria-current="page">Result</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
                 <h3>Exam: {{ $exam->title }}</h3>
                 @php 
                    $answers = collect($answers);
                    $obtainedMarks = $answers->pluck('answer_marks_per_question')->sum();
                    $fullMarks = $answers->pluck('question_marks')->sum();
                    $percentage = round(($obtainedMarks / $fullMarks) * 100,2);
                @endphp
                <h4>Full Marks: {{ $fullMarks }}</h4>
                <h4>Result Marks: {{ $obtainedMarks }}</h4>
                <h4>Percentage: {{ $percentage }} %</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @foreach($answers as $index => $answer)
                                        <div class="mb-3 border border-success p-2">
                                            <label class="form-label">{{$index + 1}}. {{ $answer->question }}</label>
                                            @if (!empty($answer->question_image))
                                                <div style="margin-left: 5rem">
                                                    <img src="{{ asset($answer->question_image) }}" alt="Image" width="300" height="200">
                                                </div>
                                            @endif

                                            <div class="ms-4">
                                                <div>
                                                    <div class="d-flex">
                                                        <label>Correct Answer: </label>
                                                        <p class="ms-1">{{ $answer->correct }}</p>
                                                    </div>
                                                    @if (!empty($answer->correct_image))
                                                        <div style="margin-left: 5rem">
                                                            @php
                                                                $correctImages = explode(',', $answer->correct_image);
                                                            @endphp
                                                            @foreach($correctImages as $correctImage)
                                                                <img src="{{ asset($correctImage) }}" alt="Image" width="300" height="200">
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="d-flex">
                                                        <label>Your Answer: </label>
                                                        <p class="ms-1">{{ $answer->options }}</p>
                                                    </div>
                                                    @if (!empty($answer->option_images))
                                                        <div style="margin-left: 5rem">
                                                            @php
                                                                $optionImages = explode(',', $answer->option_images);
                                                            @endphp
                                                            @foreach($optionImages as $optionImage)
                                                                <img src="{{ asset($optionImage) }}" alt="Image" width="300" height="200">
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex">
                                                    <label>Result: </label>
                                                    <p class="ms-1">
                                                        @php
                                                            $userAnswer = explode(',', $answer->is_correct);
                                                        @endphp
                                                        @foreach($userAnswer as $ans)
                                                            {{ $ans == 1 ? 'Correct' : 'Incorrect' }} ,
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="d-flex">
                                                    <label>Explanation: </label>
                                                    <p class="ms-1"> {!! nl2br($answer->explanation) !!}</p>
                                                </div>
                                                <div class="d-flex">
                                                    <label>Marks: </label>
                                                    <p class="ms-1">{{ $answer->marks }}</p>
                                                </div>
                                            </div>
                                        </div> 
                                    @endforeach

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