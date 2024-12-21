<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="login">
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
    methods: {
        ...mapActions(['login']),
        async login() {
            try {
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                });
                this.login(response.data.user);
                this.$router.push('/api/iban');
            } catch (error) {
                console.error('Login failed:', error);
            }
        }
    }
};
</script>