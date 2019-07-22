<template>
     <div >
   
             <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title text-md-center text-xl-left alert alert-success">ICONET DEVICES</h1>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <p>Toatal Devices : {{totaldevicecount}}</p>
                   
                    <router-link to="/admin/devices">   <a href="" class="btn btn-warning"  data-toggle="tooltip" data-placement="bottom" title="View Devices Data"><i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0">VIEW</i></a> </router-link>
                  </div>  
                  <p class="mb-0 mt-2 text-warning"><span class="text-body ml-1"><big>Registered Devices</big> : {{activeproducts}} </span></p>
                  <p class="mb-0 mt-2 text-warning"><span class="text-body ml-1"><big>UNRegistered Devices</big> : {{inactiveproducts}} </span></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1   class="card-title text-md-center text-xl-left alert alert-warning">ICONET REGISTERED USERS</h1 >
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                     <p>Toatal USERS : {{totaluserscount}}</p>
                   
                   <!-- <a href="" class="btn btn-success"><i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0">VIEW</i></a> -->
                   <router-link to="/admin/users">   <a href="" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="View Users Data"><i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0" >VIEW</i></a> </router-link>
                  </div>  
                  <p class="mb-0 mt-2 text-warning"><span class="text-body ml-1"><big>Ordinary USERS</big> : {{ordinaryusercount}} </span></p>
                  <p class="mb-0 mt-2 text-warning"><span class="text-body ml-1"><big>Admin USERS</big> : {{adminusercount}} </span></p>
                  <p class="mb-0 mt-2 text-warning" v-if = "userlevel == 'Super_admin'"><span class="text-body ml-1"><big>Super Amin USERS</big> : {{superadmincount}} </span></p>
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
              userlevel: '',
            totaldevicecount: 0,
            inactiveproducts: 0,
            activeproducts: 0,
            totaluserscount: 0,
            ordinaryusercount: 0, 
            superadmincount: 0,
            adminusercount: 0,
            }
        },
        methods: {
         loaddata(){
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.get('/api/admin/home').then((response) => {
                      // console.log(response.data);
                      if(response.data.code == undefined){
                       window.location.href = '/signin'; 
                      }
                       else{

                      // console.log(response.data);

                        this.totaldevicecount = response.data.device.totalproducts;
                        this.activeproducts = response.data.device.activeproducts;
                        this.inactiveproducts = response.data.device.inactiveproducts;
                        this.totaluserscount = response.data.userlist.totalusers;
                        this.adminusercount =  response.data.userlist.adminuser;
                        this.ordinaryusercount =  response.data.userlist.ordinaryuser;
                        this.superadmincount =  response.data.userlist.superadminuser;
                        

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
