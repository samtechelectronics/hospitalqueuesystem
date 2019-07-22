<template>
    <div >
  
           <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Share Device</h4>
                  <p class="card-description">
                      <h4 class="alert alert-success" v-if="msg" >{{message}}</h4>      
                      <h4 class="alert alert-danger" v-if="err" >{{error}}</h4> 
                   </p>
                  <form class="forms-sample" @submit.prevent="sharedevice()">
                    <div class="form-group">
                      <label for="exampleInputUsername1">User Email</label>
                      <input v-model="form.email" type="email" name="email" placeholder="Enter User Email"  class="select2_demo_2 form-control" >
                    </div>
                    
                    

                     
                     <div class="form-group" v-show="!shareall">    
                     <label style="padding-left: 30px" for="shareall">Select Ports Share</label>   
                    <select v-model="multipleSelections" class="form-control " style="width: 300px"  :multiple="multiple === 'true'"
                          v-bind:class="{ 'fix-height': multiple === 'true' }">
                      <option v-for="port in ports"  :value="port.id ">{{port.port_name}}</option>
                      
                    </select>
                         
                     </div>
                    <div class="form-check" >
                      <input type="checkbox" class="form-check-input" id="shareall"  v-on:click="shareallport()">
                      <label class="form-check-label" for="shareall">Share All Ports</label>
                      
                      
                    </div>
                    <hr><hr>
                     <div class="form-check " v-if="level == 'owner'">
                      <input type="checkbox" class="form-check-input" id="share"  v-model="allowshare"
                       >
                      <label class="form-check-label" for="share"> Allow User to Share with Third Party. </label>
                    </div>
                     <!-- <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"   v-on:click="shareallport()">
                         Share All Ports.
                      </label>
                    </div>
                    <div class="form-check form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"  v-model="allowshare">
                         Allow User to Share with Third Party.
                      </label>
                    </div> -->
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-3">
            </div>
             <!--  <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Share Device</h4>
                  <p class="card-description">
                      <h4 class="alert alert-success" v-if="msg" >{{message}}</h4>      
                      <h4 class="alert alert-danger" v-if="err" >{{error}}</h4> 
                   </p>
                  <form class="form-inline"  @submit.prevent="sharedevice()">
                    
                  
                    <label class="sr-only" for="inlineFormInputGroupUsername2">User Email</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">User Email</div>
                      </div>
                      <input v-model="form.email" type="email" name="email" placeholder="Enter Email"  class="select2_demo_2 form-control" >
                    </div>
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Share Level</label>
                     
                     <div class="form-check" v-if="level == 'owner'">
                      <input type="checkbox" class="form-check-input" id="share"  v-model="allowshare"
                     >
                      <label class="form-check-label" for="share"> Allow User to Share with Third Party. </label>
                    </div>
                     <label style="padding-left: 30px" for="shareall">Select Ports Share</label>
                     
                     <div class="input-group mb-2 mr-sm-2" v-show="!shareall">       
                    <select v-model="multipleSelections" class="form-control " style="width: 300px"  :multiple="multiple === 'true'"
                          v-bind:class="{ 'fix-height': multiple === 'true' }">
                      <option v-for="port in ports"  :value="port.id ">{{port.port_name}}</option>
                      
                    </select>
                         
                     </div>
                      <div class="form-check" >
                      <input type="checkbox" class="" id="shareall"  v-on:click="shareallport()">
                      
                      <label class="form-check-label" for="shareall">Share All Ports</label>
                    </div>
                     <button type="submit" class="btn btn-primary mb-2"> <i class="fa fa-share">Share</i></button>
                    
                  </form>
                </div>
              </div>
            </div> -->


          </div>


           <div class="row">
            <div class="col-lg-12">
               <div class="card">
            <div class="card-body">
              <h4 class="card-title">Share History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                                        <th>Registered By</th>
                                        <th>Shared BY</th>
                                        <th>Shared To</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Share Date</th>
                                        <th>Cancelled Date</th>
                                        <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                            <tr v-for="share in shares" :key="share.id">
                                        <td>{{share.owner_name }}</td>
                                       
                                        <td>{{share.sharedby_name }}</td>
                                         <td>{{share.sharedto_name }}</td>
                                         <td> <label class="badge badge-info">{{share.status }}</label></td>
                                         <td>{{share.level }}</td>
                                   
                                
                                          <td>{{share.created_at}}  </td>
                                          <td><span v-if="share.status != 'active'" >{{share.updated_at}}</span>  </td>
                                            <td v-if="share.status == 'active'" >
                                          <button class="btn btn-outline-danger" v-on:click.prevent = "cancelshare(share.id)"><i class="fa fa-times"></i></button>
                                      
                                          </td>

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
        name: 'share',
        data(){
            return {
                shareall: false,
                allowshare: true,
                msg: false,
                err: false,
                error: "",
                level: "",
                shares: {},
                ports: {},
                multiple: "true",
                multipleSelections: [],
                form: new Form({
                email: "",
                level: "",
                shareall: false,
                porttoshare: [],
                device_id: ""
                }),

            }
        },

        methods: {
          cancelshare(id){
           this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }
          axios.post('/api/app/cancelshare',{ "share_id" : id }).then((response) => {
                      // console.log(response.data);
                       if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        
                       Fire.$emit('reload');
                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
                      }
                     
                      
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
                 window.location.href = '/signin';
 

                  }); 
          },
          shareallport(){
            // console.log(this.allowshare);
            if(document.getElementById('shareall').checked) {
              // console.log('accepted');
              
              this.shareall = true;

            } else {
             this.shareall = false; 
              // console.log('not_accepted');

            }
          },
            sharedevice(){
              console.log(this.multipleSelections);
                this.err = false;
                this.msg = false;
                this.error = "";
                this.message = "";

                 if(!this.shareall && this.multipleSelections.length == 0 ){
                  // console.log("error");
                   this.err = true;
                this.error = "Please Select Ports To share.";

                 }else{
                  this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                this.form.shareall = this.shareall;
                this.form.porttoshare = this.multipleSelections;
                if(this.level == 'owner'){
                  if(this.allowshare){
                    this.form.level = 'knight';
                  }else{
                    this.form.level = 'pawn';
                  }
                }else{
                  this.form.level = 'pawn';
                }
                this.form.device_id = this.$route.params.id;
                 console.log(this.form);
               axios.post('/api/app/sharedevice',this.form).then((response) => {
                      // console.log( response.data);
                       if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        this.msg = true;
                       this.message = "Shared successfully." ;
                       Fire.$emit('reload');
                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
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
            loadshares(){

            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/getshare',{'device_id' : this.$route.params.id }).then((response) => {
                      // console.log( response.data.data);
                       if(response.data.data == undefined){
                     window.location.href = '/signin'; 
                      }
                     
                      this.shares = response.data.data;
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
                 window.location.href = '/signin';
 

                  });  
            },
            loadport(){
              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/getports',{'product_id' : this.$route.params.id }).then((response) => {
                      // console.log( response.data.ports);
                       if(response.data.ports == undefined){
                     window.location.href = '/signin'; 
                      }
                     
                      this.ports = response.data.ports;
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
           this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
            this.msg = false;
            this.err = false;
            // console.log(this.$route.params.id);
            this.level = this.$route.params.level;
            this.loadshares();
            this.loadport();
              Fire.$on('reload', () => {
            this.loadshares();
            this.loadport();
          })
        
        }
    }
</script>

