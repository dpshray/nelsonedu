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
                    $percentage = ($obtainedMarks / $fullMarks) * 100;
                @endphp
                <h4>Result Marks: {{ $obtainedMarks }}</h4>
                <h4>Percentage: {{ $percentage }} %</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-bordered mb-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col">Correct Answer</th>
                                                <th scope="col">Your Answer</th>
                                                <th scope="col">Result</th>
                                                <th scope="col">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($answers as $answer)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="d-flex align-items-center">
                                                                {{ $answer->question }}
                                                            </div>
                                                        </th>
                                                        <td>{{ $answer->correct }}</td>
                                                        <td>{{ $answer->options }}</td>
                                                        <td>
                                                            @php
                                                                $userAnswer = explode(',', $answer->is_correct);
                                                            @endphp
                                                            @foreach($userAnswer as $ans)
                                                                {{ $ans == 1 ? 'Correct' : 'Incorrect' }} ,
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $answer->marks }}</td>
                                                   
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