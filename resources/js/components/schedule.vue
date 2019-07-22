<template>
    <div class="">
       
             <!-- <div  ><button class="btn btn-success" v-on:click.prevent="reload()">Set A Schedule</button></div> -->
              <div class="row" v-show="setschedule">
                <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Schedule Port Action</h4>
                  <p class="card-description">
                      <h4 class="alert alert-success" v-if="msg" >{{message}}</h4>      
                      <h4 class="alert alert-danger" v-if="err" >{{error}}</h4> 
                   </p>
                  <form class="form-inline" @submit.prevent="schedule()">
                    <label  for="inlineFormInputGroupUsername" >Execute Time</label>

                    <date-picker v-model="form.Executetime"  :config="{format: 'DD/MM/YYYY HH:mm:ss'}" @dp-change="asigndate" ></date-picker>
                  
                    
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Action</label>
                      <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Action</div>
                      </div>
                    <div class="input-group mb-2 mr-sm-2">
                        <select v-model="form.action" class="form-control"  id="inlineFormInputGroupUsername2">
                              <option value="on">ON</option>
                              <option value="off">OFF</option>
                             
                         </select>
                      </div>
                    </div>
                   
                    <button class="btn btn-primary mb-2" type="submit">Schedule</button>
                  </form>
                </div>
              </div>
            </div>
              
              </div>
                 <div class="row">
            <div class="col-lg-12">
               <div class="card">
            <div class="card-body">
              <h3 class="alert alert-success">Schedule History</h3>
                <p>
                History of all Schedules set by you on this port.
                 </p>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>Scheduled By</th>
                          <th>Device Name</th>
                           <th>Port Name</th>
                            <th>Status of Schedule</th>
                            <th>Action to perform</th>
                            <th>Execute time</th>
                            <th>Remaining Time</th>
                            <th>Creation Date</th>
                            <th>Cancel Shedule</th>  
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="schedule in schedules" :key="schedule.id">
                                        <td>{{schedule.user_name }}</td>
                                       
                                        <td>{{schedule.device_name }}</td>
                                         <td>{{schedule.port_name }}</td>
                                         <td>{{schedule.status}}</td>
                                         <td>{{schedule.action}}</td>
                                         <td>{{schedule.Executetime}}</td>
                                         <td>
                                           {{schedule.time_left}}
                                         </td>
                                          <td>  {{schedule.created_at }}</td>

                                          <td >
                                            <span class="alert alert-danger" v-if="schedule.status == 'pending'" ><i v-on:click.prevent = "Cancelschedule(schedule.id)" class="fa fa-times"></i></span>
                                            
                                          
                                           
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
        name: "schedule",
        data(){
            return {
            msg: false,
            err: false,
            setschedule: true,
            error: "",
            message: "",
            schedules: {},
            date: "",
            form: new Form({
                Executetime: "",
                action: "",
                device_id: "",
                port_id: ""
                }),
            }
        },
        methods:{
          asigndate(){
            this.date = this.form.Executetime;
          },
          reload(){

            // console.log('reloading');
            window.location.reload(false);
            this.setschedule = true;
          },
          Cancelschedule(id){
            this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }
          axios.post('/api/app/cancelschedule',{ "schedule_id" : id }).then((response) => {
                      // console.log( response.data);
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
          schedule(){
              this.err =false;
              this.msg = false;
            this.form.Executetime = $('#result').val();
            // console.log(this.form);
            if(this.form.Executetime == ""){
              this.err =true;
              this.error = "Please select a valid Execute Time.";
            }else if(this.form.action == ""){
              this.err =true;
              this.error = "Please select an Action to Execute.";
            }else{
              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }
              this.form.device_id = this.$route.params.id;
              this.form.port_id = this.$route.params.port;
              this.form.Executetime = this.date;
              console.log(this.form);
               axios.post('/api/app/setschedule',this.form).then((response) => {
                      // console.log( response.data);
                       if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        this.msg = true;
                       this.message = "The Schedule has been Added successfully." ;
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
            loadschedule(){
                 this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/schedules',{'device_id' : this.$route.params.id ,'port_id' : this.$route.params.port}).then((response) => {
                      // console.log( response.data.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        
                       this.schedules = response.data.data ;
                       


                      }
                      else {
                        this.err = true;
                        this.error = response.data.error; 
                      }
                     
                      this.shares = response.data.data;
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
            this.loadschedule();
            this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
            // console.log('st.');
             Fire.$on('reload', () => {
            this.loadschedule();
          })
             // localStorage.removeItem('user-token')
        }
    }
</script>