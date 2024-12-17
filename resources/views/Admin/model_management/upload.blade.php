@extends('_layouts.default')
@section('content-area')
<!-- 
<link rel="stylesheet" href="{{ asset('css/bootstrapver-5.min.css') }}"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/> -->
<section class="form_page">
<div class="container">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-8">   
            @if(session('success')) 
                <div class="success_message">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path d="M15 1.875C18.481 1.875 21.8194 3.25781 24.2808 5.71922C26.7422 8.18064 28.125 11.519 28.125 15C28.125 18.481 26.7422 21.8194 24.2808 24.2808C21.8194 26.7422 18.481 28.125 15 28.125C11.519 28.125 8.18064 26.7422 5.71922 24.2808C3.25781 21.8194 1.875 18.481 1.875 15C1.875 11.519 3.25781 8.18064 5.71922 5.71922C8.18064 3.25781 11.519 1.875 15 1.875ZM13.365 17.5894L10.4494 14.6719C10.3449 14.5674 10.2208 14.4844 10.0842 14.4279C9.94763 14.3713 9.80126 14.3422 9.65344 14.3422C9.50562 14.3422 9.35925 14.3713 9.22268 14.4279C9.08611 14.4844 8.96202 14.5674 8.8575 14.6719C8.6464 14.883 8.52781 15.1693 8.52781 15.4678C8.52781 15.7663 8.6464 16.0527 8.8575 16.2637L12.57 19.9763C12.6742 20.0813 12.7982 20.1647 12.9348 20.2216C13.0714 20.2785 13.218 20.3078 13.3659 20.3078C13.5139 20.3078 13.6604 20.2785 13.797 20.2216C13.9337 20.1647 14.0576 20.0813 14.1619 19.9763L21.8494 12.2869C21.9553 12.1828 22.0396 12.0588 22.0973 11.9219C22.1551 11.7851 22.1851 11.6382 22.1858 11.4897C22.1865 11.3412 22.1578 11.194 22.1013 11.0567C22.0449 10.9193 21.9618 10.7945 21.8568 10.6895C21.7519 10.5844 21.6271 10.5011 21.4899 10.4445C21.3526 10.3879 21.2054 10.359 21.0569 10.3595C20.9084 10.36 20.7615 10.3899 20.6246 10.4475C20.4877 10.5051 20.3636 10.5892 20.2594 10.695L13.365 17.5894Z" fill="white"/>
                    </svg>
                    <h3> {{ session('success') }}</h3>
                </div>
            @endif
            <div class="form-container">
                <div class="subtitle_">
                    <h2>Upload The Model Images</h2>
                </div>

               
                
                {!! Form::open(array('url' => url("admin/model_management/upload/store"), 'files' => true, 'role' => 'form', 'method'=>'post', 'enctype'=>"multipart/form-data", 'id' => 'lexusImages')) !!}


                <div class="row">
                    <div class="col-md-6" id="ds" > 
                    <input type="hidden" name="model_id" value="{{ $id }}">  
                        <div class="form-group">
                            {!! Form::label('bannerImage', 'Upload Banner Images:', array('id'=>'banner_image')) !!}
                                <div class="border-doted position-relative file-Upload_field">
                                {!! Form::file('bannerImage[]', array('id'=>'bannerImage', 'class'=>'form-control' , 'data-field'=>'bannerImage', 'onchange'=>"displayThumbnails(event, 'bannerImage')", 'multiple'=>'multiple')) !!}
                                <div class="d-flex align-items-center p-3">
                                    <div class="text-center upload_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 15.75C12.4142 15.75 12.75 15.4142 12.75 15V4.02744L14.4306 5.98809C14.7001 6.30259 15.1736 6.33901 15.4881 6.06944C15.8026 5.79988 15.839 5.3264 15.5694 5.01191L12.5694 1.51191C12.427 1.34567 12.2189 1.25 12 1.25C11.7811 1.25 11.573 1.34567 11.4306 1.51191L8.43056 5.01191C8.16099 5.3264 8.19741 5.79988 8.51191 6.06944C8.8264 6.33901 9.29988 6.30259 9.56944 5.98809L11.25 4.02744V15C11.25 15.4142 11.5858 15.75 12 15.75Z" fill="#0AB058"/>
                                        <path d="M16 9C15.2978 9 14.9467 9 14.6945 9.16851C14.5853 9.24148 14.4915 9.33525 14.4186 9.44446C14.25 9.69667 14.25 10.0478 14.25 10.75V15C14.25 16.2426 13.2427 17.25 12 17.25C10.7574 17.25 9.75004 16.2426 9.75004 15V10.75C9.75004 10.0478 9.75004 9.69664 9.58149 9.4444C9.50854 9.33523 9.41481 9.2415 9.30564 9.16855C9.05341 9 8.70227 9 8 9C5.17157 9 3.75736 9 2.87868 9.87868C2 10.7574 2 12.1714 2 14.9998V15.9998C2 18.8282 2 20.2424 2.87868 21.1211C3.75736 21.9998 5.17157 21.9998 8 21.9998H16C18.8284 21.9998 20.2426 21.9998 21.1213 21.1211C22 20.2424 22 18.8282 22 15.9998V14.9998C22 12.1714 22 10.7574 21.1213 9.87868C20.2426 9 18.8284 9 16 9Z" fill="#C2C2C2"/>
                                        </svg>
                                    </div>
                                    <div class="w-75">     
                                        <label for="attachment">Click to Upload</label>       
                                        <!-- <span>Upload upto 1 file</span>  -->
                                    </div>
                                </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('gallery_image', 'Upload Gallery Images:') !!}
                            <div class="border-doted position-relative file-Upload_field">
                                {!! Form::file('galleryImage[]', array('id'=>'galleryImage', 'class'=>'form-control' , 'data-field'=>'galleryImage', 'multiple'=>'multiple', 'onchange'=>"displayThumbnails(event, 'galleryImage')")) !!}
                                <div class="d-flex align-items-center p-3">
                                    <div class="text-center upload_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 15.75C12.4142 15.75 12.75 15.4142 12.75 15V4.02744L14.4306 5.98809C14.7001 6.30259 15.1736 6.33901 15.4881 6.06944C15.8026 5.79988 15.839 5.3264 15.5694 5.01191L12.5694 1.51191C12.427 1.34567 12.2189 1.25 12 1.25C11.7811 1.25 11.573 1.34567 11.4306 1.51191L8.43056 5.01191C8.16099 5.3264 8.19741 5.79988 8.51191 6.06944C8.8264 6.33901 9.29988 6.30259 9.56944 5.98809L11.25 4.02744V15C11.25 15.4142 11.5858 15.75 12 15.75Z" fill="#0AB058"/>
                                        <path d="M16 9C15.2978 9 14.9467 9 14.6945 9.16851C14.5853 9.24148 14.4915 9.33525 14.4186 9.44446C14.25 9.69667 14.25 10.0478 14.25 10.75V15C14.25 16.2426 13.2427 17.25 12 17.25C10.7574 17.25 9.75004 16.2426 9.75004 15V10.75C9.75004 10.0478 9.75004 9.69664 9.58149 9.4444C9.50854 9.33523 9.41481 9.2415 9.30564 9.16855C9.05341 9 8.70227 9 8 9C5.17157 9 3.75736 9 2.87868 9.87868C2 10.7574 2 12.1714 2 14.9998V15.9998C2 18.8282 2 20.2424 2.87868 21.1211C3.75736 21.9998 5.17157 21.9998 8 21.9998H16C18.8284 21.9998 20.2426 21.9998 21.1213 21.1211C22 20.2424 22 18.8282 22 15.9998V14.9998C22 12.1714 22 10.7574 21.1213 9.87868C20.2426 9 18.8284 9 16 9Z" fill="#C2C2C2"/>
                                        </svg>
                                    </div>
                                    <div class="w-75">     
                                        <label for="attachment">Click to Upload</label>       
                                        <!-- <span>Upload upto 1 file</span>  -->
                                    </div>
                                </div>
                            </div>                         
                            <div class="galleryImage_error error" style="display: none;"></div>
                            @if($errors->has('galleryImage'))
                                <div class="alert alert-danger">{{ $errors->first('galleryImage') }}</div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('feature_image', 'Upload Feature Image:') !!}
                            <div class="border-doted position-relative file-Upload_field">
                                {!! Form::file('featureImage[]', array('id'=>'featureImage', 'class'=>'form-control', 'data-field'=>'featureImage', 'onchange'=>"displayThumbnails(event, 'featureImage')")) !!}
                                <div class="d-flex align-items-center p-3">
                                    <div class="text-center upload_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 15.75C12.4142 15.75 12.75 15.4142 12.75 15V4.02744L14.4306 5.98809C14.7001 6.30259 15.1736 6.33901 15.4881 6.06944C15.8026 5.79988 15.839 5.3264 15.5694 5.01191L12.5694 1.51191C12.427 1.34567 12.2189 1.25 12 1.25C11.7811 1.25 11.573 1.34567 11.4306 1.51191L8.43056 5.01191C8.16099 5.3264 8.19741 5.79988 8.51191 6.06944C8.8264 6.33901 9.29988 6.30259 9.56944 5.98809L11.25 4.02744V15C11.25 15.4142 11.5858 15.75 12 15.75Z" fill="#0AB058"/>
                                            <path d="M16 9C15.2978 9 14.9467 9 14.6945 9.16851C14.5853 9.24148 14.4915 9.33525 14.4186 9.44446C14.25 9.69667 14.25 10.0478 14.25 10.75V15C14.25 16.2426 13.2427 17.25 12 17.25C10.7574 17.25 9.75004 16.2426 9.75004 15V10.75C9.75004 10.0478 9.75004 9.69664 9.58149 9.4444C9.50854 9.33523 9.41481 9.2415 9.30564 9.16855C9.05341 9 8.70227 9 8 9C5.17157 9 3.75736 9 2.87868 9.87868C2 10.7574 2 12.1714 2 14.9998V15.9998C2 18.8282 2 20.2424 2.87868 21.1211C3.75736 21.9998 5.17157 21.9998 8 21.9998H16C18.8284 21.9998 20.2426 21.9998 21.1213 21.1211C22 20.2424 22 18.8282 22 15.9998V14.9998C22 12.1714 22 10.7574 21.1213 9.87868C20.2426 9 18.8284 9 16 9Z" fill="#C2C2C2"/>
                                        </svg>
                                    </div>
                                    <div class="w-75">     
                                        <label for="attachment">Click to Upload</label>       
                                    </div>
                                </div>
                            </div>                            
                            <div class="featureImage_error error" style="display: none;"></div>
                                @if($errors->has('featureImage'))
                                    <div class="alert alert-danger">{{ $errors->first('featureImage') }}</div>
                                @endif
                            <div id="featureImageThumbnailPlaceholder" class="thumbnail d-flex flex-wrap"></div>
                        </div>
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
                    <div class="col-md-6">
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
<!-- Modal
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="success_message">
            <svg width="65px" height="65px" viewBox="-15.36 -15.36 542.72 542.72" xmlns="http://www.w3.org/2000/svg" fill="#037537" stroke="#037537"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.024"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:none;stroke:#037537;stroke-linecap:round;stroke-linejoin:round;stroke-width:36.352;}</style> </defs> <g data-name="Layer 2" id="Layer_2"> <g data-name="E408, Success, Media, media player, multimedia" id="E408_Success_Media_media_player_multimedia"> <circle class="cls-1" cx="256" cy="256" r="246"></circle> <polyline class="cls-1" points="115.54 268.77 200.67 353.9 396.46 158.1"></polyline> </g> </g> </g></svg>
            <h3>Data uploaded successfully</h3>
      
            <button type="button" class="btn-submit " data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div> -->
<script>
    var currentField = null;

    // function displayThumbnails(event, fieldName) {
    //     var input = event.target;

    //     // Clear the existing thumbnails
    //     var thumbnailContainer = document.getElementById(fieldName + "ThumbnailPlaceholder");
    //     thumbnailContainer.innerHTML = "";
    //     thumbnailContainer.style.display = "flex";

    //     // Check if any file is selected
    //     if (input.files && input.files.length > 0) {
    //         for (var i = 0; i < input.files.length; i++) {
    //             var container = document.createElement("div");
    //             container.style.width = "180px";
    //             container.style.height = "120px";
    //             container.className = "thumbnail-container";

    //             var file = input.files[i];
    //             var fileType = getFileType(file.name);

    //                 var img = document.createElement("img");
    //                 img.src = URL.createObjectURL(file);
    //                 img.style.width = "90%";
    //                 img.style.height = "90%";
    //                 img.style.objectFit = "cover";
    //                 img.style.borderRadius = "6px";
    //                 container.appendChild(img);

    //             var removeIcon = document.createElement("span");
    //             removeIcon.style.cursor = "pointer";
    //             removeIcon.className = "remove-icon-pic remove-icon" + i;
    //             removeIcon.innerHTML = "&times;";

    //             (function (container) {
    //             removeIcon.addEventListener("click", function () {
    //                 container.remove();
    //             });
    //             })(container);

    //             // container.appendChild(img);
    //             container.appendChild(removeIcon);

    //             thumbnailContainer.appendChild(container);
    //         }
    //     }
    // }

    let selectedFiles = {};

function displayThumbnails(event, inputId) {
    const input = document.getElementById(inputId);
    const files = Array.from(input.files);
    // selectedFiles[inputId] = [];

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

    // Submit the form via AJAX or let it proceed normally
    // Example AJAX submission:
    // event.preventDefault();
    // fetch(this.action, { method: this.method, body: formData })
    //     .then(response => response.json())
    //     .then(data => console.log(data));
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@endsection

@section('footer-assets')
    @parent
@endsection