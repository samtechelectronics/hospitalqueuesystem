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
                                        <th>Emergency Level</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="patient in queue" :key="patient.id">
                                        <td>{{patient.user_name}}</td>
                                        <td> {{patient.emergency_level}}</td>
                                        <td>{{patient.created_at}}</td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
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
            queue: {}
            }
        },
         methods: {

         getqueue(){
          this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/getqueue',{'doctor_id' : localStorage.getItem('id') }).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       this.queue = response.data.queue; 
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
           this.getqueue();
        }
    }
</script>
