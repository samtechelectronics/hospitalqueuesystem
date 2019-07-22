<!DOCTYPE html>
<html>

<!-- Mirrored from webapplayers.com/luna_admin-v1.3/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Jan 2019 12:34:26 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>Hospital System</title>

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
<body>

          
<div class="wrapper" id="app">

    <!-- Header-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mobile-menu">
                    <div class="left-nav-toggle">
                        <a href="#">
                            <i class="stroke-hamburgermenu"></i>
                        </a>
                    </div>
                </div>
                <a class="navbar-brand" href="index-2.html">
                    HOSPITAL SYSTEM
                    <span>v.1.3</span>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="left-nav-toggle">
                    <a href="#">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
                </div>
               
           
            </div>
        </div>
    </nav>
    <!-- End header-->

    <!-- Navigation-->
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                <li class="nav-category">
                    Main
                </li>
                

                <li id="admin" style="display: none;">
                    <a href="#monitoring" data-toggle="collapse" aria-expanded="false">
                        Front Desk<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="monitoring" class="nav nav-second collapse">
                       <router-link to="/doctors">  <li><a href="metrics.html"> Doctrors</a></li></router-link>
                        <router-link to="/users"> <li><a href="usage.html"> Users</a></li></router-link>
                        <router-link to="/profiles"> <li><a href="activity.html"> Patient Profiles </a></li></router-link>
                        <router-link to="/queue"> <li><a href="activity.html">  Queue </a></li></router-link>
                    </ul>
                </li> 
                  <li class="nav-item">
             <router-link to="/logout">
            <a class="nav-link" href="pages/widgets/widgets.html">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </router-link>
          </li>
              
                
            </ul>
        </nav>
    </aside>
    <!-- End navigation-->


    <!-- Main content-->
    <section class="content">
        <div class="container-fluid">
        
        
            <router-view></router-view>
          
            


        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->

<!-- App scripts -->
<script src="/homecss/scripts/luna.js"></script>  <script src="{{ asset('js/app.js') }}"></script>
<script src="/homecss/vendor/pacejs/pace.min.js"></script>
<script src="/homecss/vendor/jquery/dist/jquery.min.js"></script>
<script src="/homecss/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/homecss/vendor/flot/jquery.flot.min.html"></script>
<script src="/homecss/vendor/flot/jquery.flot.resize.min.js"></script>
<script src="/homecss/vendor/flot/jquery.flot.spline.js"></script>
  
</body>


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-dark/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jan 2019 02:21:39 GMT -->
</html>

