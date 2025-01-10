@extends('layouts.default')
@section('content-area')
@section('meta_title')
   
   {{  "Lexus" }}

@stop

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
                {!! Form::text('phone', old('phone'), array('class'=>'form-control', 'id'=>'phone','placeholder'=>'','maxlength'=>'13')) !!} 
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
                  <!-- <button type="submit enquiry_submit" class="primaryBtn">Submit</button> -->
                  <button type="button" id="submit-enquiry" onclick="submitEnquiry()" class="primaryBtn">Submit</button>
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
          <span class="banrCTA" class="animated fadeInUp"> <a href="{{ route('detail', ['slug' => $model['slug']]) }}"  class="btn">Explore {{ $model->short_name }}</a> <a href="" onclick=appendModel() data-bs-toggle="modal" data-id="{{ $model['id'] }}" data-name="{{ $model['model_id'] }}" id="enquiryButton" data-bs-target="#staticBackdrop" class="btn">Enquiry <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
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


@endsection
