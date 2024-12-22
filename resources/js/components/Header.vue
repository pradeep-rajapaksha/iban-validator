<template>
    <header>
        <nav>
            <ul>
                <li><router-link to="/dashboard">IBAN Validator</router-link></li>
                <li v-if="isAuthenticated && user">{{ user.name || '' }}</li>
                <li v-if="isAuthenticated"><router-link to="/login" @click.prevent="logout">Logout</router-link></li>
                <li v-if="!isAuthenticated"><router-link to="/register">Register</router-link></li>
            </ul>
        </nav>
    </header>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            user: null,
        };
    },
    computed: {
    ...mapGetters(['isAuthenticated']),
  },
    methods: {
        ...mapActions(['actionLogout']),
        logout() {
            try {
                const token = localStorage.getItem("access_token");
                localStorage.removeItem("access_token");
                localStorage.removeItem("is_admin");
                localStorage.removeItem("user");

                axios.post("/api/auth/logout", null, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                
                this.actionLogout();
                this.$router.push("/login");
            } catch (error) {
                // console.error("Logout failed:", error);
                // alert("Logout failed. Please try again.");
            }
        },
    },
    mounted() {
        this.user = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null;
        console.log(this.user);
    },
};
</script>

<style>
header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: space-between;
    padding: 0;
    margin: 0;
}

nav ul li {
    margin-right: 15px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

nav ul li a:hover {
    text-decoration: underline;
}
</style>
