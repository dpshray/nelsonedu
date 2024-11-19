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
                                        Add Class Meeting
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('teacher.classroom.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Classroom
                            </button>
                        </a>

                        <a href="{{route('teacher.class_meeting.index', $classroom->id)}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> List Class Meetings
                            </button>
                        </a>
                    </div>
                </div>
                <!-- Page Header Close -->
                @foreach ($errors->all() as $error)
                {{$error}}
                @endforeach
                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <form method="POST" action="{{ $route }}" data-toggled="validator" enctype="multipart/form-data">
                                    @csrf
                                    @csrf
                                    {{ $title == 'Edit' ? method_field('PUT') : '' }}

                                    <div class="row gy-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name" class="form-label"> Class Name</label>
                                            <input type="text" class="form-control" id="name" name="name" disabled value="{{ $classroom->name}}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="topic" class="form-label"> Topic</label>
                                            <input type="text" class="form-control" id="topic" name="topic" {{ $title == 'Show' ? 'disabled' : '' }} value="{{ $classMeeting->topic ?? old('topic') }}">
                                            <x-input-error :messages="$errors->get('topic')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="start_date_time" class="form-label">Start Date Time</label>
                                            <input type="datetime-local" class="form-control" id="start_date_time" name="start_date_time" {{ $title == 'Show' ? 'disabled' : '' }} value="{{ $classMeeting->start_date_time ?? old('start_date_time') }}">
                                            <x-input-error :messages="$errors->get('start_date_time')" class="mt-2" />

                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" style="transform: scale(1.3);" type="checkbox" role="switch" id="recurring_meeting" name="recurring_meeting" value="{{ isset($classMeeting) ? $classMeeting?->recurring : '' }}" {{ $title == 'Show' ? 'disabled' : '' }} {{ isset($classMeeting->recurring) && $classMeeting->recurring == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="recurring_meeting">Recurring Meeting</label>
                                            </div>

                                            <div style="display: {{ isset($classMeeting) && $classMeeting->recurring ? 'block' : 'none' }}" id="recurring_meeting_form">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3">
                                                    <label for="recurrence" class="form-label"> Recurrence: </label>
                                                    <select style="width: 50%; display:inline-block" class="form-control" name="recurrence" {{ $title == 'Show' ? 'disabled' : '' }}>
                                                        <option value="1" {{ isset($classMeeting) && $classMeeting->recurring_type == 1 ? 'selected' : '' }}>Daily</option>
                                                        <option value="2" {{ isset($classMeeting) && $classMeeting->recurring_type == 2 ? 'selected' : '' }}>Weekly</option>
                                                        <option value="3" {{ isset($classMeeting) && $classMeeting->recurring_type == 3 ? 'selected' : '' }}>Monthly</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('recurrence')" class="mt-2" />
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3">
                                                    <label for="repeat_interval" class="form-label">Repeat Interval: </label>
                                                    <select style="width: 50%; display:inline-block;" class="form-control" name="repeat_interval" {{ $title == 'Show' ? 'disabled' : '' }}>
                                                        @for ($i=1; $i<=10; $i++)
                                                            <option value="{{ $i }}" {{ isset($classMeeting) && $classMeeting->recurring_repeat_interval == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <x-input-error :messages="$errors->get('repeat_interval')" class="mt-2" />

                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3">
                                                    <label for="end_time_after" class="form-label">End After: </label>
                                                    <select style="width: 50%; display:inline-block;" class="form-control" name="end_time_after" id="end_time_after" {{ $title == 'Show' ? 'disabled' : '' }}>
                                                        @for ($i=1; $i<=10; $i++)
                                                            <option value="{{ $i }}"  {{ isset($classMeeting) && $classMeeting->recurring_end_times == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    occurences
                                                    <x-input-error :messages="$errors->get('end_time_after')" class="mt-2" />
                                                </div>  
                                            </div>

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="duration" class="form-label">Duration in minutes</label>
                                            <input type="number" class="form-control" id="duration" name="duration" {{ $title == 'Show' ? 'disabled' : '' }} value="{{ $classMeeting->duration ?? old('duration') }}">
                                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="password" class="form-label"> Meeting Password</label>
                                            <input type="text" class="form-control" id="password" name="password" {{ $title == 'Show' ? 'disabled' : '' }} value="{{ $classMeeting->password ?? old('password') }}">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div></div>

                                        @if($title != 'Show')
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Add' }} Class Meeting</button>
                                            </div>
                                        @endif

                                    </div>
                                </form>

                                @if($title == 'Show')
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="topic" class="form-label"> Start URL</label>
                                        <textarea class="form-control" rows="10" cols="10"> {{ $classMeeting->start_url }} </textarea>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-5">
                                        <label for="topic" class="form-label"> Join URL</label>
                                        <textarea class="form-control" > {{ $classMeeting->join_url }} </textarea>
                                    </div>
                                @endif

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

<script>
    $(document).ready(function() {
        const now = new Date();
        const formattedDateTime = now.toISOString().slice(0, 16);
        document.getElementById('start_date_time').setAttribute('min', formattedDateTime);


        var recurring = {{ isset($classMeeting->recurring) && $classMeeting->recurring == 1 ? 1 : 0  }}
        $('#recurring_meeting').click(function() {
            recurring = !recurring;
            $('#recurring_meeting').val(+recurring)
            $('#recurring_meeting_form').toggle();
        });
    });
</script>
</body>

</html>