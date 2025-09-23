<!DOCTYPE html>
<html lang="en">
    @include('users.head')
<body>
<div class="page-wrapper">

<div class="preloader"></div>
@include('users.header')

<section class="page-title" style="background-image: url({{asset('user-assets/images/background/page-title.jpg')}});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Gallery</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>
</section>


<section class="py-5 gallery-section">
    <div class="container">
        <!-- Tabs -->
        <ul class="mb-4 nav nav-tabs justify-content-center" id="galleryTabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#abroad">Abroad Studies</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nclex">NCLEX</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nnc">NNC</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#cee">CEE</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#caregiver">Care Giver Program</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#ielts">IELTS/PTE/OET</a></li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Abroad Studies -->
            <div class="tab-pane fade show active" id="abroad">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/abroad1.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/abroad1.jpg')}}" class="rounded shadow img-fluid" alt="Abroad Studies">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/abroad3.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/abroad3.jpg')}}" class="rounded shadow img-fluid" alt="Abroad Studies">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/abroad4.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/abroad4.jpg')}}" class="rounded shadow img-fluid" alt="Abroad Studies">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/abroad5.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/abroad5.jpg')}}" class="rounded shadow img-fluid" alt="Abroad Studies">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/abroad2.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/abroad2.jpg')}}" class="rounded shadow img-fluid" alt="Abroad Studies">
                        </a>
                    </div>
                </div>
            </div>

            <!-- NCLEX -->
            <div class="tab-pane fade" id="nclex">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex1.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex1.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex2.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex2.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex3.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex3.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex4.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex4.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex5.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex5.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nclex6.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nclex6.jpg')}}" class="rounded shadow img-fluid" alt="NCLEX">
                        </a>
                    </div>
                </div>
            </div>
                        <!-- IELTS -->
                        <div class="tab-pane fade" id="ielts">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="gallery-item">
                                        <img src="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                                    </a>
                                </div>          
                            </div>
                        </div>
                                                <!-- NNC -->
        <div class="tab-pane fade" id="nnc">
        <div class="row g-3">
        <div class="col-md-4">
        <a href="{{asset('user-assets/images/gallery/nnc1.jpg')}}" class="gallery-item">
        <img src="{{asset('user-assets/images/gallery/nnc1.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
        </a>
        </div> 
        <div class="col-md-4">
            <a href="{{asset('user-assets/images/gallery/nnc2.jpg')}}" class="gallery-item">
            <img src="{{asset('user-assets/images/gallery/nnc2.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
            </a>
            </div>
            <div class="col-md-4">
                <a href="{{asset('user-assets/images/gallery/nnc3.jpg')}}" class="gallery-item">
                <img src="{{asset('user-assets/images/gallery/nnc3.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                </a>
                </div>
                <div class="col-md-4">
                    <a href="{{asset('user-assets/images/gallery/nnc4.jpg')}}" class="gallery-item">
                    <img src="{{asset('user-assets/images/gallery/nnc4.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                    </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{asset('user-assets/images/gallery/nnc5.jpg')}}" class="gallery-item">
                        <img src="{{asset('user-assets/images/gallery/nnc5.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                        </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{asset('user-assets/images/gallery/nnc6.jpg')}}" class="gallery-item">
                            <img src="{{asset('user-assets/images/gallery/nnc6.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                            </a>
                            </div>              
        </div>
        </div>
                                <!-- CEE -->
                                <div class="tab-pane fade" id="cee">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <a href="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="gallery-item">
                                                <img src="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                                            </a>
                                        </div>          
                                    </div>
                                </div>
                        <!-- Caregiver -->
                        <div class="tab-pane fade" id="caregiver">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="gallery-item">
                                        <img src="{{asset('user-assets/images/gallery/ielts1.jpg')}}" class="rounded shadow img-fluid" alt="IELTS">
                                    </a>
                                </div>          
                            </div>
                        </div>
            <!-- Other tabs (NNC, CEE, Caregiver, IELTS...) -->
            <!-- Repeat the same structure -->
        </div>
    </div>
</section>

<!-- Custom Lightbox -->
<div id="lightbox" class="lightbox d-none">
    <span class="close-lightbox">&times;</span>
    <img id="lightboxImage" class="lightbox-img" src="" alt="">
</div>

@include('users.footer')

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* Lightbox styles */
.lightbox {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
}
.lightbox-img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 0 20px #000;
}
.close-lightbox {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: #fff;
    cursor: pointer;
}
</style>

<script>
// Open Lightbox
document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        let src = this.getAttribute('href');
        document.getElementById('lightboxImage').src = src;
        document.getElementById('lightbox').classList.remove('d-none');
    });
});

// Close Lightbox on cross or click outside
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target.id === 'lightbox' || e.target.classList.contains('close-lightbox')) {
        this.classList.add('d-none');
    }
});
</script>

</div>
</body>
</html>
