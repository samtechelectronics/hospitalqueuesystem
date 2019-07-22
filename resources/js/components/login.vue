<template>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="/new/logo.png" alt="logo">
              </div>
              <h4>Login</h4>
               <div class="alert alert-danger" v-if="errorstat">
                                 <p>{{error.error}}</p>
                                 <p>{{error}}</p>
                                 <p>{{error.message}}</p>
                </div>
              <form class="pt-3"  @submit.prevent="login">
                <div class="form-group">
                  <input  type="email" placeholder="Email" name="username"  v-model="form.email"  class="form-control" :class="{ 'is-invalid': form.errors.has('message') }" required>
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password"  name="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary"  type="submit" >Login</button>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
               <!--  <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="/register" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</template>

<script>
    export default {
    name: "login",
            data(){
        return {
                errorstat: false,
                error: {},
               varToken: "",
               token: "",
                form: new Form({
                email:'', 
                password:''

            })
        }
        },
         
        methods: {
            login(){
                this.form.post('/api/token').then(({ data }) =>  {


                   // console.log(data);
                   this.varToken  = data.access_token;
                   // console.log("this is " + this.varToken);
                   localStorage.setItem('access_token', data.access_token);
                    this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }
                    

                }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                if(err.response.data == 'undefined'){
                   this.error = "Unable to Connect, Please Check Your Network Connection.";
                }
               else{
                 this.error = err.response.data ; 
               }
                    // console.log(err.response.data);
                 


                  });

                    this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }
                   axios.get("api/user").then(({ data }) =>   

                 {
                   // console.log(data);
                   this.username = data.username;
                  
                   localStorage.setItem('username', data.username);
                   localStorage.setItem('email', data.email);
                   localStorage.setItem('id', data.id);
                   localStorage.setItem('level', data.level);
                   localStorage.setItem('created_at', data.created_at);
                   this.$router.push('/dashboard');
                 }
                  );
                
                
            },
            attemptlogin(){
              
            },
            loadusers(){

                this.form.get("api/user").then(({ data }) => (this.users  = data.data));
                // console.log('loding data.')
            }
        },
        mounted() {
           
            // console.log('Component mounted.')
        },
        beforeCreate: function () {
          // console.log("before Create");
         this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.get('/api/app/attemptlogin' ).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.data == undefined){
                      
                      }
                      else{
                        this.$router.push('/dashboard'); 
                      }  
                      
                   
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
                  


                  });
        }
        }



</script>







