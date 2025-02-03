
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
    <div class="modal-content w-75 mx-auto">
      <div class="modal-header d-flex justify-content-center">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <img id="modalImage" src="" alt="Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="">
  <!------>
    <div class="x_panel p-4">
    <div class="x_title">
        @if($obj->id)
        <h3>Edit Variants <span style="font-size : 0.8em;">{{ session('model_name') }}</span></h3>
        @else
        <h3>Add New Variant <span style="font-size : 0.8em;">{{ session('model_name') }}</span></h3>
        @endif
   
                

    </div>
    <div class="x_content">
    @if($obj->id)
    @section('meta_title')
    {{  "Edit Variants" }}
    @stop
    {!! Form::model($obj, array('method' => 'put', 'url' => route($route.'.update', $obj->id), 'files' => true, 'role' => 'form','id'=>'edit_activity')) !!}
    @else
    @section('meta_title')
    {{  "Add New Variants" }}
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
            <label class="form-label">Title <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="title" name="title" value="{{$obj->title}}"  oninput="validateInput(event)"  maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="title_error">{{ $errors->first('title') }}</span>               
          </div>
          <div class="col-md-3 col-lg-3 mb-3">
            <label class="form-label">Sub Title <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="sub_title" name="sub_title" value="{{$obj->sub_title}}" maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="sub_title_error">{{ $errors->first('sub_title') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Price: <span class="madatory">*</span></label>
            {!! Form::text('price', old('price'), array('class'=>'form-control', 'id'=>'price','placeholder'=>'')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="price_error">{{ $errors->first('price') }}</span>               
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

          @if($obj->image)
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Variant Image<span class="madatory">*</span></label>
            <div id="attachments">
            <a href="#" id="imageIcon"  data-toggle="modal" data-target="#imageModal" class="text-decoration-none text-body d-flex align-items-center">
                <img src="{{asset('img/imgicon.svg')}}" alt="Image Icon" width="50" height="50">
                <p class="mb-0">Click here to view image</p>
              </a>
   
              <a href="#" class="close remove-file" title="Remove" data-file-type="variant" data-file-id="{{ $obj->id }}" aria-label="Close" style="position: absolute; top: 3px; right: -14px; text-decoration: none; font-size: 30px; background: none; border: none; outline: none; opacity:100%;">
                <img src="{{ asset('img/close-button.png') }}" alt="Close" style="width: 20px; height: 20px;">
              </a>
            </div>
            <span class="text-danger error" style="color:#e03b3b" id="attachments_error">{{ $errors->first('attachments') }}</span>
          </div>
          @else
            <div class="col-md-6 mb-3">
              <label class="form-label">Upload Variant Image <span style="font-size:12px" class="text-muted">(An 500*200 image would be recommended. Allowed file formats: webp,png, jpeg,jpg.)</span></label>
              <!-- <span class="form-text text-muted">(Allowed file formats: png, jpeg, pdf. Max file size: 2MB.)</span> -->
              <input type="file"  class="" id="variant_image" name="variant_image" accept=".png,.jpeg,.jpg,.webp">
              <span  class="text-danger error" style="color:#e03b3b" id="variant_image_error">{{ $errors->first('variant_image') }}</span> 
            </div>
          @endif
          <div class="col-md-6 col-lg-4 mb-3">
    <label class="form-label">Specification<span class="mandatory"></span></label>
    @php
        $lastKey = count($specifications) - 1; // Calculate the last key
    @endphp
    @foreach($specifications as $key => $specification)
        @php
            $specs = explode('|', $specification);
        @endphp
        <div id="dynamic_field{{$key}}">
            <div class="form-row row col-md-12 align-items-center mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="specification" name="specification[]" placeholder="Specification" value="{{ $specs[0] }}" maxlength="150">
                </div>
                <span class="text-danger error" style="color:#e03b3b" id="specification_error">{{ $errors->first('specification') }}</span> 
                <div class="col-md-4">
                    <input type="text" class="form-control" id="specific_value" name="specific_value[]" value="{{ $specs[1] }}" placeholder="Value" maxlength="150">
                </div>
                <span class="text-danger error" style="color:#e03b3b" id="specific_value_error">{{ $errors->first('specific_value') }}</span> 
                @if ($key === 0) <!-- Add button only for the last row -->
                    <div class="col-md-1">
                        <button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
      </div>
    </div>  
  </div>  
</div>

<?php
$variant_image_url=url($obj->image);
?>

@else

<div class="col-lg-12 mt-1">
  <div class="card position-relative new-con-label">
    <div class="row  p-2">
      <div class="col-lg-12 form_page">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Title <span class="madatory">*</span></label>
            {{ Form::text('title', old('title'), array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'', 'maxlength'=>'150')) }}
            <span  class="text-danger error" style="color:#e03b3b" id="title_error">{{ $errors->first('title') }}</span>               
          </div>
          <div class="col-md-3 col-lg-3 mb-3">
            <label class="form-label">Sub Title <span class="madatory">*</span></label>
            {{ Form::text('sub_title', old('sub_title'), array('class'=>'form-control', 'id'=>'sub_title', 'placeholder'=>'', 'maxlength'=>'150')) }}
            <span  class="text-danger error" style="color:#e03b3b" id="sub_title_error">{{ $errors->first('sub_title') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
                <label class="form-label">Price <span class="madatory">*</span></label>
                {!! Form::text('price', old('price'), array('class'=>'form-control', 'id'=>'price','placeholder'=>'')) !!} 
                <span  class="text-danger error" style="color:#e03b3b" id="description_error">{{ $errors->first('description') }}</span>
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
            <label class="form-label">Variant Image<span style="font-size:12px" class="text-muted">(An 500*200 image would be recommended. Allowed file formats: webp,png, jpeg,jpg.)</span></label>
            <!-- <span class="form-text text-muted">(Allowed file formats: png, jpeg, jpg, webp)</span> -->
            <input type="file"  class="" id="variant_image" name="variant_image" accept=".png,.jpeg,.jpg">
            <span  class="text-danger error" style="color:#e03b3b" id="variant_image_error">{{ $errors->first('variant_image') }}</span> 
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Add Specification<span class="madatory"></span></label>
            <div id="dynamic_field2">
              <div class="form-row  row col-md-12">
                <div class="col-md-4">
                    <input type="text"  class="form-control" id="specification" name="specification[]" placeholder="Specification" value=""    maxlength="150">
                </div>
                <span  class="text-danger error" style="color:#e03b3b" id="specification_error">{{ $errors->first('specification') }}</span> 
                <div class="col-md-4">
                    <input type="text"  class="form-control" id="specific_value" name="specific_value[]" value="" placeholder="Value"    maxlength="150">
                </div>
                <span  class="text-danger error" style="color:#e03b3b" id="specific_value_error">{{ $errors->first('specific_value') }}</span> 
                <div class="col-md-1">
                    <td><button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>  
</div>
@endif
<div class="scroll-sec w-100" id="add_connector_sec" >  </div>    
</div>

<!-- Old -->
<!-- <input type="hidden" name="model_id" id="model_id" value="{{$obj->id}}">
<div class="col-lg-12 mt-1 highlight">
  <div class="">
    <div class="row">
      <div class="col-lg-12 form_page">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Title <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="title" name="title" value=""    maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="title_error">{{ $errors->first('title') }}</span>               
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Sub Title <span class="madatory">*</span></label>
            <input type="text"  class="form-control" id="sub_title" name="sub_title" value=""   maxlength="150">
            <span  class="text-danger error" style="color:#e03b3b" id="sub_title_error">{{ $errors->first('sub_title') }}</span>               
          </div>
       
          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Price: <span class="madatory">*</span></label>
            {!! Form::number('price', old('price'), array('class'=>'form-control', 'id'=>'price','placeholder'=>'')) !!} 
            <span  class="text-danger error" style="color:#e03b3b" id="price_error">{{ $errors->first('price') }}</span>               
          </div>
        
  
            <div class="col-md-6 mb-3">
              <label class="form-label">images <span style="font-size:12px" class="text-muted">(Allowed file formats: png, jpeg,jpg. Max file size: 2MB.)</span></label> -->
              <!-- <span class="form-text text-muted">(Allowed file formats: png, jpeg, pdf. Max file size: 2MB.)</span> -->
              <!--<input type="file"  class="" id="banner" name="banner" accept=".png,.jpeg,.jpg">
              <span  class="text-danger error" style="color:#e03b3b" id="banner_error">{{ $errors->first('banner') }}</span> 
            </div>

     
    <div class="col-md-6 col-lg-4 mb-3">
    <label class="form-label">Add Specification<span class="madatory"></span></label>
            
            <div id="dynamic_field2">
              <div class="form-row  row col-md-12">
                <div class="col-md-4">
                   <input type="text"  class="form-control" id="specification" name="specification[]" placeholder="Specification" value=""    maxlength="150">
                  </div>
                  <span  class="text-danger error" style="color:#e03b3b" id="specification_error">{{ $errors->first('specification') }}</span> 

                  <div class="col-md-4">
                   <input type="text"  class="form-control" id="specific_value" name="specific_value[]" value="" placeholder="Value"    maxlength="150">
                  </div>
                  <span  class="text-danger error" style="color:#e03b3b" id="specific_value_error">{{ $errors->first('specific_value') }}</span> 

                <div class="col-md-1">
                    <td><button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                </div>
              </div>
            </div>

  
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

        </div>
      </div>
    </div>  
  </div>  
</div>




<div class="scroll-sec w-100" id="add_connector_sec" >  </div>    
</div> -->

       <div class="row">
            <div class="col-lg-12 text-right">
            <a href="{{ url('/admin/variants/' . session('model_id') . '/index')}}" class="btn  mt-2 btn-secondary">Cancel</a>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
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

 $('#lexusImages').validate({
        rules: {
            'title': {
                required: true,
                maxlength: 150
            },
            'sub_title': {
                required: true,
                maxlength: 150
            },
            'price': {
                required: true,
                number: true
            },
            'banner': {
                extension: "jpg|jpeg|png",
                filesize: 2097152 // 2MB in bytes
            },
            'status': {
                required: true,
                digits: true
            },
            // Dynamic field validation for specification and value
            'specification[]': {
                required: true,
                maxlength: 150
            },
            'specific_value[]': {
                required: true,
                maxlength: 150
            }
        },
        messages: {
            'title': {
                required: "Title is required.",
                maxlength: "Title must not exceed 150 characters."
            },
            'sub_title': {
                required: "Sub Title is required.",
                maxlength: "Sub Title must not exceed 150 characters."
            },
            'price': {
                required: "Price is required.",
                number: "Please enter a valid price."
            },
            'banner': {
                extension: "Only jpg, jpeg, or png files are allowed.",
                filesize: "File size should not exceed 2MB."
            },
            'specification[]': {
                required: "Specification is required.",
                maxlength: "Specification must not exceed 150 characters."
            },
            'specific_value[]': {
                required: "Value is required.",
                maxlength: "Value must not exceed 150 characters."
            },
            'status': {
                required: "Status is required.",
                digits: "Please select a valid status."
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") === "specification[]") {
                error.insertAfter(element.closest('.col-md-4'));
            } else if (element.attr("name") === "specific_value[]") {
                error.insertAfter(element.closest('.col-md-4'));
            } else {
                error.insertAfter(element);
            }
        }
    });


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

var variantImageFile = @json($variant_image_url ?? null);
  if (variantImageFile) {
    $("#imageIcon").attr("href", variantImageFile).show();
  }


  $("#imageIcon").click(function(e) {
    e.preventDefault();
    $("#modalImage").attr("src", $(this).attr("href"));
    $("#imageModal").modal('show');
  });

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
  var lastkey = {{ isset($lastKey) ? $lastKey : 10 }};
  console.log(lastkey);
  if(lastkey == 10) {
  var i = 0;
  lastkey = 2;
  } 
  else {
    var i = lastkey;
  }

  $('#add2').click(function () {
    if (i < 4) {
      i++;
      $(`#dynamic_field${lastkey}`).after(`
        <div class="form-row row col-md-12 mt-3" id="row2${i}">
          <div class="col-md-4">
            <input type="text" class="form-control" name="specification[]" value="" maxlength="150" placeholder="Specification">
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" name="specific_value[]" value="" maxlength="150" placeholder="Value">
          </div>
          <div class="col-md-1">
            <button type="button" name="remove" class="btn btn-danger btn_remove2" id="${i}">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      `);
    }
  });
  $(document).on('click', '.btn_remove2', function () {
    var button_id = $(this).attr("id");
    $('#row2' + button_id + '').remove();
    i--;
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
            url: '/admin/variants/remove-file',
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
@endsection




