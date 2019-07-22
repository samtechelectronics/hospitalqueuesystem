<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    name: "logout",
        mounted(){
            // console.log('login out.');
             localStorage.removeItem('access_token');
             localStorage.removeItem('username');
             localStorage.removeItem('email');
             localStorage.removeItem('id');
             localStorage.removeItem('level');
             localStorage.removeItem('created_at');
             window.location.href = '/';


        }
    }
</script>
