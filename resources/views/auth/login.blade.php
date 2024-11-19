<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <!-- Meta Data -->
		<meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="Description" content="Nelson Dashboard ">
        <meta name="keywords" content="">
        
        <!-- TITLE -->
		<title>Nelson Dashboard </title>

        <!-- FAVICON -->
        <link rel="icon" href="{{asset('user-assets/images/favicon.png')}}" type="image/x-icon">

        <!-- BOOTSTRAP CSS -->
	    <link  id="style" href="{{asset('admin-assets/build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- APP SCSS -->
        <link rel="preload" as="style" href="{{asset('admin-assets/build/assets/app-dDDo_cMZ.css')}}" />
        <link rel="stylesheet" href="{{asset('admin-assets/build/assets/app-dDDo_cMZ.css')}}" />        

        <!-- ICONS CSS -->
        <link href="{{asset('admin-assets/build/assets/icon-fonts/icons.css')}}" rel="stylesheet">

        <!-- MAIN JS -->
        <script src="{{asset('admin-assets/build/assets/authentication-main.js')}}"></script>

              


	</head>

    <body class="authentication-background">

        

            <div class="container">
                <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                        <div class="my-5 d-flex justify-content-center"> 
                            <a href="{{url('/')}}"> 
                                <img src="{{asset('admin-assets/build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark"> 
                            </a> 
                        </div>
                        <div class="card custom-card my-4">
                            <div class="card-body p-5">
                                <p class="h4 mb-2 fw-semibold">Sign In</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="signin-username" class="form-label text-default">Email</label>
                                        <input type="email" name="email" class="form-control" id="signin-username" placeholder="Email Address" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password" class="form-label text-default d-block">Password<a href="{{url('forgot-password')}}" class="float-end  link-danger op-5 fw-medium fs-12">Forget password ?</a></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="password" id="signin-password" placeholder="password" required>
                                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></a>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                      
                                    </div>
                                </div>
                          
                            
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-muted mt-3 mb-0">Dont have an account? <a href="{{url('register')}}" class="text-primary">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!-- SCRIPTS -->

        <!-- BOOTSTRAP JS -->
        <script src="{{asset('admin-assets/build/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        
        <!-- Show Password JS -->
        <script src="{{asset('admin-assets/build/assets/show-password.js')}}"></script>


        <!-- END SCRIPTS -->

	</body>
</html>

