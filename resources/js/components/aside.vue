  
  <template>
    <div>
          <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                <li class="nav-category">
                    Main
                </li>
                 <li>
                    <router-link to="/dashboard">Dashboard</router-link>
                   
                </li>
                 <li>
                    <router-link to="/profile">Profile</router-link>
                   
                </li>
                <li>
                    
                  
                </li>
            </ul>
        </nav>
    </aside>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
