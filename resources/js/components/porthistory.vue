<template>
    <div class="">

           <div class="row">
            <div class="col-lg-12">
               <div class="card">
            <div class="card-body">
              <h4 class="card-title alert alert-primary"> History of activies on: {{port_name }} in {{device_name}}</h4>
              <h5>{{ device_name }} was regstered on  {{creation_date}}</h5>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                             <th>Port Name</th>
                             <th>Action taken By</th>
                             <th>Email</th>
                            <th>Action </th>
                            <th>Source of Action</th>
                            <th>Date & Time</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                           <tr v-for="history in histories" :key="history.id">
                                        <td>{{port_name}}</td>
                                        <td>{{history.user_name}}</td>
                                        <td>{{history.user_email}}</td>
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
          </div>


         </div>
     
</template>

<script>
    export default {
        name: "porthistory",
        data(){

        return {
            device_name: "",
            port_name: "",
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
               axios.post('/api/app/porthistory',{'device_id' : this.$route.params.id ,'port_id' : this.$route.params.port}).then((response) => {
                      // console.log( response.data.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                        
                       this.histories = response.data.data ;
                       this.device_name = response.data.device_name ;
                       this.port_name = response.data.port_name ;
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
            },
        
  
          loadscript(){
              $('#tableExample1').DataTable({
                            "dom": 't'
                        });

                        $('#tableExample2').DataTable({
                            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                            "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
                            "iDisplayLength": 6,
                        });

                        $('#tableExample3').DataTable({
                            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                            buttons: [
                                {extend: 'copy',className: 'btn-sm'},
                                {extend: 'csv',title: 'device history', className: 'btn-sm'},
                                {extend: 'pdf', title: 'device history', className: 'btn-sm'},
                                {extend: 'print',className: 'btn-sm'}
                            ]
                        });
          }  
        },
        mounted() {
            this.loaddata();
            this.loadscript();
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
