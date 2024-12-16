<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Lexus</title>
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
          <a class="navbar-brand logo" href="#"> <img src="{{asset('assets/images/lexus-logo.svg')}}" class="img-fluid" alt="logo" width="" /> </a> </nav>
      </div>
    </div>
  </div>
</header>

<!-----header end------> 

<!-- Button trigger modal --> 

<!-- Modal -->
<div class="modal fade enquiryModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('enquiry') }}" id="enquiry-form" method="POST">
      @csrf
        <div class="enquirySec">
          <div class="enquiryImg"> <img src="{{asset('assets/images/enquiry-image.webp')}}"/> </div>
          <div class="enquiryForm">
            <h1 class="modal-title" id="staticBackdropLabel">Make an Enquiry</h1>
            <p>Feel free to contact with us, we would love to assist you</p>
            <div class="enquiryFormBlock">
              <div class="chooseCheck">
                <div class="form-check form-check-inline">
                  {!! Form::radio('courtesy_title', 'option1', old('courtesy_title') == 'option1', ['class' => 'form-check-input', 'id' => 'inlineRadio1']) !!}
                  {!! Form::label('inlineRadio1', 'Mr.', ['class' => 'form-check-label']) !!}
                </div>
                <div class="form-check form-check-inline">
                  {!! Form::radio('courtesy_title', 'option2', old('courtesy_title') == 'option2', ['class' => 'form-check-input', 'id' => 'inlineRadio2']) !!}
                  {!! Form::label('inlineRadio2', 'Mrs.', ['class' => 'form-check-label']) !!}
                </div>
                <div class="form-check form-check-inline">
                  {!! Form::radio('courtesy_title', 'option3', old('courtesy_title') == 'option3', ['class' => 'form-check-input', 'id' => 'inlineRadio3']) !!}
                  {!! Form::label('inlineRadio3', 'Ms.', ['class' => 'form-check-label']) !!}
                </div>
              </div>
                  {!! Form::hidden('model_id', old('model_id'), array('class'=>'form-control', 'id'=>'model_id_enquiry','placeholder'=>'')) !!}
              <div class="row formBlock">
                <div class="col-lg-12">
                  <label for="name" class="form-label">Name*</label>
                  {!! Form::text('name', old('name'), array('class'=>'form-control', 'id'=>'name','placeholder'=>'')) !!}
                  <span  class="text-danger error" style="color:#e03b3b" id="name_error">{{ $errors->first('name') }}</span>  
                  </div>
              </div>
              <div class="row formBlock formBlockSelect">
                <div class="col-lg-12">
                  <label for="phone" class="form-label">Mobile Number*</label>
                </div>
                <div class="col-lg-4">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>+91</option>
                  </select>
                </div>
                <div class="col-lg-8">
                {!! Form::text('phone', old('phone'), array('class'=>'form-control', 'id'=>'phone','placeholder'=>'')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="phone_error">{{ $errors->first('phone') }}</span>  
                </div>
              </div>
              <div class="row formBlock formBlockCityModel">
                <div class="col-lg-6">
                  <label for="exampleFormControlInput1" class="form-label">City</label>
                  {!! Form::text('city', old('city'), array('class'=>'form-control', 'id'=>'city','placeholder'=>'')) !!}
                  <span  class="text-danger error" style="color:#e03b3b" id="city_error">{{ $errors->first('city') }}</span>  
                </div>
                <div class="col-lg-6">
                  <label for="exampleFormControlInput1" class="form-label">Vehicle Model</label>
                  {!! Form::text('vehicle_model', old('vehicle_model'), array('class'=>'form-control', 'id'=>'vehicle_model','placeholder'=>'')) !!}
                  <span  class="text-danger error" style="color:#e03b3b" id="vehicle_model_error">{{ $errors->first('vehicle_model') }}</span>  
                </div>
              </div>
              <!-- <div class="row formBlock">
                <div class="col-lg-12">
                  <label for="exampleFormControlInput1" class="form-label">Job Title</label>
                  {!! Form::text('job_title', old('job_title'), array('class'=>'form-control', 'id'=>'job_title','placeholder'=>'')) !!} 
                </div>
              </div> -->
              <!-- <div class="row formBlock">
                <div class="col-lg-12">
                  <label for="exampleFormControlInput1" class="form-label">Company</label>
                  {!! Form::text('company', old('company'), array('class'=>'form-control', 'id'=>'company','placeholder'=>'')) !!} 
                </div>
              </div> -->
              <div class="row formBlock">
                <div class="col-lg-12">
                  <label for="exampleFormControlTextarea1" class="form-label">Message/Comments</label>
                  {!! Form::textarea('message', old('comments'), array('class'=>'form-control', 'id'=>'comments', 'rows'=>'3', 'placeholder'=>'')) !!} 
                </div>
              </div>
              <div class="row formBlock">
                <div class="col-lg-12 text-end">
                  <button type="submit enquiry_submit" class="primaryBtn">Submit</button>
                </div>
              </div>
            </div>
</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<section class="slider_section">
  <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
     
      @if(count($models)>0)
       <?php $i=0;?>
      @foreach($models as $model)
      <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="{{$i}}" class="active thumbnail" aria-current="true" aria-label="Slide {{$i}}"> <img src="{{asset($model['banner_image'])}}" class="d-block w-100" alt="..."> </button>
      <?php $i++; ?>
      @endforeach
      @endif
<!--       <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" class="thumbnail" aria-label="Slide 2"> <img src="assets/images/slider2.webp" class="d-block w-100" alt="..."> </button>
      <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" class="thumbnail" aria-label="Slide 3"> <img src="assets/images/slider3.webp" class="d-block w-100" alt="..."> </button> -->
    </div>
    <div class="carousel-inner">
      @if(count($models)>0)
       <?php $j=0;?>
      @foreach($models as $model)
      <div class="carousel-item {{ $j === 0 ? 'active' : '' }}"> <img src="{{asset($model['banner_image'])}}" class="d-block w-100 slideImg" alt="...">
        <div class="carousel-caption d-none d-md-block ">
          <h1 class="animated fadeInUp">{{ $model->model_id }}</h1>
          <h5 class="animated fadeInUp col-lg-6">{{ $model->banner_text }}</h5>
          <p class="animated fadeInUp">From INR {{ number_format($model->price) }}</p>
          <span class="banrCTA" class="animated fadeInUp"> <a href="{{ route('detail', ['slug' => $model['slug']]) }}"  class="btn">Explore {{ $model->model_id }}</a> <a href="" data-bs-toggle="modal" data-id="{{ $model['id'] }}" data-name="{{ $model['model_id'] }}" id="enquiryButton" data-bs-target="#staticBackdrop" class="btn">Enquiry <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
          <path d="M12.5 6L13.055 5.4955L13.5136 6L13.055 6.5045L12.5 6ZM1.13636 6.75C0.72215 6.75 0.386364 6.41421 0.386364 6C0.386364 5.58579 0.72215 5.25 1.13636 5.25L1.13636 6.75ZM8.5095 0.495495L13.055 5.4955L11.945 6.5045L7.39959 1.5045L8.5095 0.495495ZM13.055 6.5045L8.5095 11.5045L7.39959 10.4955L11.945 5.4955L13.055 6.5045ZM12.5 6.75L1.13636 6.75L1.13636 5.25L12.5 5.25L12.5 6.75Z" fill="white"/>
          </svg></a> <a href="{{ asset($model->brochure) }}" class="lineDownload" download> Download Brochure <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M8 10L7.29289 10.7071L8 11.4142L8.70711 10.7071L8 10ZM9 1C9 0.447715 8.55229 2.42698e-07 8 2.18557e-07C7.44772 1.94416e-07 7 0.447715 7 1L9 1ZM2.29289 5.70711L7.29289 10.7071L8.70711 9.29289L3.70711 4.29289L2.29289 5.70711ZM8.70711 10.7071L13.7071 5.70711L12.2929 4.29289L7.29289 9.29289L8.70711 10.7071ZM9 10L9 1L7 1L7 10L9 10Z" fill="white"/>
          <path d="M1 12L1 13C1 14.1046 1.89543 15 3 15L13 15C14.1046 15 15 14.1046 15 13V12" stroke="white" stroke-width="2"/>
          </svg></a> </span> </div>
      </div>
      <?php $j++; ?>
      @endforeach
      @endif

    </div>
  </div>
</section>

<!-----slider end------>

<div class="whole-section"> 
  
  <!-----contact us start------>
  
  <section class="homecontact_section"  >
    <div class="container-fluid">
      <div class="row d-flex">
        <div class="col-lg-6"> <img class="w-100 lexusimgLeft" src="{{asset('assets/images/lexus-left-image.webp')}}"/> </div>
        <div class="col-lg-6">
          <div class="lexusContact" data-aos="fade-up" data-aos-duration="2500">
            <div class="addressTitle">We are in Kochi, Visit Us</div>
            <div class="address col-lg-4"> <span>{{$home_content->title}}</span>{{$home_content->address}}</div>
            <div class="contact"> <a href="">{{$home_content->phone_number}}</a></div>
            <div class="email"> <a href="">{{$home_content->email}}</a></div>
            <div class="socialMediaSection"> <span>Join us on</span>
              <div class="socialMediaBlock">
                <div class="socialMedia"> <a href="{{$home_content->facebook}}"> <img src="{{asset('assets/images/Facebook.svg')}}" /> <span>Facebook</span> </a> </div>
                <div class="socialMedia"> <a href="{{$home_content->instagram}}"> <img src="{{asset('assets/images/Instagram.svg')}}" /> <span>Instagram</span> </a> </div>
                <div class="socialMedia"> <a href="{{$home_content->youtube}}"> <img src="{{asset('assets/images/Youtube.svg')}}" /> <span>Youtube</span> </a> </div>
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
  // Get the enquiry button and modal
  const enquiryButton = document.getElementById('enquiryButton');
  const vehicleModelInput = document.getElementById('vehicle_model');
  const modelIdInput = document.getElementById('model_id_enquiry');
  
  // Add event listener for when the modal is about to show
  enquiryButton.addEventListener('click', function() {
    const modelId = enquiryButton.getAttribute('data-id'); // Get the model_id from the button's data-id attribute
    const modelName = enquiryButton.getAttribute('data-name');
    vehicleModelInput.value = modelName;
    modelIdInput.value = modelId; // Set the model_id to the hidden input in the modal
  });
</script>
<!-- <script>
  $(document).ready(function() {
  // If validation errors exist, open the modal
  @if ($errors->any())
    $('#staticBackdrop').modal('show');
  @endif
});
</script> -->
</html>
