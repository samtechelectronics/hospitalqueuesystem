<template>
     <div >
   
             <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card bg-primary border-0 position-relative">
                <div class="card-body">
                  <p class="card-title text-white">Iconet Device Data Center </p>
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
                                  <h3 class="font-weight-light mr-2 mb-1">{{device.product_name}}</h3>
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                  <h5 class="mb-0">Created :  {{device.created_at}}</h5>
                                  <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                  </div>  
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">Number Of PORTS : {{device.port_number}}</p>
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
                                 <h3 class="mb-0">Product ID:::</h3> <h3 class="font-weight-light mr-2 mb-1">{{device.product_id}}</h3>
                                 <h3 class="mb-0">Device Key:::</h3> <h3 class="font-weight-light mr-2 mb-1 text-success" >{{device.device_key}}</h3>
                                 <h3 class="mb-0">Secret Key:::</h3> <h3 class="font-weight-light mr-2 mb-1 text-success">{{device.device_secret}}</h3>
                                  
                                </div>
                                <div class="col-8 col-md-7 d-flex border-bottom border-info align-items-center justify-content-between px-0 pb-2 mb-3">
                                  <h5 class="mb-0">Product Status</h5>
                                  <div class="d-flex align-items-center">
                                    <i class="ti-angle-down mr-2"></i>
                                    <h5 class="mb-0 text-success">{{device.status}}</h5>
                                  </div>  
                                </div>
                                <p class="text-white font-weight-light pr-lg-2 pr-xl-5">Registered By : {{device.email}}</p>
                                
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
          <div class="row" v-if="device_status == 'active'">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{device.product_name}} DATA</h4>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Ports</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Device Online History</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Device Manual History</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-2" role="tab" aria-controls="contact-2" aria-selected="false">Device Share History</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Port Name</th>
                          <th>Port ID</th>
                          <th>Port Number</th>
                          <th>Status</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for= "port in ports" :key="port.id">
                          <td>{{port.port_name}}</td>
                          <td class="font-weight-bold">{{port.id}}</td>
                          <td class="font-weight-bold">{{port.pin_number}}</td>
                          <td class="font-weight-bold text-success" v-if="port.state == '1'" >ON</td>
                          <td class="font-weight-bold text-danger" v-if="port.state == '0'" >OFF</td>
                          
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
                          <th>Port Name</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>Action</th>
                          <th>Source</th>
                          <th>Action date</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="histori in history" :key="histori.id">
                          <td>{{histori.port_name}}</td>
                          <td>{{histori.user_name}}</td>
                          <td>{{histori.user_email}}</td>
                          <td class="font-weight-bold" >{{histori.action}}</td>
                          <td>{{histori.source}}</td>
                          <td class="font-weight-medium text-success">{{histori.created_at}}</td>
                          
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
                          <th>Port Name</th>
                          <th>Action </th>
                          <th>Date</th>
                          
                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="mhistori in mhistory" :key="mhistori.id">
                          <td>{{mhistori.port_name}}</td>
                          <td class="font-weight-bold text-success" v-if="mhistori.action == 'ON'" >{{mhistori.action}}</td>
                          <td class="font-weight-bold text-danger" v-if="mhistori.action == 'OFF'" >{{mhistori.action}}</td>
                          <td class="font-weight-medium text-success">{{mhistori.created_at}}</td>
                          
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                    </div>
                     <div class="tab-pane fade" id="contact-2" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                        
                          <th>Device Name</th>
                          <th>Owner`s Name & Email</th>
                          <th>Sharer`s Name & Email</th>
                          <th>Reciever`s Name & Email</th>
                          <th>Share Status </th>
                          <th>Number Of Ports Shared </th>
                          <th>Date</th>
                          
                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="share in shares" :key="share.id">
                          <td>{{share.product_name}}</td>
                          <td><span class="text-danger">{{share.owner_name}}</span>:: <span class="text-success">{{share.owner_email}}</span></td>
                           <td><span class="text-danger">{{share.sharedby_name}}</span>:: <span class="text-success">{{share.sharedby_email}}</span></td> 
                           <td><span class="text-danger">{{share.sharedto_name}}</span>:: <span class="text-success">{{share.sharedto_email}}</span></td>

                           <td>{{share.status}}</td>
                           <td >{{share.sharedport}}</td>
                          
                          <td class="font-weight-medium text-success">{{share.created_at}}</td>
                          
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
            device: {},
            device_status: 'inactive',
            ports: {},
            history:{},
            shares: {},
            mhistory: {}
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
                   axios.post('/api/admin/devicedata',{'device_id' : this.$route.params.id }).then((response) => {
                      console.log(response.data.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);
                      this.device = response.data.device;
                      this.device_status = response.data.device_status;
                      this.ports = response.data.ports;
                      this.history = response.data.history;
                      this.shares = response.data.shares;
                      this.mhistory = response.data.mhistory;
                       
                        

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
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
            // console.log('login out.');
             // localStorage.removeItem('user-token')
        }
    }
</script>

