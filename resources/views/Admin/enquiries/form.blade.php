
@extends('_layouts.default')

@section('head-assets')
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<style>
/*side menu style*/
body {
    color: #000;
}
.left_col {
    background-image: linear-gradient(#f30c0b, #ff8f00);
}
.nav_title {
    background: #ffffff40;
}
.nav.side-menu>li.current-page, .nav.side-menu>li.active {
    border-right: 5px solid #2c0505;
}
.nav.side-menu>li.active>a {
    background: #ffffff47;
}
.text-green {
    color: green
}
.main_container .right_col h3 {
    color: #000;
    font-size: 22px
}
.notifi-tab
{ right: 0; top: 13px;}
label.error {
    color: #e03b3b;
}
.close {
    font-size: 20px;
    font-weight: bold;
    color: #e03b3b;
    text-decoration: none;
}

.close:hover {
    color: #c00;
    text-decoration: none;
}
</style>
    @parent


@endsection
@section('content-area')

<div class="">
  <!------>
    <div class="x_panel p-4">
    <div class="x_title">
        @if($obj->id)
        <h3>Edit enquiry</h3>
        @else
        <h3>New enquiry</h3>
        @endif
                

    </div>
    <div class="x_content">
    @if($obj->id)
    @section('meta_title')
    {{  "Edit enquiry" }}
    @stop
    {!! Form::model($obj, array('method' => 'put', 'url' => route($route.'.update', $obj->id), 'files' => true, 'role' => 'form','id'=>'edit_activity')) !!}
    @else
    @section('meta_title')
    {{  "New enquiry" }}
    @stop
    {!! Form::open(array('url' => route($route.'.store'), 'files' => true, 'role' => 'form', 'id' =>'add_activity')) !!} 
    @endif
                    
               
<div class="row label-display-block">
<div class="col-md-12 text-right mb-3">
</div>

@if($obj->id)

<div class="col-lg-12 mt-1 highlight">
<div class="">
<div class="row">
<div class="col-lg-12 form_page">
<div class="row">
              <input type="hidden" name="warranty_user_id" id="warranty_user_id" value="{{$obj->id}}">
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Name <span class="madatory">*</span></label>
                <input type="text"  class="form-control" id="name" name="name" value="{{$obj->name}}"  oninput="validateInput(event)"  maxlength="100">
                <span  class="text-danger error" style="color:#e03b3b" id="name_error">{{ $errors->first('name') }}</span>               
              </div>
              <div class="col-md-6 col-lg-4 mb-3 country_code">
                <label class="form-label">Contact Number <span class="madatory">*</span></label>
                <!-- <input type="text"  class="form-control" id="contact_no" name="contact_no" value="{{$obj->contact_no}}" maxlength="15"> -->
                <div class="form-group d-inline-block form-control">
                    <span class="border-end country-code px-2">+91</span>
                    <input type="text" name="contact_no" class="form-control" id="ec-mobile-number" value="{{$obj->contact_no}}" oninput="validateContactInput(event)" maxlength="12" placeholder="" />
                </div>
               <span  class="text-danger error" style="color:#e03b3b" id="contact_no_error">{{ $errors->first('contact_no') }}</span>               
              </div>
              <!-- <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Email </label>
                <input type="text"  class="form-control" id="email" name="email" value="{{$obj->email}}">
                <span  class="text-danger error" style="color:#e03b3b" id="email_error">{{ $errors->first('email') }}</span>               
              </div> -->
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Model Name <span class="madatory">*</span></label>
                <input type="text"  class="form-control" id="model_name" name="model_name" value="{{$obj->model_name}}">
                <span  class="text-danger error" style="color:#e03b3b" id="model_name_error">{{ $errors->first('model_name') }}</span>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">City <span class="madatory">*</span></label>
                <input type="text"  class="form-control" id="city" name="city" value="{{$obj->city}}"> 
                <span  class="text-danger error" style="color:#e03b3b" id="city_error">{{ $errors->first('city') }}</span>              
              </div>
              <!-- <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Pincode<span class="madatory">*</span></label>
                    {!! Form::number('pincode', old('pincode'), array('class'=>'form-control', 'id'=>'pincode','placeholder'=>'')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="pincode_error">{{ $errors->first('pincode') }}</span>               
              </div> -->
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Status </label>                
                {{ Form::select('status', [
                          '1' => 'Open',
                          '2' => 'Closed',
                          ],old('status'),['class' => ' form-control','id'=>'status']
                        ) }}
                <span  class="text-danger error" style="color:#e03b3b" id="status_error">{{ $errors->first('status') }}</span>               
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Message <span class="madatory">*</span></label>
                    {!! Form::textarea('message', old('message'), array('class'=>'form-control', 'id'=>'message','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="message_error">{{ $errors->first('message') }}</span>               
              </div>
            </div>
</div>
</div>  
</div>  
</div>

@else

<div class="col-lg-12 mt-1">
  <div class="card position-relative new-con-label">
    <div class="row  p-2">
      <div class="col-lg-12 form_page">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Name <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="name" name="name" oninput="validateInput(event)"  maxlength="100">
            <span  class="text-danger error" style="color:#e03b3b" id="name_error">{{ $errors->first('name') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3 country_code">
            <label class="form-label">Contact No. <span class="madatory">*</span></label>
            <!-- <input type="text"  class="form-control" id="contact_no" name="contact_no" maxlength="15"> -->
            <div class="form-group d-inline-block form-control">
                    <span class="border-end country-code px-2">+91</span>
                    <input type="text" name="contact_no" class="form-control" id="ec-mobile-number" value="{{old('contact_no')}}" oninput="validateContactInput(event)" maxlength="12" placeholder="" />
            </div>
            <span  class="text-danger error" style="color:#e03b3b" id="contact_no_error">{{ $errors->first('contact_no') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Model Name<span class="madatory">*</span> </label>
            <input type="text"  class="form-control" id="model_no" name="model_no" maxlength="15">
            <span  class="text-danger error" style="color:#e03b3b" id="model_no_error">{{ $errors->first('model_no') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">E-mail </label>
            <input type="text"  class="form-control" id="email" name="email" maxlength="15">
            <span  class="text-danger error" style="color:#e03b3b" id="email_error">{{ $errors->first('email') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">District<span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="district" name="district" maxlength="10">
            <span  class="text-danger error" style="color:#e03b3b" id="district_error">{{ $errors->first('district') }}</span>
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">PIN Code<span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="pincode" name="pincode" maxlength="20">
            <span  class="text-danger error" style="color:#e03b3b" id="pincode_error">{{ $errors->first('pincode') }}</span>
          </div>
          
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Message<span class="madatory">*</span></label>
              {!! Form::textarea('message', old('message'), array('class'=>'form-control', 'id'=>'message','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="message_error">{{ $errors->first('message') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Status </label>                
                {{ Form::select('status', [
                          '1' => 'Open',
                          '2' => 'Closed',
                          ],old('status'),['class' => ' form-control','id'=>'status']
                        ) }}
                <span  class="text-danger error" style="color:#e03b3b" id="status_error">{{ $errors->first('status') }}</span>               
              </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Remarks</label>
              {!! Form::textarea('remarks', old('remarks'), array('class'=>'form-control', 'id'=>'remarks','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
          </div>
        </div>
      </div>
    </div>  
  </div>  
</div>
@endif
<div class="scroll-sec w-100" id="add_connector_sec" >  </div>    
</div>     

       <div class="row">
            <div class="col-lg-12 text-right">
            <a href="{{ url('/admin/enquiries/')}}" class="btn  mt-2 btn-secondary">Cancel</a>
                    <button type="submit" name="button" id="submitBtn" class="btn btn-primary mt-2 mr-1">Submit</button>
            </div>
        </div>
            {!! Form::close() !!}  
        </div>
    </div>
</div>

    
@endsection
@section('footer-assets')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/boot4alert.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

<script type="text/javascript">
$(document).ready(function () {
       $("#export_pdf").click(function(){
       var warranty_user_id =$("#warranty_user_id").val();
       window.location.href =  '{{url('/')}}/admin/extended_warranty_pdf?warranty_user_id='+warranty_user_id;
        });
      
});


function extended_warranty_delete(id){
    boot4.confirm({
     msg:"Are you sure to delete selected ?  Associated data will be removed.",
     title:"WARNING",
     callback:function(result) {
      if(result){
        window.location.href ='{{url('/')}}/admin/extended_warranty_delete?id='+id;
      }
      else{
      return false;
    }
  }

});     
  }


  function validateInput(event) {
            const input = event.target;
            const value = input.value;
            const regex = /^[a-zA-Z\s]*$/;

            if (!regex.test(value)) {
                input.value = value.replace(/[^a-zA-Z\s]/g, '');
                document.getElementById('name_error').innerText = 'Only alphabetic characters and spaces are allowed.';
            } else {
                document.getElementById('name_error').innerText = '';
            }
        }
        $(document).on('keydown', '.number_value', function (e) {
    // Allow: backspace, delete, tab, escape, enter
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }

    // Check if the character is a special character or a dot
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || e.key == ".") {
        e.preventDefault();
    }
});

function validateContactInput(event) {
    event.target.value = event.target.value.replace(/\D/g, '');
}
</script>
@endsection




