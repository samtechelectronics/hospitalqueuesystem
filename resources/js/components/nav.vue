 <template>
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="/assets/images/logo.png" style="width: 50px" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini"><img src="/assets/images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="" data-toggle="dropdown" id="profileDropdown">
             {{email}}
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>

          
        </ul>
     <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>
</template>

<script>
    export default {
      data(){
        return {
          username: "",
          email: "",
          id: "",
          created_at: "",
          level: ""
        }
      },
      methods: {
         loaduser(){
                 
       
                    this.email = localStorage.getItem('email');
                
              
            }
      },
        mounted() {
            // console.log('Component mounted.')
           this.loaduser();

        }
    }
</script>















