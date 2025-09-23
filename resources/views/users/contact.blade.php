<!DOCTYPE html>
<html lang="en">
@include('users.head')
<body>
<div class="page-wrapper">

<div class="preloader"></div>

@include('users.header')


<section class="page-title" style="background-image: url(images/background/page-title.jpg);">
<div class="auto-container">
<div class="title-outer">
<h1 class="title">Contact Us</h1>
<ul class="page-breadcrumb">
<li><a href="{{url('/')}}">Home</a></li>
<li>Contact</li>
</ul>
</div>
</div>
</section>


<section class="contact-details">
<div class="container ">
<div class="row">
<div class="col-xl-7 col-lg-6">
	<div class="sec-title">
		<span class="sub-title">Need any help?</span>
		<h2>Get in touch with us</h2>
		<div class="text">We are here to support you at every step of your journey towards building a successful career abroad.  
			Whether you are preparing for the NCLEX exam, applying for a study or work visa, enrolling in caregiver training, or improving your language skills through IELTS, PTE, or OET classes — our experienced team is ready to guide you.  
			
			Reach out to us today for expert counseling, personalized guidance, and dedicated assistance with your application process.  
			Your dream of studying, working, or settling abroad begins with a simple conversation — contact us now and let’s make it happen together.  
			 
			</div>
		</div>
</div>
<div class="col-xl-5 col-lg-6">
<div class="contact-details__right">
<div class="sec-title">
<span class="sub-title">Reach Us</span>
<h2>Call, Email or Visit us</h2>
</div>
<ul class="list-unstyled contact-details__info">
<li>
<div class="icon">
<span class="lnr-icon-phone-plus"></span>
</div>
<div class="text">
<h6>Have any question?</h6>
<a href="#"><span>Free</span> +977 01-5911365</a>
</div>
</li>
<li>
<div class="icon">
<span class="lnr-icon-envelope1"></span>
</div>
<div class="text">
<h6>Write email</h6>
<a href="#"><span class="__cf_email__" data-cfemail="9ef0fbfbfaf6fbf2eedefdf1f3eefff0e7b0fdf1f3">nelsonedunepal@gmail.com</span></a>
</div>
</li>
<li>
<div class="icon">
<span class="lnr-icon-location"></span>
</div>
<div class="text">
<h6>Visit anytime</h6>
<span>Nursary Road, Bansbari, Maharajgunj</span>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</section>


<section>
<div class="p-0 container-fluid">
<div class="row">

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1765.5639306749592!2d85.341057!3d27.744202!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e50e503ccb%3A0x1ffc24c0f40f03cd!2sNelson%20educational%20consultants!5e0!3m2!1sen!2snp!4v1723149837931!5m2!1sen!2snp" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
</section>

@include('users.footer')
<script>
	(function($) {
		$("#contact_form").validate({
			submitHandler: function(form) {
				var form_btn = $(form).find('button[type="submit"]');
				var form_result_div = '#form-result';
				$(form_result_div).remove();
				form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
				var form_btn_old_msg = form_btn.html();
				form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
				$(form).ajaxSubmit({
					dataType:  'json',
					success: function(data) {
						if( data.status == 'true' ) {
							$(form).find('.form-control').val('');
						}
						form_btn.prop('disabled', false).html(form_btn_old_msg);
						$(form_result_div).html(data.message).fadeIn('slow');
						setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
					}
				});
			}
		});
	})(jQuery);
</script>
</body>

</html>