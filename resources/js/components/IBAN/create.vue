<template>
    <div>
        <h1>Validate IBAN</h1>
        <form @submit.prevent="validateIban">
            <input v-model="iban" type="text" placeholder="IBAN" required />
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            iban: ''
        };
    },
    methods: {
        async validateIban() {
            try {
                const token = localStorage.getItem('access_token');
                console.log(token, this.iban);
                let data = {iban: this.iban};
                let headers = {
                    'Authorization': `Bearer ${token}`
                };

                await axios.post('/api/iban', data, {headers});
                
                alert('The IBAN is valid & saved successfully');
            } catch (error) {
                alert('IBAN validation failed. Please try again.');
                console.error('IBAN validation failed:', error);
            }
        }
    }
};
</script>