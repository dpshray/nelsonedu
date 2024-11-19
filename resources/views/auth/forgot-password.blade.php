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
                                <p class="h4 mb-2 fw-semibold">Password Reset</p>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                            
                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" /><br>
                                        <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                            
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="btn btn-primary">
                                            {{ __('Email Password Reset Link') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-muted mt-3 mb-0">Remember the Password? <a href="{{url('login')}}" class="text-primary">Sign In</a></p>
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




   



