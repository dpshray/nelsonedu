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
    <div class="mb-4 text-sm text-gray-600">
        <b>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</b>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-danger">
                {{ __('Log Out') }}
            </button>
        </form>
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

