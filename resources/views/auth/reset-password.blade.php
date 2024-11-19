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
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" /><br>
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" /><br>
            <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><br>

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
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
