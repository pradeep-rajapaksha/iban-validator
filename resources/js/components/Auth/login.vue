<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="_login">
            <input v-model="email" type="email" placeholder="Email" required />
            <input v-model="password" type="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            email: '',
            password: ''
        };
    },
    mounted() {
        const token = localStorage.getItem("access_token");
        if (token) {
            this.$router.push("/dashboard");
        }
    },
    methods: {
        ...mapActions(['actionLogin']),
        async _login() {
            try {
                const response = await axios.post('/api/auth/login', {
                    email: this.email,
                    password: this.password
                });
                localStorage.setItem('user', JSON.stringify(response.data.user));
                localStorage.setItem('access_token', response.data.access_token);
                localStorage.setItem('is_admin', response.data.user.role == 'admin');

                this.actionLogin();
                this.$router.push('/dashboard');
            } catch (error) {
                alert('Login failed. Please check your credentials and try again.');
                console.error('Login failed:', error);
            }
        }
    }
};
</script>
