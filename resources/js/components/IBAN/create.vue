<template>
    <div>
        <h1>Enter IBAN</h1>
        <form @submit.prevent="validateIban">
            <input v-model="iban" type="text" placeholder="IBAN" required />
            <button type="submit">Validate</button>
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
                const response = await axios.post('/api/iban', {
                    iban: this.iban
                });
                alert(response.data.message);
            } catch (error) {
                alert(error.response.data.message);
            }
        }
    }
};
</script>