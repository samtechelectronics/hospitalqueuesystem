<template>
    <div >
          <div class="row">

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-filled">

                            <div class="panel-body">
                                <h2 class="m-b-none">
                                    {{queuenumber}} <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i>Patients Waiting on Queue </span>
                                </h2>
                                <div class="large"><h4>Room Name:</h4><h2> {{roomdetails.room_name}}</h2></div>
                                
                                <hr>
                                <h1 v-if="noqueue">NO Patient on Queue</h1>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6"  v-if="!noqueue" >
                     <h2>Current Patient details</h2>

                        <div class="row" >
                            <div class="col-lg-3"> 
                           <img src="/homecss/images/a1.jpg">
                                 
                            </div>
                            <div class="col-lg-7"> 
                                    <table class="table small m-t-sm">
                                        <tbody>
                                             <tr>
                                            <td>
                                                <strong class="c-white"></strong> Name
                                            </td>
                                            <td>
                                                <strong  class="c-white">{{currentpatient.profile.username}}</strong> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> Level of Emergency
                                            </td>
                                            <td>
                                                <strong class="c-white">{{currentpatient.emergency_level}}</strong> 
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <strong class="c-white"></strong> Contact Number
                                            </td>
                                            <td>
                                                <strong class="c-white">{{currentpatient.data.contact}}</strong> 
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <strong class="c-white"></strong> Address
                                            </td>
                                            <td>
                                                <strong class="c-white">{{currentpatient.data.address}}</strong> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> Blood Group
                                            </td>
                                            <td>
                                                <strong class="c-white">{{currentpatient.data.blood_group}}</strong> 
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> genotype
                                            </td>
                                            <td>
                                                <strong class="c-white">{{currentpatient.data.genotype}}</strong> 
                                            </td>
                                        </tr>
                                       
                                        </tbody>
                                    </table> 
                            </div>
                        </div>
                                
                                    <router-link :to="{ name: 'patientrecord', params: {user_id: currentpatient.profile.id } }" >  <a href="" class="btn btn-info"> VIEW USER HISTORY</a></router-link>
                                    <router-link to="/queue">  <a href="" class="btn btn-info"> View Queue</a></router-link>
                                </div>
                                <div class="col-lg-2"  v-if="!noqueue">
                                    <table class="table small m-t-sm">
                                        <tbody>
                                            <h2>Next Patient </h2>
                                      
                                            <tr>
                                            <td>
                                                <strong class="c-white"></strong> Name
                                            </td>
                                            <td>
                                                <strong v-if= "queuenumber > 0 " class="c-white">{{nextpatient.profile.username}}</strong> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> Level of Emergency
                                            </td>
                                            <td>
                                                <strong v-if= "queuenumber > 0 " class="c-white">{{nextpatient.emergency_level}}</strong> 
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                </div>
               <div v-if="!noqueue"> 
                  <hr><hr>
                <div class="row" >
                    <div class="col-lg-3"><h2>Note</h2></div>
                    <div class="col-lg-9"> <textarea class="form-control" v-model="note" rows="10" placeholder="Textarea example text"></textarea></div>
                                           

                </div>
                 <hr><hr>
                <div class="row">
                    <div class="col-lg-3"><h2>Prescription</h2></div>
                    <div class="col-lg-9"> <textarea class="form-control" v-model="prescription" rows="10" placeholder="Textarea example text"></textarea></div>
                                           

                </div>

                 <hr><hr>

                 <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-2"> <button class="btn btn-success"  v-on:click.prevent="savedata()" > Save & Move To Next Patient</button>   </div>
                    <div class="col-lg-5"></div>
                                           

                </div> 
               </div>      

            </div>  
</template>

<script>
    
    export default {
    name: "dashboard",
            data(){
        return {
          noqueue: false,
          err: false,
          error: "",
          note: "",
          prescription: "",
          queuenumber: 0,
          currentpatient: {},
          nextpatient: {},
          roomdetails: {},
          form: new Form({
                doctor_id: "",
                user_id: "",
                queue_id: "",
                note: "",
                prescription: ""
                }),
        }
      },

       methods: {
        savedata(){
          if(this.note != "" && this.prescription != ""){
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                this.form.doctor_id = this.roomdetails.doctor.id;
                this.form.user_id = this.currentpatient.profile.id;
                this.form.queue_id = this.currentpatient.id;
                this.form.note = this.note;
                this.form.prescription = this.prescription;
                console.log(this.form);

               axios.post('/api/app/savedata',this.form).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       Fire.$emit('reload'); 
                         this.$swal.fire(
                        'Data Saved Successfully!',
                        'Moving to next patient.',
                        'success'
                      ) 
                        this.note = "";
                        this.prescription = "";
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
          }else{
            console.log('invald data')
          }
        },
        loaddata(){
           this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/getdata',{'doctor_id' : localStorage.getItem('id') }).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        if(response.data.queue){
                        console.log('queue de');  
                       this.queuenumber =  response.data.queue_number - 1;
                       this.currentpatient =  response.data.current_patient;
                       if(response.data.queue_number > 1){
                       this.nextpatient =  response.data.next_patient; 
                     }
                       
                       this.roomdetails =  response.data.roomdetails;
                      this.noqueue = false;
  
                     }else{
                        console.log('no queue de');  

                      this.noqueue = true;
                     } 
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
        
          this.loaddata();
           Fire.$on('reload', () => {
            this.loaddata();
          });
           this.TimerEvents =  setInterval(function () {
                  this.loaddata();
                }.bind(this), 1000);
        },
    
     beforeCreate: function () {
          // console.log("before Create");
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
                 }
                  );
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
