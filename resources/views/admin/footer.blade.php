<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
        <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);" class="text-dark fw-medium">Nelson Education</a>.
            Designed by <a href="javascript:void(0);" target="_blank">
                <span class="fw-medium text-primary">dwork</span>
            </a> All
            rights
            reserved
        </span>
    </div>
</footer>
<!-- END FOOTER -->

</div>
<!-- END PAGE-->

<!-- SCRIPTS -->

<!-- SCROLL-TO-TOP -->
<div class="scrollToTop">
    <span class="arrow lh-1"><i class="ti ti-caret-up fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>

<!-- POPPER JS -->
<script src="{{asset('admin-assets/build/assets/libs/%40popperjs/core/umd/popper.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('admin-assets/build/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- NODE WAVES JS -->
<script src="{{asset('admin-assets/build/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- SIMPLEBAR JS -->



<link rel="modulepreload" href="{{asset('admin-assets/build/assets/simplebar-B35Aj-bA.js')}}" />
<script type="module" src="{{asset('admin-assets/build/assets/simplebar-B35Aj-bA.js')}}"></script>

<!-- PICKER JS -->
<script src="{{asset('admin-assets/build/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('admin-assets/build/assets/libs/%40simonwep/pickr/pickr.es5.min.js')}}"></script>

<!-- AUTO COMPLETE JS -->
<script src="{{asset('admin-assets/build/assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js')}}"></script>



<!-- STICKY JS -->
<script src="{{asset('admin-assets/build/assets/sticky.js')}}"></script>

<!-- APP JS -->
<link rel="modulepreload" href="{{asset('admin-assets/build/assets/app-L7SVdVWK.js')}}" />
<script type="module" src="{{asset('admin-assets/build/assets/app-L7SVdVWK.js')}}"></script>

<!-- CUSTOM-SWITCHER JS -->
<link rel="modulepreload" href="{{asset('admin-assets/build/assets/custom-switcher-jG6facXc.js')}}" />
<script type="module" src="{{asset('admin-assets/build/assets/custom-switcher-jG6facXc.js')}}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin-assets/build/assets/libs/simplebar/simplebar.min.js')}}"></script>


<!-- For deleting item  -->
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var form = ev.target.closest('form'); // Get the closest form element
        swal({
                title: "Are you sure you want to delete this?",
                text: "This action is permanent!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
    }
</script>
<!-- END SCRIPTS -->