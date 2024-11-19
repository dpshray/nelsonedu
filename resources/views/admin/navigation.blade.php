<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
<div class="main-sidebar-header">
    @php
        // Set default URL
        $dashboardUrl = '/'; // Default URL for non-authenticated users

        // Check if user is authenticated and assign appropriate URL based on role
        if (auth()->check()) {
            if (auth()->user()->hasRole('Admin')) {
                $dashboardUrl = '/admin/dashboard';
            } elseif (auth()->user()->hasRole('Teacher')) {
                $dashboardUrl = '/teacher/dashboard';
            } elseif (auth()->user()->hasRole('Student')) {
                $dashboardUrl = '/student/dashboard';
            }
        }
    @endphp

    <a href="{{ url($dashboardUrl) }}" class="header-logo">
        <img src="{{ asset('admin-assets/build/assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
        <img src="{{ asset('admin-assets/build/assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
        <img src="{{ asset('admin-assets/build/assets/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
        <img src="{{ asset('admin-assets/build/assets/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
    </a>
</div>

    
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Web Apps</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="32" height="32" viewBox="0 0 256 256">
                            <path d="M112,56v48a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V56a8,8,0,0,1,8-8h48A8,8,0,0,1,112,56Zm88-8H152a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V56A8,8,0,0,0,200,48Zm-96,96H56a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V152A8,8,0,0,0,104,144Zm96,0H152a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V152A8,8,0,0,0,200,144Z" opacity="0.2"></path>
                            <path d="M200,136H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48ZM104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Z"></path>
                        </svg>
                        <span class="side-menu__label">Settings</span>
                        <i class="ri-arrow-down-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Apps</a>
                        </li>
                        @if (auth()->user()->isAdmin())
                            <li class="slide">
                                <a href="{{route('admin.news.create')}}" class="side-menu__item">Create News/Events</a>
                            </li>
                            <li class="slide">
                                <a href="{{route('admin.study_abroad.create')}}" class="side-menu__item">Create Study Abroad</a>
                            </li>
                            <li class="slide">
                                <a href="{{route('admin.teacher.create')}}" class="side-menu__item">Add Teachers</a>
                            </li>
                            <li class="slide">
                                <a href="{{route('admin.classroom.create')}}" class="side-menu__item">Create Class</a>
                            </li>
                            <li class="slide">
                                <a href="{{route('admin.exam.create')}}" class="side-menu__item">Create Exams</a>
                            </li>

                            <li class="slide">
                                <a href="{{route('admin.student.index')}}" class="side-menu__item">Exam Enrollable Students</a>
                            </li>

                            <li class="slide">
                                <a href="{{route('admin.classroom.student.index')}}" class="side-menu__item">Classroom Enrollable Students</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="32" height="32" viewBox="0 0 256 256">
                            <path d="M112,56v48a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V56a8,8,0,0,1,8-8h48A8,8,0,0,1,112,56Zm88-8H152a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V56A8,8,0,0,0,200,48Zm-96,96H56a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V152A8,8,0,0,0,104,144Zm96,0H152a8,8,0,0,0-8,8v48a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8V152A8,8,0,0,0,200,144Z" opacity="0.2"></path>
                            <path d="M200,136H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48ZM104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Z"></path>
                        </svg>
                        <span class="side-menu__label">Exams</span>
                        <i class="ri-arrow-down-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @if(auth()->user()->isAdmin())
                            <li class="slide">
                                <a href="{{route('admin.exam.create')}}" class="side-menu__item">Create Exam</a>
                            </li>
                        @endif
                        <li class="slide">
                            <a href="{{route('teacher.exam.index')}}" class="side-menu__item">List Exam</a>
                        </li>


                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide__category"><span class="category-name">Class Information</span></li>
                <!-- End::slide -->
                <li class="slide">
                    <a href="{{ route('teacher.classroom.index') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="32" height="32" viewBox="0 0 256 256"><path d="M224,96v16a32,32,0,0,1-64,0V96H96v16a32,32,0,0,1-64,0V96L46.34,45.8A8,8,0,0,1,54,40H202a8,8,0,0,1,7.69,5.8Z" opacity="0.2"></path><path d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96v16a40,40,0,0,0,16,32v64a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V144a40,40,0,0,0,16-32ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-48,0v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm-8-72a24,24,0,0,1-24-24v-8h48v8A24,24,0,0,1,192,136Z"></path></svg>
                        <span class="side-menu__label">Classes</span>
                    </a>
                </li>


                <!-- End::slide -->

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>