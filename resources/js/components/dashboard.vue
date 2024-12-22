<template>
    <div>
        <h1>
            IBAN List
            <router-link to="/iban" class="btn-link">+ New IBAN</router-link>
        </h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IBAN</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="iban in ibans" :key="iban.id">
                    <td>{{ iban.id }}</td>
                    <td>{{ iban.iban_number }}</td>
                    <td>{{ iban.user.name }}</td>
                    <td>{{ iban.created_at }}</td>
                    <td>{{ iban.updated_at }}</td>
                    <td>
                        <button v-if="isAdmin" @click="deleteIBAN(iban.id)" class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr v-if="!ibans.length">
                    <td colspan="6">No IBANs found.</td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div v-if="pagination">
            <button :disabled="!pagination.prev_page_url" @click="fetchIBANs(pagination.prev_page_url)">
                Previous
            </button>
            <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
            <button :disabled="!pagination.next_page_url" @click="fetchIBANs(pagination.next_page_url)">
                Next
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            ibans: [], // List of IBANs
            pagination: null, // Pagination data
            isAdmin: false,
        };
    },
    methods: {
        async fetchIBANs(url = '/api/iban/list') {
            try {
                const token = localStorage.getItem('access_token');
                const response = await axios.get(url, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                // Update IBAN list
                this.ibans = response.data.data; 
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page,
                    next_page_url: response.data.next_page_url,
                    prev_page_url: response.data.prev_page_url,
                };
            } catch (error) {
                alert('Error fetching IBANs. Please try again.');
                console.error('Error fetching IBANs:', error);
            }
        },
        async deleteIBAN(id) {
            if (!confirm('Are you sure you want to delete this IBAN?')) {
                return;
            }

            try {
                const token = localStorage.getItem('access_token');
                await axios.delete(`/api/iban/${id}`, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                alert('IBAN deleted successfully.');
                this.fetchIBANs();
            } catch (error) {
                alert('Error deleting IBAN. Please try again.');
                console.error('Error deleting IBAN:', error);
            }
        },
    },
    mounted() {
        this.isAdmin = localStorage.getItem('is_admin') == 'true';
        console.log(this.isAdmin);
        this.fetchIBANs(); 
    },
};
</script>

<style>
    table {
        width: 100%;
        margin-bottom: 20px;
    }

    button {
        margin: 0 5px;
        padding: 5px 10px;
        cursor: pointer;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }
    button.btn-delete {
        background-color: red;
        color: white;
    }
    .btn-link {
        color: white;
        background-color: #333;
        padding: 5px 10px;
        text-decoration: none;
        margin-left: 10px;
        font-size: initial;
        float: right;
    }
</style>
