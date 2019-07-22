
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-dark/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jan 2019 02:26:37 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HMS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/new/vendors/iconfonts/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/new/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/new/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/new/css/vertical-layout-dark/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/new/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script type="text/javascript">
  
  </script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h1 class="alert alert-success">SMART HOSPITAL QUEUE MANAGEMENT SYSTEM</h1> {{-- <img src="/new/logo.png" alt="logo"> --}}
              </div>
              <h6 class="font-weight-light">Sign in to continue.</h6>
               @if(session()->has('message'))
                              <h3 class="alert alert-success">{{session()->get('message')}}</h3>
                            @endif
                             @if(count($errors)>0)
                            <div class="alert alert-danger">
                              @foreach($errors->all() as $error)
                              <p>{{$error}}</p>
                              @endforeach
                              @endif
                 @if(isset($id))
                  
                          <form  method="POST" action="/acount_linking" id="loginForm" novalidate>
                            {{ csrf_field() }}

                              @else
                        <form class="pt-3"  >
                              
                              @endif
                    <div  id="err" style="display: none" class="alert alert-danger">
                    <h5>Incorrect Password or Email</h5>
                   </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                   @if(isset($id))
                          <button class="btn btn-success" type="submit"> Login</button>

                              @else
                          <button id="submit" class="btn btn-success" >   <i id="loader" style="display: none" class="fa fa-circle-o-notch fa-spin"></i> Login</button>
                              
                              @endif
                  
                  </div>
                    @if(isset($id))
                              @else
                              <div class="my-2 d-flex justify-content-between align-items-center">
               
                              </div>
                          
                              <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="/register" class="text-primary">Create</a>
                              </div>
                              @endif
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/new/vendors/js/vendor.bundle.base.js"></script>
  <script src="/new/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/new/js/off-canvas.js"></script>
  <script src="/new/js/hoverable-collapse.js"></script>
  <script src="/new/js/template.js"></script>
  <script src="/new/js/settings.js"></script>
  <script src="/new/js/todolist.js"></script>

   @if(isset($id))
           @else
       <script type="text/javascript">

   $( document ).ready(function() {
    // $( "#err" ).hide();
     let token = "Bearer "  + localStorage.getItem('access_token');
    $.ajax({
    type: "GET",
    headers: {'Content-Type': 'application/json', Authorization: token  },
    url: "/api/app/attemptlogin",
    success: function(patientDTO) {
        console.log("SUCCESS: ", patientDTO);
        // window.location.href = '/dashboard';
         },
    error: function(e) {
    console.log("ERROR: ", e);
    
    }
});

     //  let token = "Bearer "  + localStorage.getItem('access_token');
     //               $.ajaxSetup({
     //            headers: { 'Content-Type': 'application/json',
     //                             Authorization: token }
     //        });
     //    $.get('/api/app/attemptlogin',   // url
     //   function(data, status, jqXHR) {// success callback

     //    console.log(status);
     // window.location.href = '/dashboard';   
     //    }).fail(function(jqxhr, settings, ex) {  });
   $( "#submit" ).click(function() {
     $('#loader').show();
     $('#submit').attr('disabled','disabled');
    let email = $('#email').val();
    let password = $('#password').val();
    let token2 = '';
    console.log(email);
    console.log(password);
$.ajaxSetup({
                headers: { }
            });
$.post('/oauth/token',   // url
       {        username: email, 
                password: password,
                grant_type: "password",
                client_id: "2",
                client_secret: "vHwc9aj0f7QbkQ7KiJiEhKW7E4rmTMozgl14CPk0"
       }, // data to be submit
    // $.post('/api/token',   // url
    //    {        email: email, 
    //             password: password
               
    //    }, // data to be submit
       function(data, status, jqXHR) {// success callback

        console.log(status);
               // console.log(data.access_token);
              localStorage.setItem('access_token', data.access_token);
               token2  = data.access_token;
                  console.log(token2);
                 token2 = "Bearer "  + token2;
                  console.log(token2);
                  $.ajax({
                  type: "GET",
                  headers: {'Content-Type': 'application/json', Authorization: token2  },
                  url: "/api/user",
                  success: function(patientDTO) {
                      console.log("SUCCESS: ", patientDTO);
                                  localStorage.setItem('username', patientDTO.username);
                                 localStorage.setItem('email', patientDTO.email);
                                 localStorage.setItem('id', patientDTO.id);
                                 localStorage.setItem('level', patientDTO.level);
                                 localStorage.setItem('created_at', patientDTO.created_at);
                                 console.log(patientDTO.level);
                                 if(patientDTO.level == "Super_admin")
                                 {
                                   window.location.href = '/dashboard';
                                 }
                                 else if(patientDTO.level == "Admin"){
                                   window.location.href = '/queue';
                                 }else if(patientDTO.level == "member"){
                                   window.location.href = '/medicalhistory';
                                 }

                       },
                  error: function(e) {
                     $('#err').show();
                      $('#loader').hide();
                      $('#submit').removeAttr('disabled');
                  // display(e.responseJSON.message);
                  // alert(e);

                  }
              });



        }).fail(function(jqxhr, settings, ex) {
           $('#err').show();
           $('#loader').hide();
           $('#submit').removeAttr('disabled');

         });




});
});
  </script>
                              @endif
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-dark/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jan 2019 02:26:38 GMT -->
</html>

