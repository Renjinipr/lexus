<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Extended Warranty | Ibell</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

  </head>
  <body>

    <header id="myHeader" class="maintop_head">
      <div class="container">
          <div class="row">
            <div class="col-md-4 shop_logo">    
                <a href="{{url('/')}}" class="logo"> <img src="{{asset('assets/images/newlogo.jpg')}}" alt="Ibell" class="img-responsive"> </a>
            </div>
          
          </div>
      </div>
      <div class="for_shopheadmenu">
          <div class="container">
            <div class="row">
                <div class="col-12">
                  <!-- header start -->
                  <div class="header-classic">
                      <nav class="navbar navbar-expand-lg navbar-classic">
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-classic" aria-controls="navbar-classic" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-classic">
                            <ul class="navbar-nav  mt-2 mt-lg-0 mr-3">
                              <li class="nav-item">
                                  <a class="nav-link" href="{{url('/')}}">Home </a>
                              </li>
                              <li class="nav-item active">
                                  <a class="nav-link active" href="{{url('/extended_warranty')}}">Warranty Registration</a>
                              </li>
                              
                              
                              <li class="nav-item">
                                  <a class="nav-link" href="">Contact Us</a>
                              </li>
                            </ul>
                        </div>
                      </nav>
                      <!-- navigation close -->
                  </div>
                  <!-- header close --> 
                </div>
            </div>
          </div>
      </div>
    </header>
    <section class="main_content landing_main_page">
      <div class="container">
       
        <div class="row">
          <div class="col-md-12 mb-4">

            <div class="position-relative">
              <img src="assets/images/Extended-Warranty-banner.jpg" class="w-100" alt="">
              <!-- <h3>Extended Warranty</h3> -->
              <div class="overlay d-flex align-items-center">
                <div>
                  <h2>Extended Warranty Registration</h2>
                  <p>Extend your warranty to enjoy extra coverage and peace of mind, protecting your purchase from unexpected repair costs and ensuring hassle-free service.</p>
                  <a  href="{{url('/extended_warranty')}}" class="btn btn-primary_warranty mt-3">Register Now</a>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-12 mb-4">

            <div class="position-relative">
              <img src="{{asset('assets/images/request.jpg')}}" class="w-100" alt="">
              <div class="overlay d-flex align-items-center">
                <div>
                  <h2>Service Requests</h2>
                  <p>Submit and manage service requests effortlessly, ensuring quick resolutions and professional support for all your needs.</p>
                  <a href="#" class="btn btn-primary_warranty mt-3">Register Now</a>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <div class="position-relative">
              <img src="{{asset('assets/images/enquiry.jpg')}}" class="w-100" alt="">
              <div class="overlay d-flex align-items-center">
                <div>
                  <h2>Trade Enquiry</h2>
                  <p>Reach out to us for trade enquiries and discover partnership opportunities, tailored solutions, and exclusive deals for your business.</p>
                  <a href="#" class="btn btn-primary_warranty mt-3">Enquire Now</a>
                </div>
              </div>
            </div>

          </div>
          
        </div>

      </div>
    </section>
    <footer class="shop_footer footer mt-auto">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">© <?php echo date('Y');?> Ibelltools. All Rights Reserved.</div>
          <div class="col-sm-4 powerd_">Powered by <a href="https://www.seeroo.com/" target="_blank"><img src="https://warranty.ibelltools.com/images/seeroo_icon.png" style="margin-top:-3px;"> </a></div>
        </div>
      </div>
    </footer>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" ></script>
  </body>
</html>