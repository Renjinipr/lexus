<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Extended Warranty | Ibell</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Mulish:wght@200;300;400;500;600;700;800;900&family=Rubik:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

  </head>
  <body>
    <header id="myHeader" class="maintop_head">
      <div class="container">
        <div class="row">
          <div class="col-md-4 shop_logo">    
            <a href="{{url('/')}}" class="logo">
              <img src="{{ asset('assets/images/newlogo.jpg') }}" alt="Ibell" class="img-responsive">
            </a>
          </div>
        </div>
      </div>
      <div class="for_shopheadmenu">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="header-classic">
                <nav class="navbar navbar-expand-md navbar-classic">
                  <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-classic" aria-controls="navbar-classic" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar top-bar mt-0"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar-classic">
                    <ul class="navbar-nav mt-2 mt-md-0 mr-3">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link active" href="{{url('extended_warranty')}}">Warranty Registration</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="">Contact Us</a>
                      </li>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main>
      @yield('content-area')
    </main>

    <footer class="shop_footer footer mt-auto">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">© <?php echo date('Y');?> Ibelltools. All Rights Reserved.</div>
          <div class="col-sm-4 powerd_">
            Powered by
            <a href="https://www.seeroo.com/" target="_blank">
              <img src="https://warranty.ibelltools.com/images/seeroo_icon.png" style="margin-top:-3px;">
            </a>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
