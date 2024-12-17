<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('meta_title')</title>
<link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">
<!-- Common css -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/viewport.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
<!-- font -->
<link rel="stylesheet" href="{{asset('assets/font/stylesheet.css')}}">
<!-- owl carousel -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-icons.css')}}">
<!-- animation -->
<link href="{{asset('assets/css/aos.css')}}" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

<!-----header start------>

<header class="fixed-top" id="banner">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg p-0 main-navigation"> 
          <!--  Show this only on mobile to medium screens  --> 
          <a class="navbar-brand logo" href="{{url('/')}}"> <img src="{{asset('assets/images/lexus-logo.svg')}}" class="img-fluid" alt="logo" width="" /> </a> </nav>
      </div>
    </div>
  </div>
</header>


      @yield('content-area')
   

   
<div class="whole-section"> 
  
  <!-----contact us start------>
  
<?php
use App\Models\Settings;
$content = Settings::first();
?>
  <section class="homecontact_section"  >
    <div class="container-fluid">
      <div class="row d-flex">
        <div class="col-lg-6"> <img class="w-100 lexusimgLeft" src="{{asset('assets/images/lexus-left-image.webp')}}"/> </div>
        <div class="col-lg-6">
          <div class="lexusContact" data-aos="fade-up" data-aos-duration="2500">
            <div class="addressTitle">We are in Kochi, Visit Us</div>
            <div class="address col-lg-5"> <span>{{ $content->title }}</span>{{ $content->address }}</div>
            <div class="contact"> <a href="">{{ $content->phone_number }}</a></div>
            <div class="email"> <a href="">{{ $content->email }}</a></div>
            <div class="socialMediaSection"> <span>Join us on</span>
              <div class="socialMediaBlock">
                <div class="socialMedia"> <a href="{{ $content->facebook }}" target="_blank" rel="noopener noreferrer"> <img src="{{asset('assets/images/Facebook.svg')}}" /> <span>Facebook</span> </a> </div>
                <div class="socialMedia"> <a href="{{ $content->instagram }}" target="_blank" rel="noopener noreferrer"> <img src="{{asset('assets/images/Instagram.svg')}}" /> <span>Instagram</span> </a> </div>
                <div class="socialMedia"> <a href="{{ $content->youtube }}" target="_blank" rel="noopener noreferrer"> <img src="{{asset('assets/images/Youtube.svg')}}" /> <span>Youtube</span> </a> </div>
              </div>
            </div>
          </div>
          <div class="lexusMap" data-aos="fade-up" data-aos-duration="2500">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15714.243560804638!2d76.3207408!3d10.0530464!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080dbad294caf9%3A0x725531a46bcef5bb!2sLexus%20Kochi!5e0!3m2!1sen!2sin!4v1732022228738!5m2!1sen!2sin" width="100%" height="540" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-----contact us end------> 
  
</div>
</body>

<!-- Common script -->

<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script>
var myCarousel = document.querySelector('#carouselMain')
var carousel = new bootstrap.Carousel(carouselMain, {
  interval: 4000,
  pause: false 
})
</script>

<!-- animation -->
<script src="{{asset('assets/js/aos.js')}}"></script>
<script>
AOS.init();
</script>

<!-- custom -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- header shrink -->
<script>
$(document).on("scroll", function(){
  if
    ($(document).scrollTop() > 86){
    $("#banner").addClass("shrink");
  }
  else
  {
    $("#banner").removeClass("shrink");
  }
}); 

</script>
<script>
  document.getElementById('submit-enquiry').addEventListener('click', function (e) {
    e.preventDefault();

    const form = document.getElementById('enquiry-form');
    const formData = new FormData(form);
    successMessage = document.getElementById('success-message');

    fetch('{{ route("enquiry") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            document.querySelectorAll('.text-danger.error').forEach(el => el.textContent = '');

            for (const [field, messages] of Object.entries(data.errors)) {
                const errorElement = document.getElementById(`${field}_error`);
                if (errorElement) {
                    errorElement.textContent = messages[0];
                }
            }
        } else if (data.success) {
            successMessage.style.display = 'block';  
            successMessage.textContent = data.success;          
            form.reset();
            document.querySelectorAll('.text-danger.error').forEach(errorElement => {
              errorElement.textContent = '';
          });
        }
    })
    .catch(error => console.error('Error:', error));
});

document.querySelector('.btn-close').addEventListener('click', function () {
    const form = document.getElementById('enquiry-form');
    const successMessage = document.getElementById('success-message');

    form.reset();
    document.querySelectorAll('.text-danger.error').forEach(errorElement => {
        errorElement.textContent = '';
    });
    successMessage.style.display = 'none';
    successMessage.textContent = '';
});
</script>
</html>


