<template>
  <div >
      
               <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                              
                            </div>
                          History of activies in: {{device_name }}
                        </div>
                        <div class="panel-body">
                            <p>
                               {{ device_name }} was regstered on  {{creation_date}}
                              
                            </p>
                            <div class="table-responsive">

                                <table id="tableExample3" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Device Name</th>
                                        <th>Action taken By</th>
                                        <th>Email</th>
                                        <th>Action taken on Port</th>
                                        <th>Action</th>
                                        <th>Source of Action</th>
                                        <th>Date & Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      

                                    <tr v-for="history in histories" :key="history.id">
                                        <td>{{device_name}}</td>
                                        <td>{{history.user_name}}</td>
                                         <td>{{history.user_email}}</td>
                                        
                                        <td>{{history.port_name}}</td>
                                       
                                       
                                        <td>{{ history.action }}</td>
                                        <td>{{history.source}}</td>
                                        <td>{{history.created_at}}</td>
                                       
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
        name: "devicehistory",
        data(){

        return {
            device_name: "",
            creation_date:"",
            histories: {},
        }
        },
        methods:{
            loaddata(){
              this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
               axios.post('/api/app/devicehistory',{'device_id' : this.$route.params.id }).then((response) => {
                      // console.log( response.data.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        
                       this.histories = response.data.data ;
                       this.device_name = response.data.device_name ;
                       this.creation_date = response.data.creation_date ;
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
            this.loaddata();
             this.level = localStorage.getItem('level');
            console.log(this.level);
            if(this.level == 'Admin' || this.level == 'Super_admin'){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }

            // console.log('data loaded.');
        }
    }
</script>
