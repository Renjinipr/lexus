<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
<title>Login</title>

<!-- Bootstrap -->
<link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- NProgress -->
<link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
<!-- Animate.css -->
<link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
<link href="{{asset('build/css/style.css')}}" rel="stylesheet">
</head>

<body class="login" style="background: url(../../production/images/loginn.png) #fff  no-repeat;">

    <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
   
            <section class="login_content "> 
                <!--dons-->
                <div class="login-box">
                    <div class="container">
                        <div class="row justify-content-center  align-items-center">
                            <div class="col-md-4">
                                <div class="user_card m-auto">
                                    @if(!empty($error))
                                        <div class="alert alert-danger alert-dismissible position-absolute login-alert px-2 pt-2 pb-1">
                                            <button type="button" class="close pl-2 pr-2 py-1 m-0" data-dismiss="alert" aria-hidden="true" aria-label="Close">
                                        &times;
                                            </button>
                                            {{$error}}
                                        </div>
                                    @endif
                                    <div class="login-logo w-100 my-2">
                                        <img src="{{asset('assets/images/newlogo.jpg')}}" class="img-fluid" alt="logo">
                                    </div>   
                                    <div class="d-flex justify-content-center form_container">
                                        <form method="post" autocomplete="on">
                                            <div class="input-group mb-1">
                                                <input type="text" name="email" id="email" class="form-control input_user" value="" placeholder="Email address" autocomplete="on">
                                            </div>
                                            <div class="input-group mb-0">
                                                <input type="password" name="password"id="password" class="form-control input_pass" value="" placeholder="password">
                                            </div>
                                            <div class="form-group d-flex text-left">
                                                <div class="custom-control custom-checkbox w-50">
                                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="customControlInline" >
                                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                                </div>
                                                <div class="d-flex justify-content-end links w-50"> 
                                                    <!-- <a href="{{ url('admin/forgot-password') }}" class="forgot_link">Forgot your password?</a>  -->
                                                    </div>
                                                </div>
                                            <div class="clearfix"></div>
                                            <div class="d-flex justify-content-center mt-3 login_container w-100">
                                                <button type="submit" name="button" class="btn login_btn m-0">Login</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!-- <div class="text-center w-100 py-2 px-1 mt-3 cust-support">
                                                <a href="#">Customer Support</a>
                                            </div> -->
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                <!--<div class="mt-4"> </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      
        <!-- <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div> <a class="btn btn-default submit" href="index.html">Submit</a> </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ? <a href="#signin" class="to_register"> Log in </a> </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div> -->
    

 <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
   <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  

</body>
</html>
