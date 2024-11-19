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
                                    <li class="breadcrumb-item active" aria-current="page">List of Exam Enrollable Students </li>
                                </ol>
                            </nav>
                        </div>
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
                                                <th scope="col">Exam Name</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Student Email</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($examStudents as $index => $estudent)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $estudent->exam->title }}
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        {{ $estudent->student->name }}
                                                    </div>
                                                </th>

                                                <td>{{ $estudent->student->email }}</td>
                                                <td>{{ $estudent->status == 1 ? 'Approved' : 'Pending' }}</td>
                                                <td>{{ $estudent->payment_status }}</td>
                                                <td>{{ $estudent->remarks }}</td>

                                                <td>
                                                    <div class="hstack gap-2 flex-wrap">
                                                        <!-- <form action="{{ route('admin.student.update', $estudent['id']) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <a href="javascript:;" onclick="enrollConfirmation(event)" class="text-info fs-14 lh-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve">
                                                                <i class="ri-restart-line"></i>
                                                            </a>
                                                        </form> -->
                                                        <button type="button" class="btn btn-primary openModal" data-id="{{ $estudent['id'] }}">
                                                            <i class="ri-restart-line"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $examStudents->links('pagination::bootstrap-5') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End::row-1 -->

            </div>
        </div>

        <!-- END MAIN-CONTENT -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel">Feedback Form</h5>
                        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="modalForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" rows="3" name="remarks" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="payment_status" required>
                                    <option value="Scholarship">Scholarship</option>
                                    <option value="Full Paid">Full Paid</option>
                                    <option value="Partially Paid">Partially Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="approve">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FOOTER -->

        @include('admin.footer')

        <script>
            $(document).ready(function() {
                $(".openModal").click(function() {
                    let id = $(this).data('id'); // Get the ID from the clicked element
                    let actionUrl = "{{ route('admin.student.update', '__id__') }}".replace('__id__', id);
                    $('#modalForm').attr('action', actionUrl);
    
                    $("#exampleModal").modal('show');
                });

                $(".closeModal").click(function() {
                    $("#exampleModal").modal('hide');
                });

                function isValid() {
                    let is_valid = true;
                    var myform = $('#myform');

                    if (!(myform.checkValidity())) {
                        myform.reportValidity();
                        is_valid = false;
                    }

                    return is_valid;
                }

                function enrollConfirmation(ev) {
                    ev.preventDefault();
                    var form = ev.target.closest('form'); // Get the closest form element
                    swal({
                            title: "Are you sure you want to Approve this Student to this Exam?",
                            icon: "info",
                            buttons: true,
                            dangerMode: false,
                        })
                        .then((willSubmit) => {
                            if (willSubmit) {
                                form.submit(); // Submit the form if the user confirms
                            }
                        });
                }

            });
        </script>

</body>

</html>