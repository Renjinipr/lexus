<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title')</title>
  @yield('head-assets')
      <!-- <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.svg') }}" /> -->
      <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

   <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{asset('vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <!-- starrr -->
    <link href="{{asset('vendors/starrr/dist/starrr.css')}}" rel="stylesheet">

    <!-- Font icon menu -->
    <link href="{{asset('vendors/menu-icon/style-menuicon.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/css/style.css')}}" rel="stylesheet">
     <link href="{{asset('production/css/bootstrap-dialog.css')}}" rel="stylesheet">
    <style>

      <?php $user_id=Auth::guard('admin')->user()->id;
       
              $menu_bc="#000";
         
              $menu_fc="#E7E7E7";
           
              $heading_bc="#000";
           
              $heading_fc="#000";
            
              $button_bc="#ffffff40";
           
              $button_fc="#000";
            
       ?>
  /*side menu style*/
      body{color: #000;}
      .left_col { background:{{$menu_bc}};} 
      .nav_title { background: #ffffff40;}
      .nav.side-menu>li.current-page, .nav.side-menu>li.active {border-right: 5px solid #2c0505;}
      .nav.side-menu>li.active>a { background: #ffffff47;}
      .text-green{color:green}
      .main_container .right_col h3{color: #000; font-size: 22px}
     /*----button-------*/ 
     .login_btn, .btn-primary, .pagination button.active{ background-color:#000; color: white !important; border-color: #000; background-image:none!important; }
      /*----headding-------*/ 
     .main_container .right_col h3, .table thead td, .table thead th {  color: #000; }
      /*----text-------*/
     .table td, .table th, label{color: #000;}

     .x_title h2 {
      color: {{$heading_fc}};
      }
      .main_container .right_col h3, .table thead td, .table thead th {
     color: {{$heading_fc}};
      }
     /* .table td, .table th, label {
       color: {{$heading_fc}};
      }*/

      .nav.side-menu>li>a, .nav.child_menu>li>a {
     color: {{$menu_fc}};
     font-weight: 300;
     font-size: 14px;
     }
     .menu_section h3 {
     color: {{$menu_fc}};
     }
     .site_title {
    color: {{$menu_fc}} !important;
    }
    .pagination button {
      border: 1px solid #000;
      color: #044c76; 
    }
    .pagination button:hover:not(.active) {
    background-color: #000!important;
    color: #fff;
     }
      
    </style>
     </head>

    @yield('body-content')

   <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{asset('vendors/select2/dist/js/select2.min.js')}}"></script>
    <!-- Bootstrap -->
   <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{asset('vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- morris -->
   <script src="{{asset('vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendors/morris.js/morris.min.js')}}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/custom.min.js')}}"></script>
     <script src="{{asset('production/js/bootstrap-dialog.js')}}"></script>
    <script  type="text/javascript">
   $(function () {   $('#myDatepicker').datetimepicker();  });
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });

    $(document).ready(function() {
    $('.select2').select2();
});
</script>
    <script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
    @yield('footer-assets')
  </body>
</html>

