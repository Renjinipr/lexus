@extends('_layouts.default')
@section('head-assets')
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content-area')
<!-- 
<link rel="stylesheet" href="{{ asset('css/bootstrapver-5.min.css') }}"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/> -->
<section class="form_page x_panel p-4">
<div class="container">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-12 px-0">   
            @if(session('success')) 
                <div class="success_message">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path d="M15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875ZM13.365 17.5894L10.4494 14.6719C10.3449 14.5674 10.2208 14.4844 10.0842 14.4279C9.94763 14.3713 9.80126 14.3422 9.65344 14.3422C9.50562 14.3422 9.35925 14.3713 9.22268 14.4279C9.08611 14.4844 8.96202 14.5674 8.8575 14.6719C8.6464 14.883 8.52781 15.1693 8.52781 15.4678C8.52781 15.7663 8.6464 16.0527 8.8575 16.2637L12.57 19.9763C12.6742 20.0813 12.7982 20.1647 12.9348 20.2216C13.0714 20.2785 13.218 20.3078 13.3659 20.3078C13.5139 20.3078 13.6604 20.2785 13.797 20.2216C13.9337 20.1647 14.0576 20.0813 14.1619 19.9763L21.8494 12.2869C21.9553 12.1828 22.0396 12.0588 22.0973 11.9219C22.1551 11.7851 22.1851 11.6382 22.1858 11.4897C22.1865 11.3412 22.1578 11.194 22.1013 11.0567C22.0449 10.9193 21.9618 10.7945 21.8568 10.6895C21.7519 10.5844 21.6271 10.5011 21.4899 10.4445C21.3526 10.3879 21.2054 10.359 21.0569 10.3595C20.9084 10.36 20.7615 10.3899 20.6246 10.4475C20.4877 10.5051 20.3636 10.5892 20.2594 10.695L13.365 17.5894Z" fill="white"/>
                    </svg>
                    <h3> {{ session('success') }}</h3>
                </div>
            @endif
            <div class="form-container">
                <div class="x_title">
                    <h1>Upload The Model Images</h1>
                </div>

               
                
                {!! Form::open(array('url' => url("admin/model_management/upload/store"), 'files' => true, 'role' => 'form', 'method'=>'post', 'enctype'=>"multipart/form-data", 'id' => 'lexusImages')) !!}


                <div class="row">
                    <div class="col-md-6" id="ds" > 
                    <input type="hidden" name="model_id" value="{{ $id }}">  
                        <div class="form-group">
                        <label class="form-label">Upload Banner Images <span style="font-size:12px" class="text-muted">(An 1200*675 image would be recommended. Allowed file formats: png, jpeg,jpg, webp.)</span></label>
                                <div class="border-doted position-relative file-Upload_field">
                                {!! Form::file('bannerImage[]', array('id'=>'bannerImage', 'class'=>'form-control' , 'data-field'=>'bannerImage', 'onchange'=>"displayThumbnails(event, 'bannerImage')", 'multiple'=>'multiple')) !!}
                            </div>
                
                            <div class="bannerImage_error error" style="display: none;"></div>
                            @if($errors->has('bannerImage'))
                                <div class="alert alert-danger">{{ $errors->first('bannerImage') }}</div>
                            @endif
                            <div id="bannerImageThumbnailPlaceholder" class="thumbnail"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="gallery col-lg-12">
                        <h2>Banner images</h2>
                        @foreach($banner_images as $banner)
                            <div class="col-md-6 col-lg-2 mb-3">
                                <div id="attachments">
                                    <img src="{{ asset($banner->banner_image) }}" alt="Banner Image" class="thumbnail" style="width:130px; height:80px;  border-radius:5px;">
                                    <a href="#" class="close remove-file" title="Remove" data-file-type="banner" data-file-id="{{ $banner->id }}" aria-label="Close" style="position: absolute; top: 10px; right: 45px; text-decoration: none; font-size: 30px; background: none; border: none; outline: none; opacity:100%;">
                                        <img src="{{ asset('img/close-button.png') }}" alt="Close" style="width: 20px; height: 20px;">
                                    </a>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label" for="galleryImage">Upload Gallery Images <span style="font-size:12px" class="text-muted">(An 1200*675 image would be recommended. Allowed file formats: png, jpeg,jpg, webp.)</span></label>
                            <div class="border-doted position-relative file-Upload_field">
                                {!! Form::file('galleryImage[]', array('id'=>'galleryImage', 'class'=>'form-control' , 'data-field'=>'galleryImage', 'multiple'=>'multiple', 'onchange'=>"displayThumbnails(event, 'galleryImage')")) !!}
                            </div>                         
                            @if($errors->has('galleryImage'))
                            <span  class="text-danger error" style="color:#e03b3b" id="galleryImage_error">{{ $errors->first('galleryImage') }}</span> 
                            @endif
                            <div id="galleryImageThumbnailPlaceholder" class="thumbnail"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                        {!! Form::label('gallery_type', 'Gallery Type:') !!}               
                            {{ Form::select('gallery_type', [
                                    '1' => 'All',
                                    '2' => 'Exterior',
                                    '3' => 'Interior',
                                    ],old('gallery_type'),['class' => ' form-control','id'=>'gallery_type']
                                    ) }}
                            <span  class="text-danger error" style="color:#e03b3b" id="gallery_type_error">{{ $errors->first('gallery_type') }}</span>               
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="gallery col-lg-12">
                        <h2>Gallery images</h2>
                        @foreach($gallery as $image)
                            <div class="col-md-6 col-lg-2 mb-3">
                                <div id="attachments">
                                    <img src="{{ asset($image->image_url) }}" alt="Gallery Image" class="thumbnail" style="width:128px; height:80px; border-radius:5px;">
                                    <a href="#" class="close remove-file" title="Remove" data-file-type="gallery" data-file-id="{{ $image->id }}" aria-label="Close" style="position: absolute; top: 10px; right: 45px; text-decoration: none; font-size: 30px; background: none; border: none; outline: none; opacity:100%;">
                                        <img src="{{ asset('img/close-button.png') }}" alt="Close" style="width: 20px; height: 20px;">
                                    </a>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>

                <!-- <div class="controls"><p class="help-block">
                    <p style="font-size:13px;"><i>*You can upload up to <strong>5 </strong> files, limited to <strong>.JPG</strong>, <strong>.JPEG</strong>, <strong>.PNG</strong>, <strong>.DOCX</strong> and <strong>.PDF</strong> formats, with a max size of <strong>2MB</strong> per file</i></p>
                </div>  -->
                <div class="fields_error error" style="display: none;"></div>
                @if($errors->has('fields'))
                    <div class="alert alert-danger">{{ $errors->first('fields') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-lg-12 text-right">
                            <a href="{{ url('/admin/model_management/')}}" class="btn  mt-2 btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sumbit btn-primary mt-2 mr-1">Submit</button>
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
</section>
<div class="clearfix"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/boot4alert.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var currentField = null;

    let selectedFiles = {};

function displayThumbnails(event, inputId) {
    const input = document.getElementById(inputId);
    const files = Array.from(input.files);

    if (!selectedFiles[inputId]) {
        selectedFiles[inputId] = [];
    }

    // Add new files to the selectedFiles array, avoiding duplicates
    files.forEach(file => {
        if (!selectedFiles[inputId].some(existingFile => existingFile.name === file.name)) {
            selectedFiles[inputId].push(file);
        }
    });

    // Update the thumbnail display
    const thumbnailPlaceholder = document.getElementById(inputId + "ThumbnailPlaceholder");
    thumbnailPlaceholder.innerHTML = ""; 
    thumbnailPlaceholder.style.display = "flex";

    selectedFiles[inputId].forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.alt = file.name;
            img.style.width ="150px";
            img.style.height = "100px";
            img.style.margin = "5px";
            thumbnailPlaceholder.appendChild(img);
        };
        reader.readAsDataURL(file);
    });

}

// Handle form submission to include all selected files
document.getElementById('lexusImages').addEventListener('submit', function (event) {
    const formData = new FormData(this);

    // Append all selected files
    selectedFiles.forEach(file => {
        formData.append('carImages[]', file);
    });
});

  
    function getFileType(filename) {
        var extension = filename.split('.').pop().toLowerCase();
        if (extension === 'pdf') {
            return 'pdf';
        } else if (extension === 'doc' || extension === 'docx') {
            return 'doc';
        } else {
            return 'image';
        }
    }
  
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
            url: '/admin/model_management/remove-gallery-image',
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

@section('footer-assets')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
    @parent
@endsection