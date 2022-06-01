<template>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Atom BTL Marketing</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                    <div class="navbar-nav" v-if="isLoggedIn">
                        <router-link to="/dashboard">Dashboard</router-link>
                        <a class="nav-item nav-link" @click="logout">Logout</a>
                    </div>

                    <div class="navbar-nav" v-else>
                        <router-link to="/">Home</router-link>
                        <router-link to="/login">Login</router-link>
                        <router-link to="/Register">Register</router-link>
                    </div>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name: "App",
        data () {
            return {
                isLoggedIn: false,
            }
        },
        created () {
            if (window.Laravel.isLoggedin){
                this.isLoggedIn = true
            }
        },
        methods:{
            logout(e){
                e.preventDefault()
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('/api/logout')
                    .then(response =>{
                        if (response.data.success){
                            window.location.href = "/"
                        }
                        else {
                            console.log(response);
                        }
                    })
                    .catch(function (error){
                        console.error(error);
                    });
                })
            }
        },
    }
</script>
