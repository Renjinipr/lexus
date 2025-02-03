@extends('_layouts.default')
@section('meta_title')
   {{  "Model Management" }}
@stop
@section('head-assets')
    <!----daterangepicker---->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link href="{{asset('vendors/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<style>
.pagination {
  /*display: inline-block;*/
}
.pagination button {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}
.pagination button.active {
  color: 000;
  background-color: red;
  background-image: linear-gradient(to right, red , #ffb100);
}
.pagination button:hover:not(.active) {background-color: #ffef01;}
.btn-height-a
{height: 36px;}
.search-form-a .input-group-addon 
{ padding: 6px 8px; }
.total_count_div_class{ font-size: 14px; font-weight: 300; padding: 7px 0;}
.table td, .table th, label{    white-space: nowrap;}
 
</style>
@parent
@endsection
@section('content-area')
                <div class="x_panel p-4"> 
                    @include('_partials.notifications') 
                    <div class="x_content transaction">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">                              
                                  <div class="col-sm-6 d-flex align-items-center text-center"> 
                                    <h3>Model Management</h3>
                                  </div> 
                                  <div class="col-sm-6 d-flex align-items-center"> 
                                    <ul class="nav navbar-right panel_toolbox table-menu-sec">
                                      <li>
                                        <form id="formFilterSearch" method="post" action="{{url('/')}}">
                                          <div class="input-group">
                                            <input type="text" id="search" name="search" class="form-control searchbox" placeholder="Search.." aria-label="Search..">
                                            <input type="hidden" id="checkb" name="checkb" class="form-control" value="">
                                            <div class="input-group-append">
                                              <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                          </div>
                                          {{ csrf_field() }}
                                        </form>
                                      </li>
                                      @if(Auth::guard('admin')->user()->type==2)

                                      @else
                                      <li>
                                        <a href="{{ route($route.'.create') }}" class="btn btn-primary border-0 new-page-btn"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; New</a>
                                      </li>
                                      @endif
                                      <!-- <li>
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                          <i class="fa fa-cog"></i>
                                        </button>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
                                      </li>
                                      <li class="dropdown">
                                        <a href="#" class="dropdown-toggle exp-button btn btn-primary" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bars"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <button id="export_csv" type="button" class="dropdown-item">Export</button>
                                        </div>
                                      </li> -->
                                    </ul>
                                  </div>
                                </div>
                                <!-- toggle -->
                                <!-- <div class="collapse filter_collapse" id="collapseExample">
                                  <div class="card card-body mt-3 filter_card">
                                    <h3 class="mt-0 pt-0 pb-1">Search</h3>
                                    <form id="formFilterNew" method="post" action="{{url('/')}}">
                                      <div class="row">
                                       
                                      <div class="col-md-3 mb-2"> 
                                          <label for="fullname">Contact Number</label>
                                          {!! Form::text('contact_number', null, array('class'=>'form-control required', 'id'=>'contact_number','placeholder'=>'')) !!}
                                        </div>
                                        <div class="col-md-3 mb-2"> 
                                          <label for="fullname">Order ID</label>
                                          <input type="text"  class="form-control" id="search_order_id" name="search_order_id" value="" maxlength="20">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                          <div class="w-100 justify-content-end">
                                            <button type="submit" id="submit" class="btn btn-statu btn-primary border-0 mr-1">Search</button>
                                            <input type="reset" name="" onclick="window.location=''" class="btn btn-secondary btn-statu border-0">
                                          </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="per_page_count" id="per_page_count" value="">                                
                                      {{ csrf_field() }}
                                    </form>
                                  </div>
                                </div> -->

                            </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-6">
                                <div id="datatable_filter" class="dataTables_filter">
                                  <label>
                                  <!-- <input type="search" class="form-control input-sm" placeholder="Search..." aria-controls="datatable"> -->
                                  </label>
                                </div>
                              </div>
                            </div>  
                              <!-- <div class="py-1 w-100 border-top border-bottom my-1"></div>   -->
                               <div class="row">
                                <div class="col-md-12">
                                <div class="card-box table-responsive" style="  overflow-x: auto !important;">    
                              <table id="datatable_" data-datatable-ajax-url="{{ route($route.'.index') }}" class="table table-striped dt-responsive nowrap dataTable_" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>S.No</th>
                                    <th>Model Name</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>  

                                </div>
                               </div>
                        
                    </div>
                </div>
             
       

   
              <div class="x_panel"> 
                <div class="row"> 
                  <div  class="col-md-4 align-middle">
                    <div id="total_count_div" class="total_count_div_class"></div>
                  </div>
                  <div class="col-md-4 d-flex justify-content-center">
                    <div id="pagination"  class="pagination"></div>
                  </div>
                  <div  class="col-md-4 px-0 justify-content-end">
                    <div class="float-right">
                      <div class="dataTables_length" id="datatable_length">
                        <label class="d-flex mb-0">
                          <select id="per_page" name="datatable_length" aria-controls="datatable" class="form-control input-sm table-content-select">
                            <option value="100">50 per pages</option>
                            <option value="100">100 per pages</option>
                            <option value="150">150 per pages</option>
                            <option value="200">200 per pages</option>
                            <option value="200">250 per pages</option>
                            <option value="200">300 per pages</option>
                            <option value="200">350 per pages</option>
                            <option value="200">400 per pages</option>
                            <option value="200">450 per pages</option>
                            <option value="200">600 per pages</option>
                            <option value="200">650 per pages</option>
                          </select> 
                          <span class="p-2 arrow-left"> <p class="p-0 m-0" id="page_count_div"></p></span>
                        </label>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
         



@endsection
@section('footer-assets')
<!----daterangepicker---->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

  <script>
//   $(function() {
//     var dateFormat = "dd MM yy",
//       from = $("#from_date")
//         .datepicker({
//           dateFormat: dateFormat, // Set the date format here
//           defaultDate: "+1w",
//           changeMonth: true,
//           numberOfMonths: 1
//         })
//         .on("change", function() {
//           to.datepicker("option", "minDate", getDate(this));
//         }),
//       to = $("#to_date")
//         .datepicker({
//           dateFormat: dateFormat, // Set the date format here
//           defaultDate: "+1w",
//           changeMonth: true,
//           numberOfMonths: 1
//         })
//         .on("change", function() {
//           from.datepicker("option", "maxDate", getDate(this));
//         });

//     function getDate(element) {
//       var date;
//       try {
//         date = $.datepicker.parseDate(dateFormat, element.value);
//       } catch (error) {
//         date = null;
//       }

//       return date;
//     }
//   });
// </script>
  <script type="text/javascript" src="{{asset('vendors/daterangepicker/daterangepicker.js')}}"></script>

  <script type="text/javascript">

  $("#toggle_status").change(function () {
            var check;
            $('input[name^="toggle_status"').prop('checked', $(this).prop("checked"));
            if ($(this).prop('checked')==true){ 
               check=1;

            }else{
              
              check=0;
            }
             $("#checkb").val(check);

      var url_ = '<?php echo url('/');?>';
     $("#per_page_count").val($("#per_page").val());
     $("#per_page").change(function(){
     $("#per_page_count").val($("#per_page").val());
     $('#formFilterNew').submit();
      });
     $("#per_page_count").val($("#per_page").val());
          var perpage = $("#per_page_count").val();
          var perpage = 1;
          var filter = {status:status}
          var page_number = 1;
     $('#datatable_ tbody').html('<tr><th colspan="16">Loading <i class="fa fa-spinner fa-spin"></i></th></tr>');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
            url:"{{url('/')}}/admin/model_management/model_list",
              data:{_token:"{{csrf_token()}}",filter:filter,page_number:page_number},
              dataType:'json',
              type:'post', 
              success:function(data){
                if(data)
                { $('#datatable_ tbody').html('');
                  if(data.total_count > 0)
                  {
                      var j=1;
                      for(var i=0;i<data.count;i++)
                      {
                        var url_ = '<?php echo url('/');?>';
                        var slno = j+data.offset;
                        var str = '<tr>';
                   
                        str += '<td>'+slno+'</td><td>'+data.result[i].model_no+'</td><td>'+data.result[i].created_on+'</td><td><a href="' +url_+'/admin/model_management/'+data.result[i].id + '/edit'+'" class="" title="Edit"><img src="{{asset('img/edit.svg')}}" alt="Edit Icon" height="25"></a>'+'<a href="' +url_+'/admin/model_management/'+data.result[i].id + '/upload'+'" class="" title="Upload"><img src="{{asset('img/upload.svg')}}" alt="Upload Icon" height="25"></a>'+'<a href="' +url_+'/admin/variants/'+data.result[i].id + '/index'+'" class="" title="Variants"><img src="{{asset('img/variants.svg')}}" alt="Features Icon" height="25"></a>'+'<a href="' +url_+'/admin/features/'+data.result[i].id + '/index'+'" class="" title="Features"><img src="{{asset('img/fev.svg')}}" alt="Features Icon" height="25"></a>'; 
                        if(data.user_type != 2) {
                            str += '<a href="#" class="connector_delete" title="Delete"><img src="{{asset('img/delete.svg')}}" alt="Delete Icon" height="25"  onclick="model_delete('+data.result[i].id+')"></a>';
                        }
                        str +='</td></tr>';
                        $('#datatable_ tbody').append(str);
                        j++;
                      }
                      var pagination = '';
                      if(data.total_count > 0)
                      {
                        if(data.current_page > 1)
                        {
                          var previous_page = data.current_page - 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+1+'">First</button><button type="button" class="paginate_btn btn" data-page_number="'+previous_page+'">Prev</button>';
                        }
                        pagination = pagination+'<button type="button" class="active btn" >'+data.current_page+'</button>';
                        if(data.current_page < data.total_pages)
                        {
                          var next_page = parseInt(data.current_page) + 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+next_page+'">Next</button><button type="button" class="paginate_btn btn" data-page_number="'+data.total_pages+'">Last</button>';
                        }
                      }

                      $('.pagination').html(pagination);
                      $("#page_count_div").html(data.current_page+" - "+data.total_pages);
                      $("#total_count_div").html(" Total Records: "+data.count);

            
                  }
                  else
                  {
                    $('#datatable_ tbody').html('<tr><th colspan="16">No Data Available</th></tr>');
                  }
                }
                else
                {
                 

                  $('#datatable_ tbody').html('<tr><th colspan="16">Something went wrong! Please try again.</th></tr>');
                  
                  
                }
              }
            }).fail(function(jqXHR, textStatus, error){
  
        
    });
        });

  </script>
<script type="text/javascript">
   $(document).ready(function(){

    $('#from_date').datepicker({ 
  dateFormat: "dd MM yy",
  changeYear: true // Enable year dropdown
});

$('#to_date').datepicker({ 
  dateFormat: "dd MM yy",
  maxDate: 0,
  changeYear: true // Enable year dropdown
});

     var url_ = '<?php echo url('/');?>';
     $("#per_page_count").val($("#per_page").val());
     $("#per_page").change(function(){
     $("#per_page_count").val($("#per_page").val());
     $('#formFilterNew').submit();
      });
     $("#per_page_count").val($("#per_page").val());
          var perpage = $("#per_page_count").val();
          var status = 1;
          var status_ =$("#status_").val();
          var name = $('#name').val();
          var modal_number = $('#modal_number').val();
          var contact_number = $('#contact_number').val();
          var category_id = $('#category_id').val();
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();

          var search_executive_user_id = $('#search_executive_user_id').val();
          var search_assigned_user_id = $('#search_assigned_user_id').val();
          var search_warranty_status = $('#search_warranty_status').val();
          var search_screenshot_status = $('#search_screenshot_status').val();
          var search_order_id = $('#search_order_id').val();


          var filter = {per_page_count:perpage,name:name,modal_number:modal_number,contact_number:contact_number,category_id:category_id,status:status,from_date:from_date,to_date:to_date,search_executive_user_id:search_executive_user_id,search_assigned_user_id:search_assigned_user_id,search_warranty_status:search_warranty_status,search_screenshot_status:search_screenshot_status,search_order_id:search_order_id}
          var page_number = 1;
     $('#datatable_ tbody').html('<tr><th colspan="16">Loading <i class="fa fa-spinner fa-spin"></i></th></tr>');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          $.ajax({
            url:"{{url('/')}}/admin/model_management/model_list",
              data:{_token:"{{csrf_token()}}",filter:filter,page_number:page_number},
              dataType:'json',
              type:'post', 
              success:function(data){
                if(data)
                { $('#datatable_ tbody').html('');
                  if(data.total_count > 0)
                  {
                      var j=1;
                      for(var i=0;i<data.count;i++)
                      {
                        var url_ = '<?php echo url('/');?>';
                        var slno = j+data.offset;
                        var str = '<tr>';
                        str += '<td>'+slno+'</td><td>'+data.result[i].model_no+'</td><td>'+data.result[i].created_on+'</td><td><a href="' +url_+'/admin/model_management/'+data.result[i].id + '/edit'+'" class="" title="Edit"><img src="{{asset('img/edit.svg')}}" alt="Edit Icon" height="25"></a>'+'<a href="' +url_+'/admin/model_management/'+data.result[i].id + '/upload'+'" class="" title="Upload"><img src="{{asset('img/upload.svg')}}" alt="Upload Icon" height="25"></a>'+'<a href="' +url_+'/admin/variants/'+data.result[i].id + '/index'+'" class="" title="Variants"><img src="{{asset('img/variants.svg')}}" alt="Features Icon" height="25"></a>'+'<a href="' +url_+'/admin/features/'+data.result[i].id + '/index'+'" class="" title="Features"><img src="{{asset('img/fev.svg')}}" alt="Features Icon" height="25"></a>';
                        if(data.user_type != 2) {
                            str += '<a href="#" class="connector_delete" title="Delete"><img src="{{asset('img/delete.svg')}}" alt="Delete Icon" height="25"  onclick="model_delete('+data.result[i].id+')"></a>';
                        }
                        str +='</td></tr>';

                             


                      
                        $('#datatable_ tbody').append(str);
                        j++;
                      }
                      var pagination = '';
                      if(data.total_count > 0)
                      {
                        if(data.current_page > 1)
                        {
                          var previous_page = data.current_page - 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+1+'">First</button><button type="button" class="paginate_btn btn" data-page_number="'+previous_page+'">Prev</button>';
                        }
                        pagination = pagination+'<button type="button" class="active btn" >'+data.current_page+'</button>';
                        if(data.current_page < data.total_pages)
                        {
                          var next_page = parseInt(data.current_page) + 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+next_page+'">Next</button><button type="button" class="paginate_btn btn" data-page_number="'+data.total_pages+'">Last</button>';
                        }
                      }

                      $('.pagination').html(pagination);
                      // $("#page_count_div").html(data.current_page+" of "+data.total_pages+" Pages");
                                            $("#page_count_div").html(data.current_page+" - "+data.total_pages);

                      $("#total_count_div").html(" Total Records: "+data.count);

            
                  }
                  else
                  {
                    $('#datatable_ tbody').html('<tr><th colspan="16">No Data Available</th></tr>');
                  }
                }
                else
                {
                 

                  $('#datatable_ tbody').html('<tr><th colspan="16">Something went wrong! Please try again.</th></tr>');
                  
                  
                }
              }
            }).fail(function(jqXHR, textStatus, error){
  
        
    });

 $('#formFilterSearch').submit(function(event){
   event.preventDefault();
          $("#per_page_count").val($("#per_page").val());
          var perpage = $("#per_page_count").val();
          var search = $('#search').val();
          var status_ =$("#status_").val();
          var filter = {per_page_count:perpage,search:search}
          var page_number = 1;
           $('#datatable_ tbody').html('<tr><th colspan="16">Loading <i class="fa fa-spinner fa-spin"></i></th></tr>');

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            url:"{{url('/')}}/admin/model_management/model_list",
              data:{_token:"{{csrf_token()}}",filter:filter,page_number:page_number},
              dataType:'json',
              type:'post', 
              success:function(data){
                if(data)
                { $('#datatable_ tbody').html('');
                  if(data.total_count > 0)
                  {
                      var j=1;
                      for(var i=0;i<data.count;i++)
                      {
                       
                        var url_ = '<?php echo url('/');?>';
                        var slno = j+data.offset;
                        var str = '<tr>';
                        str += '<td>'+slno+'</td><td>'+data.result[i].model_no+'</td><td>'+data.result[i].created_on+'</td><td><a href="' +url_+'/admin/model_management/'+data.result[i].id + '/edit'+'" class="" title="Edit"><img src="{{asset('img/edit.svg')}}" alt="Edit Icon" height="25"></a>'+'<a href="' +url_+'/admin/model_management/'+data.result[i].id + '/upload'+'" class="" title="Upload"><img src="{{asset('img/upload.svg')}}" alt="Upload Icon" height="25"></a>'+'<a href="' +url_+'/admin/variants/'+data.result[i].id + '/index'+'" class="" title="Variants"><img src="{{asset('img/variants.svg')}}" alt="Features Icon" height="25"></a>'+'<a href="' +url_+'/admin/features/'+data.result[i].id + '/index'+'" class="" title="Features"><img src="{{asset('img/fev.svg')}}" alt="Features Icon" height="25"></a>';
                        if(data.user_type != 2) {
                            str += '<a href="#" class="connector_delete" title="Delete"><img src="{{asset('img/delete.svg')}}" alt="Delete Icon" height="25"  onclick="model_delete('+data.result[i].id+')"></a>';
                        }
                        str +='</td></tr>';
                        $('#datatable_ tbody').append(str);
                        j++;
                      }

                      var pagination = '';
                      if(data.total_count > 0)
                      {
                        if(data.current_page > 1)
                        {
                          var previous_page = data.current_page - 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+1+'">First</button><button type="button" class="paginate_btn btn" data-page_number="'+previous_page+'">Prev</button>';
                        }
                        pagination = pagination+'<button type="button" class="active btn" >'+data.current_page+'</button>';
                        if(data.current_page < data.total_pages)
                        {
                          var next_page = parseInt(data.current_page) + 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+next_page+'">Next</button><button type="button" class="paginate_btn btn" data-page_number="'+data.total_pages+'">Last</button>';
                        }
                      }
                      $('.pagination').html(pagination);
                      // $("#page_count_div").html(data.current_page+" of "+data.total_pages+" Pages");
                      $("#page_count_div").html(data.current_page+" - "+data.total_pages);
                      $("#total_count_div").html(" Total Records: "+data.count);
                  }
                  else
                  {
                    $('#datatable_ tbody').html('<tr><th colspan="16">No Data Available</th></tr>');
                  }
                }
                else
                {
                 

                  $('#datatable_ tbody').html('<tr><th colspan="16">Something went wrong! Please try again.</th></tr>');
                  
                  
                }
              }
            }).fail(function(jqXHR, textStatus, error){
  
        
    });


 

 });
       $('#formFilterNew').submit(function(event){

          event.preventDefault();
          $("#per_page_count").val($("#per_page").val());
          var perpage = $("#per_page_count").val();
          var search_val = $('#search').val();
          var name = $('#name').val();
          var modal_number = $('#modal_number').val();
          var contact_number = $('#contact_number').val();
          var category_id = $('#category_id').val();
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          var search_executive_user_id = $('#search_executive_user_id').val();
          var search_assigned_user_id = $('#search_assigned_user_id').val();
          var search_warranty_status = $('#search_warranty_status').val();
          var search_screenshot_status = $('#search_screenshot_status').val();
          var search_order_id = $('#search_order_id').val();


          var filter = {per_page_count:perpage,search_val:search_val,name:name,modal_number:modal_number,contact_number:contact_number,category_id:category_id,from_date:from_date,to_date:to_date,search_executive_user_id:search_executive_user_id,search_assigned_user_id:search_assigned_user_id,search_warranty_status:search_warranty_status,search_screenshot_status:search_screenshot_status,search_order_id:search_order_id}
          var page_number = 1;
          $('#datatable_ tbody').html('<tr><th colspan="16">Loading <i class="fa fa-spinner fa-spin"></i></th></tr>');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            url:"{{url('/')}}/admin/model_management/model_list",
              data:{_token:"{{csrf_token()}}",filter:filter,page_number:page_number},
              dataType:'json',
              type:'post', 
              success:function(data){
                if(data)
                { 
                  $('#datatable_ tbody').html('');
                  if(data.total_count > 0)
                  {
                      var j=1;
                      for(var i=0;i<data.count;i++)
                      {
                        //alert(data.result[i].id);
                        //$('#datatable_ tr:last').after('<tr>...</tr>');
                       
                        var url_ = '<?php echo url('/');?>';

                        var slno = j+data.offset;
                        
                        var str = '<tr>';
                       
                        str += '<td>'+slno+'</td><td>'+data.result[i].model_no+'</td><td>'+data.result[i].created_on+'</td><td><a href="' +url_+'/admin/model_management/'+data.result[i].id + '/edit'+'" class="" title="Edit"><img src="{{asset('img/edit.svg')}}" alt="Edit Icon" height="25"></a>'+'<a href="' +url_+'/admin/model_management/'+data.result[i].id + '/upload'+'" class="" title="Upload"><img src="{{asset('img/upload.svg')}}" alt="Upload Icon" height="25"></a>'+'<a href="' +url_+'/admin/variants/'+data.result[i].id + '/index'+'" class="" title="Variants"><img src="{{asset('img/variants.svg')}}" alt="Features Icon" height="25"></a>'+'<a href="' +url_+'/admin/features/'+data.result[i].id + '/index'+'" class="" title="Features"><img src="{{asset('img/fev.svg')}}" alt="Features Icon" height="25"></a>';
                        if(data.user_type != 2) {
                            str += '<a href="#" class="connector_delete" title="Delete"><img src="{{asset('img/delete.svg')}}" alt="Delete Icon" height="25"  onclick="model_delete('+data.result[i].id+')"></a>';
                        }
                        str +='</td></tr>';
                        
                       
                        $('#datatable_ tbody').append(str);
                        j++;
                      }

                      var pagination = '';
                      if(data.total_count > 0)
                      {
                        //pagination = pagination+'<tr><th>';
                        if(data.current_page > 1)
                        {
                          var previous_page = data.current_page - 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+1+'">First</button><button type="button" class="paginate_btn btn" data-page_number="'+previous_page+'">Prev</button>';
                        }
                        pagination = pagination+'<button type="button" class="active btn" >'+data.current_page+'</button>';
                        if(data.current_page < data.total_pages)
                        {
                          var next_page = parseInt(data.current_page) + 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+next_page+'">Next</button><button type="button" class="paginate_btn btn" data-page_number="'+data.total_pages+'">Last</button>';
                        }
                      }

                      //pagination = pagination+'</th></tr>';

                      $('.pagination').html(pagination);
                      // $("#page_count_div").html(data.current_page+" of "+data.total_pages+" Pages");
                      $("#page_count_div").html(data.current_page+" - "+data.total_pages);
                      $("#total_count_div").html(" Total Records: "+data.count);

            
                  }
                  else
                  {
                    $('#datatable_ tbody').html('<tr><th colspan="16">No Data Available</th></tr>');
                  }
                }
                else
                {
                 

                  $('#datatable_ tbody').html('<tr><th colspan="16">Something went wrong! Please try again.</th></tr>');
                  
                  
                }
              }
            }).fail(function(jqXHR, textStatus, error){
  
        
    });

  });
});
</script>
 <script type="text/javascript">
   $('.pagination').on('click','button.paginate_btn',function(){
      $('.pagination').html('');
      $('.page_count_div').html('');
      $('.total_count_div').html('');
      $('#datatable_ tbody').empty();

          var perpage = $("#per_page_count").val();
          var search_val =$("#search").val();
          var name = $('#name').val();
          var modal_number = $('#modal_number').val();
          var contact_number = $('#contact_number').val();
          var category_id = $('#category_id').val();
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          var search_executive_user_id = $('#search_executive_user_id').val();
          var search_assigned_user_id = $('#search_assigned_user_id').val();
          var search_warranty_status = $('#search_warranty_status').val();
          var search_screenshot_status = $('#search_screenshot_status').val();
          var search_order_id = $('#search_order_id').val();

          var filter = {per_page_count:perpage,search_val:search_val,name:name,modal_number:modal_number,contact_number:contact_number,category_id:category_id,from_date:from_date,to_date:to_date,search_executive_user_id:search_executive_user_id,search_assigned_user_id:search_assigned_user_id,search_warranty_status:search_warranty_status,search_screenshot_status:search_screenshot_status,search_order_id:search_order_id}
       
      var page_number = $(this).data("page_number");

      $('#datatable_ tbody').html('<tr><th colspan="16">Loading <i class="fa fa-spinner fa-spin"></i></th></tr>');

      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

       $.ajax({
        url:"{{url('/')}}/admin/model_management/model_list",
              data:{_token:"{{csrf_token()}}",filter:filter,page_number:page_number},
              dataType:'json',
              type:'post', 
              success:function(data){
                if(data)
                { $('#datatable_ tbody').html('');
                  if(data.total_count > 0)
                  {
                      var j=1;
                      for(var i=0;i<data.count;i++)
                      {
                        //alert(data.result[i].id);
                        //$('#datatable_ tr:last').after('<tr>...</tr>');
                       
                        var url_ = '<?php echo url('/');?>';

                        var slno = j+data.offset;
                        
                       var str = '<tr>';
                       
                      str += '<td>'+slno+'</td><td>'+data.result[i].model_no+'</td><td>'+data.result[i].created_on+'</td><td><a href="' +url_+'/admin/model_management/'+data.result[i].id + '/edit'+'" class="" title="Edit"><img src="{{asset('img/edit.svg')}}" alt="Edit Icon" height="25"></a>'+'<a href="' +url_+'/admin/model_management/'+data.result[i].id + '/upload'+'" class="" title="Upload"><img src="{{asset('img/upload.svg')}}" alt="Upload Icon" height="25"></a>'+'<a href="' +url_+'/admin/variants/'+data.result[i].id + '/index'+'" class="" title="Variants"><img src="{{asset('img/variants.svg')}}" alt="Features Icon" height="25"></a>'+'<a href="' +url_+'/admin/features/'+data.result[i].id + '/index'+'" class="" title="Features"><img src="{{asset('img/fev.svg')}}" alt="Features Icon" height="25"></a>';                            
                      if(data.user_type != 2) {
                          str += '<a href="#" class="connector_delete" title="Delete"><img src="{{asset('img/delete.svg')}}" alt="Delete Icon" height="25"  onclick="model_delete('+data.result[i].id+')"></a>';
                      }
                      str +='</td></tr>';
                       
                        $('#datatable_ tbody').append(str);
                        j++;
                      }

                      var pagination = '';
                      if(data.total_count > 0)
                      {
                        //pagination = pagination+'<tr><th>';
                        if(data.current_page > 1)
                        {
                          var previous_page = data.current_page - 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+1+'">First</button><button type="button" class="paginate_btn btn" data-page_number="'+previous_page+'">Prev</button>';
                        }
                        pagination = pagination+'<button type="button" class="active btn" >'+data.current_page+'</button>';
                        if(data.current_page < data.total_pages)
                        {
                          var next_page = parseInt(data.current_page) + 1;
                          pagination = pagination+'<button type="button" class="paginate_btn btn" data-page_number="'+next_page+'">Next</button><button type="button" class="paginate_btn btn" data-page_number="'+data.total_pages+'">Last</button>';
                        }
                      }

                      //pagination = pagination+'</th></tr>';

                      $('.pagination').html(pagination);
                      // $("#page_count_div").html(data.current_page+" of "+data.total_pages+" Pages");
                      $("#page_count_div").html(data.current_page+" - "+data.total_pages);
                      $("#total_count_div").html(" Total Records: "+data.count);
                  }
                  else
                  {
                    $('#datatable_ tbody').html('<tr><th colspan="16">No Data Available</th></tr>');
                  }
                }
                else
                {
                  $('#datatable_ tbody').html('<tr><th colspan="16">Something went wrong! Please try again.</th></tr>');
                }
              }
            }).fail(function(jqXHR, textStatus, error){
  
        
    });

             });
</script>
<script type="text/javascript">
    var baseurl = $('#baseurl').val();

         $("#export_csv").click(function(){
          var contact_number = $('#contact_number').val();
          var warranty_period_from = $('#from_date').val();
          var warranty_period_to = $('#to_date').val();
          var search_executive_user_id = $('#search_executive_user_id').val();
          var search_assigned_user_id = $('#search_assigned_user_id').val();
          var search_warranty_status = $('#search_warranty_status').val();
          var search_screenshot_status = $('#search_screenshot_status').val();
          var search_order_id = $('#search_order_id').val();


          var search = $('#search').val();
            setTimeout(function() {
              $('#export_csv').attr('disabled',false);
            },5000); 
            window.location.href =  '{{url('/')}}/admin/extended_warranty_export?contact_number='+contact_number+'&warranty_period_from='+warranty_period_from+'&warranty_period_to='+warranty_period_to+'&search='+search+'&search_executive_user_id='+search_executive_user_id+'&search_assigned_user_id='+search_assigned_user_id+'&search_warranty_status='+search_warranty_status+'&search_screenshot_status='+search_screenshot_status+'&search_order_id='+search_order_id; 
        });
</script>
<script src="{{asset('js/popper.min.js')}}"></script>

<script src="{{asset('js/boot4alert.js')}}"></script>
 <script type="text/javascript">

function model_delete(id) {
    Swal.fire({
        title: 'WARNING',
        text: 'Are you sure to delete selected? Associated data will be removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'model_delete?id=' + id;
        }
    });
}


function generate_pdf(id){
    var warranty_user_id =id;
    window.location.href =  '{{url('/')}}/admin/extended_warranty_pdf?warranty_user_id='+warranty_user_id;
      
}
</script>

  @parent 


@endsection 
