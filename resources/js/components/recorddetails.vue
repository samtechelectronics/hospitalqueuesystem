<template>
     <div >
     <div class="row">
                <div class="col-lg-4">
                                    <table class="table small m-t-sm">
                                        <tbody>
                                            <h2>Record details</h2>
                                               <tr>
                                            <td>
                                                <strong class="c-white"></strong> Name
                                            </td>
                                            <td>
                                                <strong  class="c-white">{{user.username}}</strong> 
                                            </td>
                                        </tr>
                                       
                                          <tr>
                                            <td>
                                                <strong class="c-white"></strong> Contact Number
                                            </td>
                                            <td>
                                                <strong class="c-white">{{user.contact}}</strong> 
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <strong class="c-white"></strong> Address
                                            </td>
                                            <td>
                                                <strong class="c-white">{{user.address}}</strong> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> Blood Group
                                            </td>
                                            <td>
                                                <strong class="c-white">{{user.blood_group}}</strong> 
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="c-white"></strong> genotype
                                            </td>
                                            <td>
                                                <strong class="c-white">{{user.genotype}}</strong> 
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                  <div class="col-md-8">
                        <div class="panel panel-filled">
                            <h2 class="alert alert-info">NOTE</h2>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                            <h5>
                                                {{record.note}}
                                            </h5>
                            </div>
                                <div class="col-lg-1"></div>
                            </div>
                            <h2 class="alert alert-info">PRESCRIPTION</h2>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                            <h5>
                                               {{record.prescription}}
                                            </h5>
                            </div>
                                <div class="col-lg-1"></div>
                            </div>

                        </div>
                    </div>
            </div>

</div>
</template>
<script>
    export default {
        name: "recorddetails",

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
               axios.post('/api/app/getmedicalreport',{'doctor_id' : localStorage.getItem('id') , 'med_id' : this.$route.params.record_id }).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                       this.record = response.data.report;
                       this.user = response.data.userdata; 
                       console.log( response.data.report);
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
