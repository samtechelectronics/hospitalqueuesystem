<template>
     <div >
        <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            List Of Patients Awaiting Session With Doctor.
                        </div>
                        <div class="panel-body">
                            <p>
                               
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                      <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Room Assigned to</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="doctor in doctors" :key="doctor.id">
                                        <td>{{doctor.username}}</td>
                                        <td> {{doctor.email}}</td>
                                        <td> {{doctor.room_number}}</td>
                                        <td v-if='doctor.room_number == ""' ><a href="" v-on:click.prevent="assignroom(doctor)"><i>Assign to a room</i></a></td>
                                        <td v-if='doctor.room_number != ""'><a href="" v-on:click.prevent="endsession(doctor)"><i>End Room Session</i></a></td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>  
               <div class="modal fade" id="assignroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      
                      <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel"  >Assign a Room to {{doc.username}} </h5>
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           <h4 class="alert alert-danger" v-if="error != ''">{{ error }}</h4>
                        
                             <div class="form-group" >
                                              <label>Room Number</label>
                               <select v-model="room_number" class="form-control " required="">
                              <option   value="1">1 </option>
                              <option   value="2">2</option>
                              <option   value="3">3</option>
                      
                    </select>          
                                             <!--  <has-error :form="form" field="id" ></has-error> -->
                          </div> 
                          
                          
                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                
                                                  <button type="submit"  class="btn btn-primary" v-on:click="assign()" >Assign</button>
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
              error: "",
              room_number: "",
              doc: {},
            doctors: {}
            }
        },
         methods: {
          assignroom(doctor){
             this.error = '';
            this.room_number = "";
            this.doc = doctor;
             $('#assignroom').modal('show');
          },
          endsession(doctor){
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/endsession', {'doctor_id': doctor.id , 'room_id' : doctor.room_number}).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       
                         Fire.$emit('reload'); 
                         this.$swal.fire(
                        'Session Endded Successfully',
                        'Session has been Endded',
                        'success'
                      ) 
                          $('#assignroom').modal('hide');
                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
                      }
                     
                     
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                console.log(err.response.data);
                    // window.location.href = '/signin';
 

                  }); 
          },
          assign(){
            if(this.room_number == ''){
              this.error = "Please select a Room.";
            }else{
              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/assignroom', {'doctor_id': this.doc.id , 'room_id' : this.room_number}).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       
                         Fire.$emit('reload'); 
                         this.$swal.fire(
                        'Room Assigned Successfully',
                        'Room ' + this.room_number + ' Assigned to ' + this.doc.username + ' Successfully',
                        'success'
                      ) 
                          $('#assignroom').modal('hide');
                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
                      }
                     
                     
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                console.log(err.response.data);
                    // window.location.href = '/signin';
 

                  }); 
            }
          },
         getdoctors(){
          this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/getdoctors').then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                      this.doctors = response.data.doctors; 
                       console.log(queue);
                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
                      }
                     
                     
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                console.log(err.response.data);
                    // window.location.href = '/signin';
 

                  }); 
         }
         },
        mounted() {
          if(localStorage.getItem('level') == 'Admin' ){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
           this.getdoctors();
              Fire.$on('reload', () => {
            this.getdoctors();
          });
        }
    }
</script>
