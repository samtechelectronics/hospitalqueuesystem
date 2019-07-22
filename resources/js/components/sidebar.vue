<template>
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
         
           <li class="nav-item">
            <router-link to="/dashboard">
            <a class="nav-link" >
            
              <i class="ti-home menu-icon"></i>
             Dashboard
            </a>
            </router-link>
          </li>
          <li class="nav-item">
           <router-link to="/logout">
            <a class="nav-link" >
            
              <i class="ti-lock menu-icon"></i>
            logout
               </a>
               </router-link>    
           </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-layers-alt menu-icon"></i>
              <span class="menu-title">Admin Section</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><router-link to="/admin/dashboard"> <a class="nav-link" > Dashboard </a>
                </router-link></li>
                <li class="nav-item"> <router-link to="/admin/users"> <a class="nav-link" > Users</a> </router-link></li>
                <li class="nav-item"> <router-link to="/admin/devices"> <a class="nav-link"> Devices </a></router-link></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html">Statistics </a></li> -->
                <!-- <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li> -->
              </ul>
            </div>
          </li>
        </ul>
      </nav>
</template>

<script>
    export default {
      data(){
        return {
         
          level: "member"
        }
      },
      methods: {
         loaduser(){
                 
          this.level = localStorage.getItem('level');
                   
                
              
            }
      },
        mounted() {
            // console.log('Component mounted.')
          this.loaduser();
             Fire.$on('reload', () => {
             this.loaduser();
           
          })

        },
          beforeCreate: function () {
             this.level = localStorage.getItem('level');
        
        }
    }
    
</script>




 