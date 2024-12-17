@extends('layouts.default')
@section('content-area')
@section('meta_title')
   
   {{  "Lexus Details" }}

@stop
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox.min.css')}}">

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
              <div id="success-message" class="alert alert-success" style="display: none; color: green;"></div>
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
                  <span  class="text-danger error" style="color:#e03b3b" id="courtesy_title_error">{{ $errors->first('courtesy_title') }}</span> 
                </div>
                {!! Form::hidden('model_id', old('model_id', $model->id), array('class'=>'form-control', 'id'=>'model_id','placeholder'=>'')) !!}
                <div class="row formBlock">
                  <div class="col-lg-12">
                    <label for="exampleFormControlInput1" class="form-label">Name*</label>
                    {!! Form::text('name', old('name'), array('class'=>'form-control', 'id'=>'name','placeholder'=>'')) !!} 
                    <span  class="text-danger error" style="color:#e03b3b" id="name_error">{{ $errors->first('name') }}</span> 
                    </div>
                </div>
                <div class="row formBlock formBlockSelect">
                  <div class="col-lg-12">
                    <label for="exampleFormControlInput1" class="form-label">Mobile Number*</label>
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
                    {!! Form::text('vehicle_model', old('vehicle_model', $model->model_id), array('class'=>'form-control', 'id'=>'vehicle_model','placeholder'=>'')) !!}
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
                    {!! Form::text('city', old('city'), array('class'=>'form-control', 'id'=>'city','placeholder'=>'')) !!} 
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
                  <button type="button" id="submit-enquiry" class="primaryBtn">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-----slider start------>
<section class="slider_section_inner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 ">
        <div class="detailTitle">
          <h2>THE  LEXUS <span class="f_bold">ES</span> SERIES</h2>
          <a class="line_btn" href="" data-bs-toggle="modal" onclick=appendModel() data-name="{{ $model['model_id'] }}" data-bs-target="#staticBackdrop">Enquiry <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
          <path d="M12.5 6L13.055 5.4955L13.5136 6L13.055 6.5045L12.5 6ZM1.13636 6.75C0.72215 6.75 0.386364 6.41421 0.386364 6C0.386364 5.58579 0.72215 5.25 1.13636 5.25L1.13636 6.75ZM8.5095 0.495495L13.055 5.4955L11.945 6.5045L7.39959 1.5045L8.5095 0.495495ZM13.055 6.5045L8.5095 11.5045L7.39959 10.4955L11.945 5.4955L13.055 6.5045ZM12.5 6.75L1.13636 6.75L1.13636 5.25L12.5 5.25L12.5 6.75Z" fill="white"/>
          </svg></a> </div>
      </div>
      <div class="col-lg-12 ">
        <div id="carouselInner" class="carousel slide" data-bs-ride="carousel">
         
          <div class="carousel-inner">
             @if(count($bannerImagesArray)>0)
          @foreach ($bannerImagesArray as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"> <img src="{{asset($banner)}}" class="d-block w-100" alt="..."> </div>
              @endforeach
          @endif
          </div>
        
          
          <div class="carousel-indicators">
            @if(count($bannerImagesArray)>0)
          @foreach ($bannerImagesArray as $indx => $banner)
            <button type="button" data-bs-target="#carouselInner" data-bs-slide-to="{{$indx}}" class="{{ $indx === 0 ? 'active' : '' }}"  {{ $indx === 0 ? 'aria-current="true"' : '' }}    aria-label="Slide {{$indx}}"> </button>
               @endforeach
          @endif
          </div>
     
        </div>
      </div>
      <div class="col-lg-12 detailContent"  data-aos="fade-up" data-aos-duration="2500">
        <p> The ES 300h exquisite pairs a 2.5-liter direct injection engine with a powerful, self-charging electric motor to deliver 214 horsepower with maximum fuel efficiency. </p>
        <a class="line_btn" href="{{ asset($model->brochure) }}" download>Download Brochure <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
        <path d="M8 10L7.29289 10.7071L8 11.4142L8.70711 10.7071L8 10ZM9 1C9 0.447715 8.55229 2.42698e-07 8 2.18557e-07C7.44772 1.94416e-07 7 0.447715 7 1L9 1ZM2.29289 5.70711L7.29289 10.7071L8.70711 9.29289L3.70711 4.29289L2.29289 5.70711ZM8.70711 10.7071L13.7071 5.70711L12.2929 4.29289L7.29289 9.29289L8.70711 10.7071ZM9 10L9 1L7 1L7 10L9 10Z" fill="white"/>
        <path d="M1 12L1 13C1 14.1046 1.89543 15 3 15L13 15C14.1046 15 15 14.1046 15 13V12" stroke="white" stroke-width="2"/>
        </svg> </a> </div>
    </div>
  </div>
</section>

<!-----slider end------>

<div class="whole-section">
<section class="explorevehicle_section">
<div class="container" data-aos="fade-up" data-aos-duration="2500">
<div class="row">
<div class="col-lg-12 ">
<h2> EXPLORE YOUR ES</h2>
</div>
</div>
</div>
 
    @if(count($variants)>0)
    @foreach($variants as $vari)
<div class="flex_sec pro_flex_sec" data-aos="fade-up" data-aos-duration="2500">
<div class="exploreTitle exploreTitle-lg">
<h3>{{$vari['title']}} <span>{{$vari['sub_title']}}</span></h3>
<div class="priceRight">From  INR {{$vari['price']}}</div>
</div>
<div class="exploreDataSec">
<div class="flex_image_div"> <img class="w-100" src="{{asset($vari['image'])}}"> </div>
<div class="exploreTitle exploreTitle-sm"> <span>{{$vari['sub_title']}}</span>
<div class="priceRight">From  INR {{$vari['price']}}</div>
</div>
<div class="flex_content_div">
<div class="exploreFeatureSec d-flex flex-fill">
<?php  $values = explode(',', $vari['specifications']); ?>
            @if(count($values)>0)
            @foreach($values as $val)
<?php  $newVari=explode('|', $val); ?>
            @if(count($newVari)>0)
<div class="exploreFeature"> <span>{{$newVari[1]}}</span>{{$newVari[0] }}</div>
            @endif
            @endforeach
            @endif
</div>
<div class="exploreCTA"> <a class="line_btn line_btn_dark" href="" onclick=appendModel() data-bs-toggle="modal" data-name="{{ $vari['sub_title'] }}" id="enquiryButton" data-bs-target="#staticBackdrop" class="btn">Enquiry <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
<path d="M12.5 6L13.055 5.4955L13.5136 6L13.055 6.5045L12.5 6ZM1.13636 6.75C0.72215 6.75 0.386364 6.41421 0.386364 6C0.386364 5.58579 0.72215 5.25 1.13636 5.25L1.13636 6.75ZM8.5095 0.495495L13.055 5.4955L11.945 6.5045L7.39959 1.5045L8.5095 0.495495ZM13.055 6.5045L8.5095 11.5045L7.39959 10.4955L11.945 5.4955L13.055 6.5045ZM12.5 6.75L1.13636 6.75L1.13636 5.25L12.5 5.25L12.5 6.75Z" fill="white"/>
</svg></a> </div>
</div>
</div>
</div>
    @endforeach
    @endif
</section>
  
  <!-----gallery with scroll start------>
  
  <section class="gallery_section sec_padding" data-aos="fade-up" data-aos-duration="2500">
<div class="container-fluid">
<div class="row">
<div class="col-12 text-center">
<h2 class="text-white">Gallery</h2>
</div>
<div class="col-12">
<ul class="nav nav-pills mb-3 tabHead" id="pills-tab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-exterior-tab" data-bs-toggle="pill" data-bs-target="#pills-exterior" type="button" role="tab" aria-controls="pills-exterior" aria-selected="false">Exterior</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pills-interior-tab" data-bs-toggle="pill" data-bs-target="#pills-interior" type="button" role="tab" aria-controls="pills-interior" aria-selected="false">Interior</button>
</li>
</ul>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
<div class="custom-nav ms-auto">
<button class="owl-prev"> <img src="{{asset('assets/images/details/arrowLeft.svg')}}"/> </button>
<button class="owl-next"> <img src="{{asset('assets/images/details/arrowRight.svg')}}"/> </button>
</div>
<div class="owl-carousel gallery_carousel owl-theme">
                @if(count($gallery_all)>0)
                @foreach($gallery_all as $all)
<div class="item">
<div class="gallery_block">
<div class="gallery_blockinner"> <a href="{{asset($all['image_url'])}}" data-fancybox="images" data-caption="My caption"> <img src="{{asset($all['image_url'])}}"/> </a> </div>
</div>
</div>
                @endforeach
                @endif

</div>
</div>
<div class="tab-pane fade" id="pills-exterior" role="tabpanel" aria-labelledby="pills-exterior-tab" tabindex="0">
<div class="custom-nav ms-auto">
<button class="owl-prev"> <img src="{{asset('assets/images/details/arrowLeft.svg')}}"/> </button>
<button class="owl-next"> <img src="{{asset('assets/images/details/arrowRight.svg')}}"/> </button>
</div>
<div class="owl-carousel gallery_carousel owl-theme">
               @if(count($gallery_ex)>0)
                @foreach($gallery_ex as $ex)
<div class="item">
<div class="gallery_block">
<div class="gallery_blockinner"> <a href="{{asset($ex['image_url'])}}" data-fancybox="images" data-caption="My caption"> <img src="{{asset($ex['image_url'])}}"/> </a> </div>
</div>
</div>
                @endforeach
                @endif
</div>
</div>
<div class="tab-pane fade" id="pills-interior" role="tabpanel" aria-labelledby="pills-interior-tab" tabindex="0">
<div class="custom-nav ms-auto">
<button class="owl-prev"> <img src="{{asset('assets/images/details/arrowLeft.svg')}}"/> </button>
<button class="owl-next"> <img src="{{asset('assets/images/details/arrowRight.svg')}}"/> </button>
</div>
<div class="owl-carousel gallery_carousel owl-theme">
               @if(count($gallery_in)>0)
                @foreach($gallery_in as $in)
<div class="item">
<div class="gallery_block">
<div class="gallery_blockinner"> <a href="{{asset($in['image_url'])}}" data-fancybox="images" data-caption="My caption"> <img src="{{asset($in['image_url'])}}"/> </a> </div>
</div>
</div>
                @endforeach
                @endif
</div>
</div>
</div>
</div>
</div>
</div>
</section>
  
  <!-----gallery with scroll ends------> 
  
  <!-----features accordion start------>
  
  <section class="features_section " data-aos="fade-up" data-aos-duration="2500">
<div class="container">
<div class="row">
<div class="col-12">
<h2>ES Features</h2>
</div>
<div class="col-12">
<div class="accordion featureAccordion" id="accordionExample">
 
            @if(count($features)>0)
            @foreach ($features as $indexs => $feature)
<div class="accordion-item  {{ $indexs === 0 ? 'featureAccordion' : '' }}" >
<h2 class="accordion-header">
<button class="accordion-button  {{ $indexs === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$indexs}}" aria-expanded="{{ $indexs === 0 ? 'true' : 'false' }}" aria-controls="collapse{{$indexs}}"> {{$feature['title']}} </button>
</h2>
<div id="collapse{{$indexs}}" class="accordion-collapse collapse {{ $indexs === 0 ? 'show' : '' }}" data-bs-parent="#accordionExample">
<div class="accordion-body">
<div class="d-flex align-items-center">
<div class="flex-shrink-0"> <img src="{{asset($feature['image_url'])}}" alt="..."> </div>
<div class="flex-grow-1 ms-3">
<p>{{$feature['description']}}</p>
</div>
</div>
</div>
</div>
</div>
            @endforeach
            @endif

</div>
</div>
</div>
</div>
</section>
  
  <!-----features accordion ends------> 
  
  <!-----contact us start------>

  @endsection

  <script>
  function appendModel() {
  const carouselInner = document.querySelector('.carousel-inner');
  
    if (event.target.id === 'enquiryButton') {
        const enquiryButton = event.target;
        const modelName = enquiryButton.getAttribute('data-name');
        const vehicleModelInput = document.getElementById('vehicle_model');
        vehicleModelInput.value = modelName;
    }

  }

</script>

@section('footer-assets')

  @parent
<script>
var myCarousel = document.querySelector('#carouselInner')
var carousel = new bootstrap.Carousel(carouselInner, {
  interval: 3000,
  pause: false 
})
</script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>

@endsection