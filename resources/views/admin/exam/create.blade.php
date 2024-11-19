
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
                                        {{ $title == 'Create' ? 'Add' : 'Edit' }}
                                        Exam
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <a href="{{route('teacher.exam.index')}}">
                            <button class="btn btn-primary-light btn-wave me-2">
                                <i class="bx bx-crown align-middle"></i> Show Exams
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
                                            <label for="name" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $exam->title ?? old('title') }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                            <label for="negative_marking_percent" class="form-label">Percentage -ve Mark</label>
                                            <input type="number" class="form-control" id="negative_marking_percent" name="negative_marking_percent" value="{{ $exam->negative_marking_percent ?? old('negative_marking_percent') }}">
                                            <x-input-error :messages="$errors->get('negative_marking_percent')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                            <label for="target" class="form-label">Target</label>
                                            <input type="text" class="form-control" id="target" name="target" value="{{ $exam->target ?? old('target') }}">
                                            <x-input-error :messages="$errors->get('target')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                            <label for="price" class="form-label">Price in NPR</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ $exam->price ?? old('price') }}">
                                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="5">{{ $exam->description ?? old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="file" class="form-label">Exam Banner Image</label>
                                            <input class="form-control" type="file" name="image">
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ isset($exam->status) && $exam->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ isset($exam->status) && $exam->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-wave">{{ $title == 'Edit' ? 'Update' : 'Add' }} Exam</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::row-1 -->

            </div>
        </div>
        <!-- END MAIN-CONTENT -->

        <!-- FOOTER -->
        @include('admin.footer')