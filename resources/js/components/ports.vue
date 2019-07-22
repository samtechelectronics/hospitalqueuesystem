<template>
    <div >
    
                <div class="row">
        
                <div class="col-md-3 grid-margin stretch-card" v-for="port in devices" :key="port.id">
              <div class="card">
                <div class="card-body">
                  <p  class="card-title text-md-center text-xl-left">{{port.port_name}}</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <div class="bar-loader" v-if="port.previous_value != port.new_value">
                          <span></span>
                          <span></span>
                          <span></span>
                          <span></span>
                        </div>
                           <div v-bind:id="'switch' + port.id" style="display: none" class="col-md-4 col-sm-6 grid-margin stretch-card">
                     
                        <div class="pixel-loader"></div>
                      
                    </div>
                    
                    <i class=""></i>
                    <button style="width: 60px;height: 60px" v-bind:id="port.id" v-on:click.prevent="switchport(port.id)" v-if="port.state == 1" type="button" class="btn btn-success btn-rounded btn-icon"> <i  v-bind:id="'port' + port.id" style="display: none" class="fa fa-circle-o-notch fa-spin"></i>
                        <i v-bind:id="'normal' + port.id" class="fa fa-power-off"></i>
                      </button>
                       <button style="width: 60px; height: 60px" v-bind:id="port.id" v-on:click.prevent="switchport(port.id)" v-if="port.state == 0" type="button" class="btn btn-default btn-rounded btn-icon">
                        <i  v-bind:id="'normal' + port.id" class="fa fa-power-off"></i><i style="display: none"   v-bind:id="'port' + port.id"  class="fa fa-circle-o-notch fa-spin"></i>
                      </button>

                  </div> 
                   <hr>
                   <div class="row">
                      <div class="col-4">
                       
                        <router-link :to="{ name: 'porthistory', params: {id: $route.params.id , port: port.id} }" data-toggle="tooltip" data-placement="bottom" title="View History Of Action on this Port." ><i class="fa fa-history"></i></router-link>
                      </div>
                      <div class="col-5">
                        
                        <router-link :to="{ name: 'schedule', params: {id: $route.params.id , port: port.id} }"  data-toggle="tooltip" data-placement="bottom" title="Add A Timer schedule to this Port." ><i class="fa fa-calendar"></i></router-link>
                      </div>
                      <div class="col-3 ">
                       <a href=""><i  class="fa fa-pencil" v-on:click.prevent = "editPort(port)" data-toggle="tooltip" data-placement="bottom" title="Edit Port"></i></a>
                        
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
         <!--  <div class="row">
               <div  class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Port Switch Analyses</p>
                  <p class="text-muted font-weight-light">Plot of Online verses Manual Switch Operation</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
             
              </div>
            </div>
          </div> -->
            <div class="modal fade" id="editdevice" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h5 class="modal-title" id="exampleModalLabel" >Edit  Port </h5>
                                                <h4 >{{ error }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="form-group">
                                              <label>Name</label>
                                              <input v-model="form.port_name" placeholder="Name " type="text" name="port_name"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('port_name') }">
                                              <!-- <has-error :form="form" field="product_name" ></has-error> -->
                                            </div>
                                        
                                            </div>
                                            <div class="modal-footer">
                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                  <button type="submit"  class="btn btn-primary" v-on:click.prevent="saveEditPort()">Update Port</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>


        </div>
        
</template>

<script>
  
    export default {
    name: 'ports',
       data(){
        return {
          error: "",
        TimerEvents: null,
        devices: {},
            id: "0",
            form: new Form({
                port_name:'',
                product_id: '',
                id: ''

            })
        }
      },
      methods: {
           editPort(port){
            this.error = "";

          this.form.reset();
          $('#editdevice').modal('show');
          
          this.form.fill(port);
          // console.log(this.form);

          },
        saveEditPort(){



          this.form.post('/api/app/editport').then((response) => {
            // console.log(response);
            if(response.data.code == undefined){
              this.error = "Invalid Data. Check Your Network Connection";
            }
            else if(response.data.code == 200){
               $('#editdevice').modal('hide');
               Fire.$emit('reload');
            }
            else {
              this.error = response.data.error;
            } 
          
          
          });

        
        },
        loadports(){
         
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
                     
                      this.devices = response.data.ports;
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
                   window.location.href = '/signin';
 

                  });   
        },
        switchport(portid){
          $('#'+ portid).attr('disabled','disabled');
         
          $('#normal' + portid).hide();
          $('#port' + portid).show();


             this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/control',{'product_id' : this.$route.params.id , 'portid': portid }).then((response) => {
                      // console.log( response.data);
                      // Fire.$emit('reload');
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
               window.location.href = '/signin';


                  });
                   $('#'+ portid).removeAttr('disabled');
                    
                setTimeout(this.reload(portid),2000);
        },
        reload(portid){
           $('#normal' + portid).show();
          $('#port' + portid).hide();
        }
      },
        mounted() {
            this.loadports();
            this.id = this.$route.params.id;
            // console.log('Component mounted.' + this.$route.params.id );
          //   Fire.$on('reload', () => {
          //   this.loadports();

          // });
           this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
          
          this.TimerEvents =  setInterval(function () {
                  this.loadports();
                }.bind(this), 1000); 
              
            $('[data-toggle="tooltip"]').tooltip();
             
        },
        beforeRouteLeave: function(to, from, next) {
        // console.log("In beforeRouteLeave of AnotherComponent")
        // Indicate to the SubComponent that we are leaving the route
         clearInterval(this.TimerEvents);
        // Make sure to always call the next function, otherwise the hook will never be resolved
        // Ref: https://router.vuejs.org/en/advanced/navigation-guards.html
        next();
    }
    }
</script>
