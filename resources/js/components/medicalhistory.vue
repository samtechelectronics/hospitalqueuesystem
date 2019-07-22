<template>
     <div >
       <div class="row">
                  <div class="col-lg-6">
                     <h2> Patient History</h2>

                        <div class="row">
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
                                                <strong class="c-white"></strong> {{user.username}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> Email
                                            </td>
                                            <td>
                                                <strong class="c-white"></strong> {{user.email}}
                                            </td>
                                        </tr>
                                      
                                        </tbody>
                                    </table> 
                            </div>
                        </div>
                                
                                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            History Of User Session With Doctor.
                        </div>
                        <div class="panel-body">
                            <p>
                               
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        
                                         </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="data in record" :key="data.id">
                                        <td> {{user.username}}</td>
                                        <td>{{data.doctor_name}}</td>
                                        <td>{{data.created_at}}</td>
                                        
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
        name: "Patientrecord",

        data(){
            return {
            record: {},
            user: {}
            }
        },
         methods: {

         getrecord(){
          this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.get('/api/app/getmedicalhistory',{'doctor_id' : localStorage.getItem('id') , 'user_id' : this.$route.params.user_id }).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       this.record = response.data.history;
                       this.user = response.data.user; 
                       console.log( response.data.history);
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
           this.getrecord();
        }
    }
</script>
