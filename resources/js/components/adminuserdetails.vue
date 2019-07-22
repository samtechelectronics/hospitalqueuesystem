<template>
     <div >
     
 
                     <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card bg-primary border-0 position-relative">
                <div class="card-body">
                  <p class="card-title text-white">Iconet User Data Center </p>
                  <div id="performanceOverview" class="  performance-overview-carousel position-static pt-2" >
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-4 item">
                            <div class="d-flex flex-column flex-xl-row mt-4 mt-md-0">
                              <div class="icon icon-a text-white mr-3">
                                <i class="ti-tablet icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                  <h3 class="font-weight-light mr-2 mb-1">{{user.username}}</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                  <h5 class="mb-0">Registration Date :  {{user.created_at}}</h5>
                                  <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                  </div>  
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">User Email : {{user.email}}</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7 item">
                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                              <div class="icon icon-b text-white mr-3">
                                <i class="ti-key icon-lg ml-3"></i>
                              </div>
                              <div class="content text-white">
                                <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                <h3 class="mb-0">User  ID:::</h3> <h3 class="font-weight-light mr-2 mb-1">{{user.id}}</h3>
                                  
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                  <h5 class="mb-0">User Status</h5>
                                  <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                    <h5 class="mb-0 text-success">Active</h5>
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
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Iconet Devices Associated with this User.</h4>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Iconet Box Registered By  {{user.username}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Iconet Box Shared to {{user.username}}</a>
                    </li>
                   
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Product ID</th>
                          <th>Product Name</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="device in devices" :key="device.id">
                          <td class="font-weight-medium text-info">{{device.product_id}}</td>
                          <td>{{device.product_name}}</td>
                          <td><router-link :to="{ name: 'devicedata', params: {id: device.product_id } }" ><a href="" style="padding-left: 20px" ><i class="fa fa-eye"></i></a> </router-link></td>
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
                           <th>Product ID</th>
                          <th>Product Name</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                           <tr v-for="shareddevice in shareddevices" :key="shareddevice.id">
                          <td class="font-weight-medium text-info">{{shareddevice.product_id}}</td>
                          <td>{{shareddevice.product_name}}</td>
                          <td><router-link :to="{ name: 'devicedata', params: {id: shareddevice.product_id } }" ><a href="" style="padding-left: 20px" ><i class="fa fa-eye"></i></a> </router-link></td>
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
        </div>
 
</template>

<script>
    export default {
        data(){
            return {
            user: {},
            devices: {},
            shareddevices: {}
            }
        },
        methods: {
          
            loaddata(){
                // console.log(this.$route.params.id);
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/getuserdata',{'user_id' : this.$route.params.id }).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      this.user = response.data.user;
                      this.shareddevices = response.data.shareddevices;
                      this.devices = response.data.devices;
                       
                        

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
            this.loaddata();
            this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
             
            }else{
               $('#admin').hide();
            }
            // console.log('login out.');
             // localStorage.removeItem('user-token')
        }
    }
</script>

