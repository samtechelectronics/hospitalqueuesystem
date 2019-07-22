<template>
    <div >
                        <div class="row">
                        <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div>
                                        <img src="/assets/images/avater.png" class="img-lg rounded-circle mb-2" alt="profile image"/>
                                        <h4>{{user.username}}       <a href="" v-on:click.prevent="changeusername()"><i  class="fa fa-pencil"></i></a> </h4>

                                    <div class="row" id='editusername'>
                                        <div class="col-12 grid-margin stretch-card">
                                          <div class="card">
                                            <div class="card-body">
                                              <h4 class="card-title">Edit Username</h4>
                                              <p class="card-description">
                                               <code>{{error}}</code> 
                                              </p>
                                              <form class="form-inline"  @submit.prevent="saveusername()">
                                                <label class="sr-only" for="inlineFormInputName2">User Name</label>
                                                <input v-model="form.userName"  type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Username" required="">
                                                
                                                <button type="submit" class="btn btn-primary mb-2">Save</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div> 
                                    </div>
                                        <p class="text-muted mb-0">{{user.email}}</p>
                                    </div>
                                    <p class="mt-2 card-text">
                                            LEVEL : {{user.level}}
                                    </p>
                                    <button class="btn btn-info btn-sm mt-3 mb-4" v-on:click.prevent="changepassword()">Change Password</button>
                                    <div class="border-top pt-3">

                                    <div class="row" id='passwordchange'>
                                        <div class="col-12 grid-margin stretch-card">
                                          <div class="card">
                                            <div class="card-body">
                                              <h4 class="card-title">Change Password</h4>
                                              <p class="card-description">
                                               <code>{{error}}</code> 
                                              </p>
                                              <form class="form-inline"  @submit.prevent="savepassword()">
                                               <!--  <label class="sr-only" for="inlineFormInputName2">Old Password</label>
                                                <input type="Password" v-model="form.oldpassword" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Old Password" required="">
                                               -->
                                                <label class="sr-only" for="inlineFormInputGroupUsername2">New Password</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                 
                                                  <input type="Password" v-model="form.newpassword" class="form-control" id="inlineFormInputGroupUsername2" placeholder="New Password" required="">
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary mb-2">Save</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div> 
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>

                    
                      
    </div>
</template>

<script>
    export default {
      data(){
        return {
          user: {},
          error: '',
          edituser: false,
          editpass: false,
          passwordMode: false,
          form: new  Form({
            userName: '',
            oldpassword: 'testingthesysytem',
            newpassword: ''
          })
        }
      },
      methods:{
         changeusername(){
          if(!this.edituser){
            this.edituser = true;
          this.form.userName = localStorage.getItem('username');
           $('#editusername').show();
          }else{
            this.edituser = false;
           $('#editusername').hide();
          }
          

           // Fire.$emit('reload');
         },
         changepassword(){
       
       if(!this.editpass){
            this.editpass = true;
             $('#passwordchange').show();
          }else{
            this.editpass = false;
             $('#passwordchange').hide();

          }
         },
         saveusername(){
           this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/app/saveusername',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      // console.log(response.data);
                      // this.$swal.fire({
                      //         type: 'error',
                      //         title: 'Oops...',
                      //         text: response.data.email + ', ' +  response.data.password 
                      //       }) 

                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      Fire.$emit('reload');
                      $('#editusername').hide();
                       this.$swal.fire(
                        'User Name Updated!',
                        'The User Name have been Updated Successfully.',
                        'success'
                      ) ;


                       
                       
                       }
                       else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }
                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data.code; 
                // console.log(err);
               window.location.href = '/signin';


                  }); 
         },
         savepassword(){
          console.log(this.form.newpassword);
          console.log(this.form.newpassword);
            if(_.size(this.form.newpassword) < 6 ||  _.size(this.form.oldpassword) < 6  ){
              this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  'password Lenght Most Be greater than five.',
                            }) 
            }else{
             this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/app/savepassword',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                       // window.location.href = '/signin'; 
                      // console.log(response.data);
                      // this.$swal.fire({
                      //         type: 'error',
                      //         title: 'Oops...',
                      //         text: response.data.email + ', ' +  response.data.password 
                      //       }) 

                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      Fire.$emit('reload');
                      $('#passwordchange').hide();
                      
                       this.$swal.fire(
                        'password Changed!',
                        'The password  have been Updated Successfully.',
                        'success'
                      ) ;


                       
                       
                       }
                       else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }
                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data.code; 
                // console.log(err);
               // window.location.href = '/signin';


                  });  
            }

         },
        loaduser(){
           this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                axios.get("api/user").then(({ data }) =>   

                 {
                   // console.log(data);
                   this.user = data;
                  
                   localStorage.setItem('username', data.username);
                   localStorage.setItem('email', data.email);
                   localStorage.setItem('id', data.id);
                   localStorage.setItem('level', data.level);
                   localStorage.setItem('created_at', data.created_at);
                 }
                  );
        }
      },
        mounted() {
            $('#passwordchange').hide();
            $('#editusername').hide();
          this.loaduser();
          Fire.$on('reload', () => {
            this.loaduser();
           
          });
            console.log('Component mounted.')
        }
    }
</script>
