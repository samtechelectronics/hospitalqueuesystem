<template>
     <div >
       <div class="row">
            <div class="col-md-3"></div>
               <div class="col-md-6">
                    
                  <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                           Assign Card to Patient.
                        </div>
                        <div class="panel-body">

                            <p>Assign A Smart Card to a Patient. <code>&lt;register the card on the device to get the tag number&gt;</code>, </p>

                            
                               <hr><h3 class="alert alert-info">Personal Details</h3><hr>
                                <div class="form-group"><label for="exampleInputEmail1">Patient`s Email address</label> <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" placeholder="Email"></div>
                                 <div class="form-group"><label for="exampleInputEmail1">Tag Number</label> <input v-model="form.tag_code" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tag Number"></div>
                                 <label>Date of Birth</label>
                                <date-picker v-model="form.date_of_birth"  :config="{format: 'YYYY-MM-DD '}" ></date-picker>
                 
                                 <hr><h3 class="alert alert-info">Medical Details</h3><hr>
                                
                              <!-- A, B, AB and O -->
                                  <div class="form-group" >
                                              <label>Blood Group</label>
                               <select  class="form-control " v-model="form.blood_group"  required="">
                              <option   value="A">A</option>
                              <option   value="B">B</option>
                              <option   value="AB">AB</option>
                              <option   value="O">O</option>
                      
                    </select>          
                                             <!--  <has-error :form="form" field="id" ></has-error> -->
                          </div>
                               <div class="form-group" >
                                              <label>Genotype</label>
                               <select  class="form-control " v-model="form.genotype"  required="">
                              <option   value="AA">AA</option>
                              <option   value="AO">AO</option>
                              <option   value="BB">BB</option>
                              <option   value="BO">BO</option>
                              <option   value="AB">AB</option>
                              <option   value="OO">OO</option>
                      
                    </select>          
                                             <!--  <has-error :form="form" field="id" ></has-error> -->
                          </div>  
                           <hr><h3 class="alert alert-info">Contact Details</h3><hr>
                           <div class="form-group"><label for="exampleInputEmail1">Contact Number</label> <input v-model="form.contact"  type="number" class="form-control" id="exampleInputEmail1" placeholder="Contact"></div>
                           <div class="form-group"><label for="exampleInputEmail1">Contact Address</label> <input v-model="form.address"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Address"></div>
                           <hr><hr>
                                <button type="submit" v-on:click="senddata()" class="btn btn-success">Submit</button>
                            
                        </div>
                    </div>
                </div>
            <div class="col-md-3"></div>

        </div>

            


    </div>
</template>

<script>
    export default {
        data(){
            return {
              date: "",
               form: new Form({
                email: "",
                date_of_birth: "",
                tag_code: "",
                blood_group: "",
                genotype: "",
                contact: "",
                address: ""
                }),
            }
        },
        methods: {
          senddata(){
            console.log(this.form);
             this.token = "Bearer "  + localStorage.getItem('access_token');
                        axios.defaults.headers = {
                                'Content-Type': 'application/json',
                                 Authorization: this.token
                            }

                // localStorage.setItem('access_token', data.access_token);
                
                console.log(this.form);

               axios.post('api/app/createprofile',this.form).then((response) => {
                 console.log(response.data);
                    if(response.data.code == undefined){
                       this.err = true;
                       this.error = "Invalid Details, Please Confirm Your Details or Check Your Network Connection";
                      }
                      else if (response.data.code == 200){
                      
                         this.$swal.fire(
                        'Patient profile Created Successfully!',
                        'Patient profile Created !.',
                        'success'
                      ) 
                         window.location.href = '/profiles';
                      }
                      else {
                       
                         this.$swal.fire(
                        'An Error Occurred!!!',
                         response.data.error,
                        'error'
                        )
                      }
                     
                     
                    }).catch(err => {
                    // localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
                this.errorstat = true;
                this.error = err.response.data; 
                // console.log(err.response.data);
                    // window.location.href = '/signin';
 

                  }); 
          },
          assigndate(){
            this.form.date_of_birth =  this.date;
          }
        },
        mounted() {
          if(localStorage.getItem('level') == 'Admin' ){
              $('#admin').show();
            }else{
               $('#admin').hide();
            }
            console.log('login out.');
             // localStorage.removeItem('user-token')
        }
    }
</script>
