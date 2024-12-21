<template>
    <div>
        <h1>Admin Dashboard</h1>
        <div v-for="iban in ibans" :key="iban.id">
            {{ iban.iban_number }}
        </div>
        <button @click="loadMore">Load More</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ibans: [],
            currentPage: 1
        };
    },
    async created() {
        await this.fetchIbans();
    },
    methods: {
        async fetchIbans() {
            try {
                const response = await axios.get(`/api/ibans?page=${this.currentPage}`);
                this.ibans = [...this.ibans, ...response.data.data];
            } catch (error) {
                console.error('Failed to fetch IBANs:', error);
            }
        },
        async loadMore() {
            this.currentPage++;
            await this.fetchIbans();
        }
    }
};
</script>