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
                                <p class="h4 mb-2 fw-semibold">Register Now</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="signin-username" class="form-label text-default">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="user name" required>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-xl-12">
                                        <label for="signin-username" class="form-label text-default">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="user Email" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password" class="form-label text-default d-block">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                      
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password" class="form-label text-default d-block">Confirm Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="password" required>
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                      
                                    </div>
                                </div>
                          
                            
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary">Register Now</button>
                                </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-muted mt-3 mb-0">Already Registered? <a href="{{url('login')}}" class="text-primary">Sign In</a></p>
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

