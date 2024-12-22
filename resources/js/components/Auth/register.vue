<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="register">
            <input v-model="name" placeholder="Name" required />
            <input v-model="email" placeholder="Email" required type="email" />
            <input v-model="password" placeholder="Password" required type="password" />
            <input v-model="password_confirmation" type="password" placeholder="Confirm Password" required />
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        async register() {
            try {
                await axios.post('/api/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
                this.$router.push('/login');
            } catch (error) {
                alert('Registration failed. Please check your details and try again.');
                console.error('Registration failed:', error);
            }
        }
    }
};
</script>
