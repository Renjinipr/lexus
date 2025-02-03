
@extends('_layouts.default')

@section('head-assets')
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

#videoModal .modal-dialog {
    margin: auto;
    width: auto; 
    max-width: 100%;
}

#videoModal .modal-body {
    padding: 12px; 
}
</style>
    @parent


@endsection
@section('content-area')

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<!---------modal------->

<div class="modal fade" id="imageModal_" tabindex="-1" aria-labelledby="imageModalLabel_" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel_">Image Preview</h5>
      </div>
      <div class="modal-body">
        <img id="modalImage_" src="" alt="Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="">
  <!------>
    <div class="x_panel p-4">
    <div class="x_title">
        @if($obj->id)
        <h3>Edit Model</h3>
        @else
        <h3>Add New Model</h3>
        @endif
                

    </div>
    <div class="x_content">
    @if($obj->id)
    @section('meta_title')
    {{  "Edit Model" }}
    @stop
    {!! Form::model($obj, array('method' => 'put', 'url' => route($route.'.update', $obj->id), 'files' => true, 'role' => 'form','id'=>'edit_activity')) !!}
    @else
    @section('meta_title')
    {{  "New Model" }}
    @stop
    {!! Form::open(array('url' => route($route.'.store'), 'files' => true, 'role' => 'form', 'id' =>'add_activity')) !!} 
    @endif
                    
               
<div class="row label-display-block">

@if($obj->id)

<div class="col-lg-12 mt-1 highlight">
  <div class="">
    <div class="row">
      <div class="col-lg-12 form_page">
        <div class="row">
          <input type="hidden" name="warranty_user_id" id="warranty_user_id" value="{{$obj->id}}">
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Model Name <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="model_name" name="model_id" value="{{$obj->model_id}}" maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="model_id_error">{{ $errors->first('model_id') }}</span>               
          </div>
          <div class="col-md-3 col-lg-3 mb-3">
            <label class="form-label">Short Name <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="short_name" name="short_name" value="{{$obj->short_name}}"  oninput="validateAndConvertToUppercase(event)" oninput="validateInput(event)"  maxlength="3">
            <span  class="text-danger error" style="color:#e03b3b" id="short_name_error">{{ $errors->first('short_name') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Description <span class="madatory">*</span></label>
            {!! Form::textarea('description', old('description'), array('class'=>'form-control', 'id'=>'description','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="description_error">{{ $errors->first('description') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Banner Text <span class="madatory">*</span></label>
            {!! Form::textarea('banner_text', old('banner_text'), array('class'=>'form-control', 'id'=>'banner_text','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="banner_text_error">{{ $errors->first('banner_text') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Price: <span class="madatory">*</span></label>
            {!! Form::number('price', old('price'), array('class'=>'form-control', 'id'=>'price','placeholder'=>'')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="price_error">{{ $errors->first('price') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Featured: <span class="madatory">*</span></label>
            {!! Form::checkbox('featured', 1, $obj->featured, array('id'=>'featured','placeholder'=>'')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="featured_error">{{ $errors->first('featured') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Status <span class="madatory">*</span></label>                
            {{ Form::select('status', [
              '1' => 'Active',
              '0' => 'Inactive',
              ],old('status'),['class' => ' form-control','id'=>'status']
            ) }}
            <span  class="text-danger error" style="color:#e03b3b" id="status_error">{{ $errors->first('status') }}</span>               
          </div>

          @if($obj->banner_image)
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Banner Image<span class="madatory">*</span></label>
            <div id="attachments">
              <a href="#" id="imageIcon"  data-toggle="modal" data-target="#imageModal" class="text-decoration-none text-body d-flex align-items-center">
                <img src="{{asset('img/imgicon.svg')}}" alt="Image Icon" width="50" height="50">
                <p class="mb-0">Click here to view image</p>
              </a>
   
              <a href="#" class="close remove-file" title="Remove" data-file-type="banner" data-file-id="{{ $obj->id }}" aria-label="Close" style="position: absolute; top: 3px; right: -14px; text-decoration: none; font-size: 30px; background: none; border: none; outline: none; opacity:100%;">
                <img src="{{ asset('img/close-button.png') }}" alt="Close" style="width: 20px; height: 20px;">
              </a>
            </div>
            <span class="text-danger error" style="color:#e03b3b" id="attachments_error">{{ $errors->first('attachments') }}</span>
          </div>
          @else
            <div class="col-md-6 mb-3">
              <label class="form-label">Upload Banner images <span style="font-size:12px" class="text-muted">(An 1920*1020 resolution image would be recommended. Allowed file formats:.png,.jpeg,.jpg.)</span></label>
              <!-- <span class="form-text text-muted">(Allowed file formats: png, jpeg, pdf. Max file size: 2MB.)</span> -->
              <input type="file"  class="" id="banner" name="banner" accept=".png,.jpeg,.jpg,.webp">
              <span  class="text-danger error" style="color:#e03b3b" id="banner_error">{{ $errors->first('doc_upload') }}</span> 
            </div>

          @endif
          @if($obj->brochure)
            <div class="col-md-6 col-lg-4 mb-3">
              <label class="form-label">Brochure <span class="madatory">*</span></label>
              <div id="attachments">
                <a href="{{url($obj->brochure)}}" id="pdfIcon"  target="_blank">
                  <img src="{{asset('img/file-type-pdf.svg')}}" alt="PDF Icon" width="50" height="50">
                </a>
                <a href="#" class="close remove-file" title="Remove" data-file-type="brochure" data-file-id="{{ $obj->id }}" aria-label="Close" style="position: absolute; top: 3px; right: -14px; text-decoration: none; font-size: 30px; background: none; border: none; outline: none; opacity:100%;">
                  <img src="{{ asset('img/close-button.png') }}" alt="Close" style="width: 20px; height: 20px;">
                </a>
              </div>
              <span class="text-danger error" style="color:#e03b3b" id="attachments_error">{{ $errors->first('attachments') }}</span>
            </div>
          @else
          <div class="col-md-6 mb-3">
            <label class="form-label">Upload Brochure <span style="font-size:12px" class="text-muted">(Allowed file format: .pdf )</span></label>
            <!-- <span class="form-text text-muted">(Allowed file formats: png, jpeg, pdf. Max file size: 2MB.)</span> -->
            <input type="file"  class="" id="brochure" name="brochure" accept=".pdf">
            <span  class="text-danger error" style="color:#e03b3b" id="brochure_error">{{ $errors->first('brochure') }}</span> 
          </div>
          @endif
          

        </div>
      </div>
    </div>  
  </div>  
</div>

<?php  
$banner_image_url=url($obj->banner_image);
?>

@else

<div class="col-lg-12 mt-1">
  <div class="card position-relative new-con-label">
    <div class="row  p-2">
      <div class="col-lg-12 form_page">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Model Name <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="model_id" name="model_id"  maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="model_id_error">{{ $errors->first('model_id') }}</span>               
          </div>
          <div class="col-md-3 col-lg-3 mb-3">
            <label class="form-label">Short Name <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="short_name" name="short_name" value="" oninput="validateAndConvertToUppercase(event)"  oninput="validateInput(event)"  maxlength="3">
            <span  class="text-danger error" style="color:#e03b3b" id="short_name_error">{{ $errors->first('short_name') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Description <span class="madatory">*</span></label>
                    {!! Form::textarea('description', old('description'), array('class'=>'form-control', 'id'=>'description','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="description_error">{{ $errors->first('description') }}</span>               
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Banner Text <span class="madatory">*</span></label>
                    {!! Form::textarea('banner_text', old('banner_text'), array('class'=>'form-control', 'id'=>'banner_text','placeholder'=>'', 'style'=>'height: 85px;')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="banner_text_error">{{ $errors->first('banner_text') }}</span>               
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Price <span class="madatory">*</span></label>
                    {!! Form::number('price', old('price'), array('class'=>'form-control', 'id'=>'price','placeholder'=>'')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="price_error">{{ $errors->first('price') }}</span>               
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Featured? <span class="madatory">*</span></label>
                    {!! Form::checkbox('featured', old('featured'), array('class'=>'form-control', 'id'=>'featured','placeholder'=>'')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="featured_error">{{ $errors->first('featured') }}</span>               
              </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Status <span class="madatory">*</span></label>                
            {{ Form::select('status', [
                      '1' => 'Active',
                      '0' => 'Inactive',
                      ],old('status'),['class' => ' form-control','id'=>'status']
                    ) }}
            <span  class="text-danger error" style="color:#e03b3b" id="status_error">{{ $errors->first('status') }}</span>               
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Upload Banner Images </label>
            <span class="form-text text-muted">(An 1920*1020 resolution image would be recommended. Allowed file formats:.png,.jpeg,.jpg)</span>

            <input type="file"  class="" id="banner_image" name="banner_image" accept=".png,.jpeg,.jpg">
            <span  class="text-danger error" style="color:#e03b3b" id="banner_images_error">{{ $errors->first('banner_images') }}</span> 
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Upload Brochure </label>
            <span class="form-text text-muted">(Allowed file format: pdf)</span>

            <input type="file"  class="" id="brochure" name="brochure" accept=".pdf,.docx">
            <span  class="text-danger error" style="color:#e03b3b" id="brochure_error">{{ $errors->first('brochure') }}</span> 
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
            <a href="{{ url('/admin/model_management/')}}" class="btn  mt-2 btn-secondary">Cancel</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

<script>
$(function() {
  var dateFormat = "dd MM yy",
    from = $("#warranty_period_from")
      .datepicker({
        dateFormat: dateFormat, // Set the date format here
        defaultDate: 0,
        changeMonth: true,
        changeYear: true, // Enable year dropdown
        numberOfMonths: 1
      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
    to = $("#warranty_period_to")
      .datepicker({
        dateFormat: dateFormat, // Set the date format here
        defaultDate: 0,
        changeMonth: true,
        changeYear: true, // Enable year dropdown
        numberOfMonths: 1
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

  function getDate(element) {
    var date;
    try {
      date = $.datepicker.parseDate(dateFormat, element.value);
    } catch (error) {
      date = null;
    }

    return date;
  }
});
</script>
<script type="text/javascript">
$(document).ready(function () {

  var baseurl = $('#baseurl').val();
  $('#date_of_purchase').datepicker({ dateFormat: "dd MM yy"});
  $('#spare_order_date').datepicker({ dateFormat: "dd MM yy"});
  $('#spare_dispatch_date').datepicker({ dateFormat: "dd MM yy"});
  $('#warranty_period').datepicker({
    minDate: 0,
      onSelect: function(dateText, inst){
          $('#warranty_period').datepicker('option', 'minDate', new Date(dateText));
      },
       dateFormat: "dd MM yy"
  });

    $("#export_pdf").click(function(){
    var warranty_user_id =$("#warranty_user_id").val();
    window.location.href =  '{{url('/')}}/admin/extended_warranty_pdf?warranty_user_id='+warranty_user_id;
    });
      
});

var bannerImageFile = @json($banner_image_url ?? null);
  if (bannerImageFile) {
    $("#imageIcon").attr("href", bannerImageFile).show();
  }


  $("#imageIcon").click(function(e) {
    e.preventDefault();
    $("#modalImage").attr("src", $(this).attr("href"));
    $("#imageModal").modal('show');
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
</script>
<script>
  $(document).on('click', '.remove-file', function(e) {
    e.preventDefault();
    var fileType = $(this).data('file-type');
    var fileId = $(this).data('file-id');

    remove_file(fileType, fileId);
});

function remove_file(fileType, fileId){
  Swal.fire({
        title: 'WARNING',
        text: 'Are you sure to remove the selected file? Associated data will be removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: '/admin/remove-file',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                file_type: fileType,
                file_id: fileId
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                  Swal.fire('Error', 'Failed to remove the file. Please try again.', 'error');
                }
            }
        });
      } 
    });
  }
</script>
<script>
  var i =0;
  $('#add2').click(function () {
    if (i < 20) {
                    i++;
                    $('#dynamic_field2').append('<div class="form-row" style = "margin-top: 20px;"  id="row2' + i + '"> <div class="col-11"> {!! Form::textarea('specification[]', old('specification[]'), array('class'=>'form-control', 'id'=>'specification', 'style'=>'height: 65px;')) !!} </div> <div class="col-1"> <td><button type="button" name="add" class="btn btn-danger btn_remove2" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
    }
                  });
                $(document).on('click', '.btn_remove2', function () {
                    var button_id = $(this).attr("id");

                    $('#row2' + button_id + '').remove();
                
                });
</script>
<script>
  $(document).on('click', '.remove-file', function(e) {
    e.preventDefault();
    var fileType = $(this).data('file-type');
    var fileId = $(this).data('file-id');

    remove_file(fileType, fileId);
});

function remove_file(fileType, fileId){
  Swal.fire({
        title: 'WARNING',
        text: 'Are you sure to remove the selected file? Associated data will be removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: '/admin/model_management/remove-file',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                file_type: fileType,
                file_id: fileId
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                  Swal.fire('Error', 'Failed to remove the file. Please try again.', 'error');
                }
            }
        });
      } 
    });
  }


  function validateAndConvertToUppercase(event) {
    const input = event.target;
    input.value = input.value.toUpperCase();
}
</script>
@endsection




