<template>
     <div >
 
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-5 mb-4 mb-xl-0">
                  <h4 class="font-weight-bold">ICONET USERS </h4>
                </div>
                <div class="col-12 col-xl-7">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                   <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class=" text-info" >Total Users</p>
                      <h4 class="mb-0 font-weight-bold">{{totalusers}}</h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-success">Normal Users</p>
                      <h4 class="mb-0 font-weight-bold">{{memberscount}}</h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-danger">Admin Users</p>
                      <h4 class="mb-0 font-weight-bold">{{admincount}}</h4>
                    </div> 
                    <div class="border-right pr-4 mb-3 mb-xl-0" v-if="superadmincount != 0">
                      <p class="text-danger">Super Admin Users</p>
                      <h4 class="mb-0 font-weight-bold">{{superadmincount}}</h4>
                    </div>
                    <div class="mb-3 mb-xl-0">
                      <button class="btn btn-warning rounded-0 text-white" v-on:click.prevent= "createuser()">Add New User</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ICONET USERS</h4>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">ALL Users</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Member Users </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Admin Users</a>
                    </li>
                    <li class="nav-item" v-if="superadmincount != 0">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-4" role="tab" aria-controls="contact-4" aria-selected="false">Super Admin Users</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>User ID</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>User Level</th>
                          <th>Date Created</th>
                          <th>Settings</th>

                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="user in allusers" :key="user.id" >
                          <td>{{user.id}}</td>
                          <td class="font-weight-medium text-info">{{user.username}}</td>
                          <td class="font-weight-bold">{{user.email}}</td>
                          <td>{{user.level}}</td>
                       
                          <td class="font-weight-medium text-success" >{{user.created_at}}</td>
                          <td><a href=""  v-on:click.prevent = "edituser(user)" data-toggle="tooltip" data-placement="bottom" title="Edit User" ><i class="fa fa-edit"></i></a><router-link :to="{ name: 'userdetails', params: {id: user.id } }" ><a href="" style="padding-left: 20px" data-toggle="tooltip" data-placement="bottom" title="View User"><i class="fa fa-eye"></i></a> </router-link>  </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                    </div>
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                           <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>User ID</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>User Level</th>
                          <th>Date Created</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                       <tr v-for="member in members" :key="member.id" >
                          <td>{{member.id}}</td>
                          <td class="font-weight-medium text-info">{{member.username}}</td>
                          <td class="font-weight-bold">{{member.email}}</td>
                          <td>{{member.level}}</td>
                       
                          <td class="font-weight-medium text-success" >{{member.created_at}}</td>
                          <td><a href="" v-on:click.prevent = "edituser(member)" data-toggle="tooltip" data-placement="bottom" title="Edit User" ><i class="fa fa-edit"></i></a><router-link :to="{ name: 'userdetails', params: {id: member.id } }" ><a href="" style="padding-left: 20px" data-toggle="tooltip" data-placement="bottom" title="View User" ><i class="fa fa-eye"></i></a> </router-link>  </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    </div>
                    <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>User ID</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>User Level</th>
                          <th>Date Created</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                       <tr v-for="admin in admins" :key="admin.id" >
                          <td>{{admin.id}}</td>
                          <td class="font-weight-medium text-info">{{admin.username}}</td>
                          <td class="font-weight-bold">{{admin.email}}</td>
                          <td>{{admin.level}}</td>
                       
                          <td class="font-weight-medium text-success" >{{admin.created_at}}</td>
                          <td><a href=""v-on:click.prevent = "edituser(admin)" data-toggle="tooltip" data-placement="bottom" title="Edit User"><i class="fa fa-edit"></i></a><router-link :to="{ name: 'userdetails', params: {id: admin.id } }" ><a href="" style="padding-left: 20px" data-toggle="tooltip" data-placement="bottom" title="View User"><i class="fa fa-eye"></i></a> </router-link>  </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    </div>
                       <div  class="tab-pane fade" id="contact-4" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>User ID</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>User Level</th>
                          <th>Date Created</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                       <tr v-for="superadmin in superadmins" :key="superadmin.id" >
                          <td>{{superadmin.id}}</td>
                          <td class="font-weight-medium text-info">{{superadmin.username}}</td>
                          <td class="font-weight-bold">{{superadmin.email}}</td>
                          <td>{{superadmin.level}}</td>
                       
                          <td class="font-weight-medium text-success" >{{superadmin.created_at}}</td>
                          <td><a href="" v-on:click.prevent = 'edituser(superadmin)'  data-toggle="tooltip" data-placement="bottom" title="Edit User" ><i class="fa fa-edit"></i></a><router-link :to="{ name: 'userdetails', params: {id: superadmin.id } }" ><a href="" style="padding-left: 20px" data-toggle="tooltip" data-placement="bottom" title="View User"><i class="fa fa-eye"></i></a> </router-link>  </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
     
           <div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form @submit.prevent=" createmode ? saveuser() : savediteduser()">
                      <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel"  v-show = "createmode">Add New User </h5>
                          <h5 class="modal-title" id="exampleModalLabel"  v-show = "!createmode">Edit  User </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           <h4 class="alert alert-danger" v-if="error != ''">{{ error }}</h4>
                            <div class="form-group">
                            <label>User Name</label>
                              <input v-model="form.username" placeholder="Username" type="text" name="username"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('username') }" required="">
                          <!-- <has-error :form="form" field="product_name" ></has-error> -->
                           </div>
                           <div class="form-group" >
                                              <label>Email</label>
                                              <input v-model="form.email" placeholder="Email" type="email" name="email"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" required="">
                                             <!--  <has-error :form="form" field="id" ></has-error> -->
                          </div> 
                             <div class="form-group" >
                                              <label>Level</label>
                               <select v-model="form.level" class="form-control " required="">
                              <option   value="member">Member</option>
                              <option   value="Admin">Admin</option>
                              <option v-if="userlevel == 'Super_admin'"  value="Super_admin">Super Admin</option>
                      
                    </select>          
                                             <!--  <has-error :form="form" field="id" ></has-error> -->
                          </div> 
                           <div class="form-group"  v-if = 'createmode'>
                                              <label >Password</label>
                                              
                                            <input type="password" v-model="form.password" name="password" class="form-control" required="">
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                  <button type="submit" v-show = "!createmode" class="btn btn-primary">Update user</button>
                                                  <button type="submit"  v-show = "createmode" class="btn btn-primary" >Add user</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
        
                 

          </div>
         
</template>

<script>
    export default {
        data(){
            return {

            userlevel: '',
            createmode: false,
            totalusers: 0,
            error: '',
            admincount: 0,
            superadmincount: 0,
            memberscount: 0,
            superadmins:{},
            allusers:{},
            admins: {},
            members: {},
            form: new Form({
                id: '',
                email:'',
                username: '',
                level: '',
                password: '',

            })

            }
        },
        methods: {
       

         createuser(){
          this.createmode = true;
          this.error = '';
          this.form.reset();
          $('#createuser').modal('show');
         },
         edituser(user){
          this.createmode = false;
          this.error = '';
          this.form.reset();
           this.form.fill(user);
          $('#createuser').modal('show');

         },
         savediteduser(){
          this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/saveuser',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      // console.log(response.data);
                      this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: response.data.email + ', ' +  response.data.password 
                            }) 

                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      Fire.$emit('reload');
                       $('#createuser').modal('hide');
                       this.$swal.fire(
                        'User Updated!',
                        'The User Data have been Updated Successfully.',
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
         saveuser(){
          this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/app/register',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      // console.log(response.data);
                      this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: response.data.email + ', ' +  response.data.password 
                            }) 

                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      Fire.$emit('reload');
                       $('#createuser').modal('hide');
                       this.$swal.fire(
                        'User Created!',
                        'The User have been Created Successfully.',
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
         loaddata(){
          // console.log("ok oo");
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.get('/api/admin/getusers').then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                   window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);

                        this.totalusers = _.size(response.data.users) + _.size(response.data.admins) + _.size(response.data.superadmins);
                        this.memberscount = _.size(response.data.users);
                        this.admincount =  _.size(response.data.admins);
                        this.superadmincount = _.size(response.data.superadmins);
                        this.members = response.data.users;
                        this.admins   = response.data.admins;
                        this.allusers   = response.data.allusers;
                        this.superadmins   = response.data.superadmins;

                      // console.log(response.data.users);
                      // console.log(response.data.allusers);
                      // console.log(this.admins );
                       
                       
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
                this.error = err.response.data; 
                // console.log(err.response.data);
               window.location.href = '/signin';


                  });  
         }   
        },

        mounted() {
             $('[data-toggle="tooltip"]').tooltip();

            this.userlevel = localStorage.getItem('level');
            // console.log(this.userlevel);
            this.loaddata();
        Fire.$on('reload', () => {
            this.loaddata();
          })
        this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
            // console.log('login out.');
             // localStorage.removeItem('user-token')
        }
    }
</script>
