<template>
     <div >

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-5 mb-4 mb-xl-0">
                  <h4 class="font-weight-bold">ICONET DEVICES</h4>
                </div>
                <div class="col-12 col-xl-7">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                   <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class=" text-info" >Total Devices</p>
                      <h4 class="mb-0 font-weight-bold">{{totaldevicecount}}</h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-success">Active Devices</p>
                      <h4 class="mb-0 font-weight-bold">{{activeproducts}}</h4>
                    </div>
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-danger">Inactive Devices</p>
                      <h4 class="mb-0 font-weight-bold">{{inactiveproducts}}</h4>
                    </div>
                    <div class="mb-3 mb-xl-0">
                      <button class="btn btn-warning rounded-0 text-white" v-on:click.prevent= "adddevice()">Add device New Device</button>
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
                  <h4 class="card-title">ICONET Devices</h4>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">ALL Devices</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Registered Device</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Unregistered</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Porduct Name</th>
                          <th>Product ID</th>
                          <th>Number of Ports</th>
                          <th>Created By</th>
                          <th>Status</th>
                          <th>Date Created</th>
                          <th>Settings</th>

                        </tr>  
                      </thead>
                      <tbody>
                        <tr v-for="alldevice in devices" :key="alldevice.id" >
                          <td>{{alldevice.name}}</td>
                          <td class="font-weight-medium text-info">{{alldevice.product_id}}</td>
                          <td class="font-weight-bold">{{alldevice.port_number}}</td>
                          <td>{{alldevice.registeredby_email}}</td>
                          <td class="font-weight-medium text-warning" v-if="alldevice.status == 'unused'">{{alldevice.status}}</td>
                          <td class="font-weight-medium text-success" v-if="alldevice.status == 'used'">{{alldevice.status}}</td>
                          <td class="font-weight-medium text-success" >{{alldevice.created_at}}</td>
                          <td><a href="" v-on:click.prevent="editdevice(alldevice)" data-toggle="tooltip" data-placement="bottom" title="Edit Device"  ><i class="fa fa-edit"></i></a><a href="" style="padding-left: 20px" v-on:click.prevent="deletedevice(alldevice)" data-toggle="tooltip" data-placement="bottom" title="Delete Device" ><i class="fa fa-trash"></i></a> <router-link :to="{ name: 'devicedata', params: {id: alldevice.product_id }}" ><a href="" style="padding-left: 20px" data-placement="bottom" title="View Device" ><i class="fa fa-eye"></i></a> </router-link>  </td>
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
                          <th>Porduct Name</th>
                          <th>Product ID</th>
                          <th>Number of Ports</th>
                          <th>Registered By</th>
                          <th>Date Registered</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                         <tr v-for="device in activedevices" :key="device.id" >
                          <td>{{device.product_name}}</td>
                          <td class="font-weight-medium text-info">{{device.product_id}}</td>
                          <td class="font-weight-bold">{{device.port_number}}</td>
                          <td>{{device.email}}</td>
                          
                          <td class="font-weight-medium text-success" >{{device.created_at}}</td>
                          <td><a href="" v-on:click.prevent="editdevice(device)"  data-toggle="tooltip" data-placement="bottom" title="Edit Device" ><i class="fa fa-edit"></i></a><a href="" style="padding-left: 20px" v-on:click.prevent="deletedevice(device)"  data-toggle="tooltip" data-placement="bottom" title="Delete Device"><i class="fa fa-trash"></i></a> <a href="" style="padding-left: 20px" v-on:click.prevent = "uninstalldevice(device)"  data-toggle="tooltip" data-placement="bottom" title="Uninstall Device" ><i class="fa fa-power-off"></i></a> <router-link :to="{ name: 'devicedata', params: {id: device.product_id } }" ><a href="" style="padding-left: 20px"  data-toggle="tooltip" data-placement="bottom" title="View Device Data" ><i class="fa fa-eye" ></i></a> </router-link> </td>
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
                          <th>Porduct Name</th>
                          <th>Product ID</th>
                          <th>Number of Ports</th>
                          <th>Created By</th>
                          <th>Status</th>
                          <th>Date Created</th>
                          <th>Settings</th>
                        </tr>  
                      </thead>
                      <tbody>
                         <tr v-for="inactivedevice in inactivedevices" :key="inactivedevice.id" >
                          <td>{{inactivedevice.name}}</td>
                          <td class="font-weight-medium text-info">{{inactivedevice.product_id}}</td>
                          <td class="font-weight-bold">{{inactivedevice.port_number}}</td>
                          <td>{{inactivedevice.registeredby_email}}</td>
                          <td class="font-weight-medium text-warning" v-if="inactivedevice.status == 'unused'">{{inactivedevice.status}}</td>
                          <td class="font-weight-medium text-success" v-if="inactivedevice.status == 'used'">{{inactivedevice.status}}</td>
                          <td class="font-weight-medium text-success" >{{inactivedevice.created_at}}</td>
                          <td><a href="" v-on:click.prevent="editdevice(inactivedevice)"  data-toggle="tooltip" data-placement="bottom" title="Edit Device"><i class="fa fa-edit"></i></a><a href="" style="padding-left: 20px" v-on:click.prevent="deletedevice(inactivedevice)"  data-toggle="tooltip" data-placement="bottom" title="Delete Device"><i class="fa fa-trash"></i></a>  <router-link :to="{ name: 'devicedata', params: {id: inactivedevice.product_id } }" ><a href="" style="padding-left: 20px"  data-toggle="tooltip" data-placement="bottom" title="View Device" ><i class="fa fa-eye"></i></a> </router-link><a href="" style="padding-left: 20px" v-on:click.prevent="assigndevice(inactivedevice)"  data-toggle="tooltip" data-placement="bottom" title="Assign Devices to a User" ><i class="fa fa-share-square"></i></a></td>
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
          <div class="modal fade" id="adddevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form @submit.prevent=" createmode ? saveNewDevice() : assignnewdevice()">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"  v-show = "createmode">Add New Device </h5>
                          <h5 class="modal-title" id="exampleModalLabel"  v-show = "!createmode">Assign Device To an Account</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           <h4 class="alert alert-danger" v-if="error != ''">{{ error }}</h4>
                            <div class="form-group"  v-if= "!createmode">
                            <label>User Email</label>
                              <input v-model="form.email" placeholder="User Email " type="email" name="email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" required="">
                          <!-- <has-error :form="form" field="product_name" ></has-error> -->
                           </div>
                            <div class="form-group"  >
                            <label>Device Name</label>
                              <input v-model="form.name" placeholder="Name " type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                          <!-- <has-error :form="form" field="product_name" ></has-error> -->
                           </div>
                           <div class="form-group" v-if= "createmode" >
                                              <label>Number Of Product to Add</label>
                                              <input v-model="form.number" placeholder="Number Of Product" type="number" name="number"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('number') }" required="">
                                             <!--  <has-error :form="form" field="number" ></has-error> -->
                         </div> 
                          <div class="form-group"  v-if= "createmode" >
                                              <label>Number Of Ports to Asign to Each Device</label>
                                              <input v-model="form.portcount" placeholder="Number of Ports" type="number" name="portcount"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('portcount') }" required="">
                                             <!--  <has-error :form="form" field="portcount" ></has-error> -->
                         </div>
                        </div>
                        <div class="modal-footer" >
                         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                 
                                                  <button type="submit"  class="btn btn-primary" v-if="createmode" >Create Device(s)</button>
                                                  <button type="submit"  class="btn btn-primary" v-if="!createmode" >Assigndevice Device(s)</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                   <div class="modal fade" id="editdevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form @submit.prevent="savedevice()">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"  >Edit </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           <h4 class="alert alert-danger" v-if="error != ''">{{ error }}</h4>
                            
                            <div class="form-group"  >
                            <label>Device Name</label>
                              <input v-model="form.product_name" placeholder="Name " type="text" name="product_name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('product_name') }">
                          <!-- <has-error :form="form" field="product_name" ></has-error> -->
                           </div>
                           <div class="form-group" >
                                              <label>Number Of Ports</label>
                                              <input v-model="form.portcount" placeholder="Number Of Product" type="number" name="portcount"
                                                class="form-control text-success" :class="{ 'is-invalid': form.errors.has('portcount') }  " required="" v-if="device.status != 'unused'" readonly=""> 
                                                <input v-model="form.portcount" placeholder="Number Of Product" type="number" name="portcount"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('portcount') }" required="" v-if="device.status == 'unused'" >
                                             <!--  <has-error :form="form" field="number" ></has-error> -->
                         </div> 
                          
                        <div class="modal-footer" >
                         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                 
                                                  <button type="submit"  class="btn btn-primary" >Save</button>
                                             
                        </div>
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
            createmode: false,
            totaldevicecount: 0,
            inactiveproducts: 0,
            activeproducts: 0,
           
            device: {},
            activedevices: {},
            inactivedevices: {},
            devices:{},
            adevice: {},
            error: '',
            form: new Form({
                name:'',
                portcount: '',
                number: '',
                product_id: '', 
                product_name: '', 
                email:''

            })

            }
        },
        methods: {
          deletedevice(device){
            // console.log(device);
            this.$swal.fire({
            title: 'Are you sure you want to delete this Device?',
            text: "You won't be able to revert this! and every details about this device would be deleted.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {


              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/deletedevice', { 'device_id' : device.product_id}).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){
                     
                      $('#adddevice').modal('hide');
                       
                       Fire.$emit('reload');
                               
                        this.$swal.fire(
                        'Deleted!',
                        'The Device has been deleted.',
                        'success'
                      ) 

                       }else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err; 
                // console.log(err);
                 window.location.href = '/signin';


                  });  
            
             
            }
          })
          },
          uninstalldevice(device){
            // console.log(device);
            this.$swal.fire({
            title: 'Are you sure you want to Uninstall this Device?',
            text: "You won't be able to revert this! and every details about this device would be refreshed.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Uninstall it!'
          }).then((result) => {
            if (result.value) {


              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/uninstalldevice', { 'device_id' : device.product_id}).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){
                     
                      $('#adddevice').modal('hide');
                       
                       Fire.$emit('reload');
                               
                        this.$swal.fire(
                        'Uninstalled!',
                        'The Device have been Uninstalled.',
                        'success'
                      ) 

                       }else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }
                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err; 
                // console.log(err);
                 window.location.href = '/signin';


                  });  
            
             
            }
          })
          },
            adddevice(){
               this.form.reset();
              this.createmode = true;
           $('#adddevice').modal('show');
           
            }, 
            editdevice(device){
              this.device = device;
              // console.log(device);
               this.form.portcount = device.port_number;
               this.form.product_id = device.product_id;
               this.form.product_name = device.name;
               $('#editdevice').modal('show');
           
            }, 
            savedevice(){
              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/edit',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){
                     
                      $('#editdevice').modal('hide');
                       
                       Fire.$emit('reload');
                       
                           this.$swal.fire(
                              'Device Edited  Successfully',
                              'Your device Editng process is complete.',
                              'success'
                            ); 

                       }else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }
                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err; 
                // console.log(err);
                 window.location.href = '/signin';


                  });  
            },
             assigndevice(device){
              this.adevice = device;
              this.form.reset();
              this.createmode = false;
           $('#adddevice').modal('show');
           
            },
            saveNewDevice(){
                // console.log("save nww");
              if(this.form.name == '' || this.form.portcount == '' || this.form.number == ''){
                this.error = 'Invalid details, Please confirm Details and try again.'
              }
              else{
                this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/createdevice',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){
                     
                      $('#adddevice').modal('hide');
                       
                       Fire.$emit('reload');
                       
                           this.$swal.fire(
                              'Device(s) Created Successfully',
                              'Your device creation process is complete.',
                              'success'
                            ); 

                       }else{
                         this.$swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text:  response.data.error,
                            }) 
                       }                       

                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err; 
                // console.log(err);
                 window.location.href = '/signin';


                  });  
              }
            },
            assignnewdevice(){
              this.error = '';
          // console.log(this.adevice.pro);
              this.form.product_id = this.adevice.product_id;
               if(this.form.name == '' || this.form.email == ''){
                this.error = 'Invalid details, Please confirm Details and try again.'
              }
              else{
                this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.post('/api/admin/assigndevice',this.form).then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){
                     
                      $('#adddevice').modal('hide');
                       
                       Fire.$emit('reload');
                       
                           this.$swal.fire(
                              'Device Assigned Successfully',
                              'The device has assigning process is complete.',
                              'success'
                            ); 

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
                this.error = err; 
                // console.log(err);
                 window.location.href = '/signin';


                  });

            }
          },
         loaddata(){
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                   axios.get('/api/admin/getdevices').then((response) => {
                      // console.log(response.data.data);
                      if(response.data.code == undefined){
                     window.location.href = '/signin'; 
                      }
                       else if(response.data.code == '200'){

                      // console.log(response.data);

                        this.totaldevicecount = response.data.devicesprops.totalproducts;
                        this.activeproducts = response.data.devicesprops.activeproducts;
                        this.inactiveproducts = response.data.devicesprops.inactiveproducts;
                        this.activedevices = response.data.activedevices;
                        this.inactivedevices = response.data.inactivedevices;
                        this.devices = response.data.alldevices;
                       
                        

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
