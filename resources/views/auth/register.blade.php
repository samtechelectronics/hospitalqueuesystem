<!DOCTYPE html>
<html>

<!-- Mirrored from webapplayers.com/luna_admin-v1.3/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Sep 2017 14:10:26 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>Register</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="/homecss/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/homecss/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="/homecss/vendor/bootstrap/css/bootstrap.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="/homecss/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="/homecss/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="/homecss/styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="/homecss/styles/style.css">
</head>
<body class="blank">

<!-- Wrapper-->
<div class="wrapper">


    <!-- Main content-->
    <section class="content">
        

        <div class="container-center lg animated slideInDown">


            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-add-user"></i>
                </div>
                <div class="header-title">
                    <h3>Register</h3>
                    <small>
                        Please enter your data to register.
                    </small>

                      @if(session()->has('message'))
                              <h3 class="alert alert-success">{{session()->get('message')}}</h3>
                            @endif
                             @if(count($errors)>0)
                            <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                              <p>{{$error}}</p>
                              @endforeach
                              @endif
              </header>

                </div>
            </div>

            <div class="panel panel-filled">
                <div class="panel-body">
                    <p>

                    </p>
            
                           <form  method="POST" action="{{ route('register') }}" id="loginForm" novalidate>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>name</label>
                                <input  type="text" placeholder="Name" name="username" value="{{ old('name') }}" required autofocus   class="form-control" required="">
                               
                            </div>
                             <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" requiredrequired id="email" class="form-control">
                                
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Password</label>
                                <input  id="password" class="form-control" type="password"  placeholder=""  name="password" placeholder="password" required >
                                <span class="help-block small" >secured password</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Repeat Password</label>
                                <input id="repeatpassword" class="form-control" type="password" placeholder="" name="password_confirmation" required>
                                <span class="help-block small" placeholder= "password" >Please repeat your pasword</span>
                            </div>
                           
                        </div>
                        <div>
                            <button class="btn btn-accent" type="submit">Register</button>
                            <a class="btn btn-default" href="/applogin">Login</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="/homecss/vendor/pacejs/pace.min.js"></script>
<script src="/homecss/vendor/jquery/dist/jquery.min.js"></script>
<script src="/homecss/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- App scripts -->
<script src="/homecss/scripts/luna.js"></script>

</body>


<!-- Mirrored from webapplayers.com/luna_admin-v1.3/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Sep 2017 14:10:26 GMT -->
</html>