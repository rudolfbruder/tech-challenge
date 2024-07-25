<template>
    <div>
        <h1 class="mb-6">Clients -> {{ client.name }}</h1>

        <div class="flex">
            <div class="w-1/3 mr-5">
                <div class="w-full bg-white rounded p-4">
                    <h2>Client Info</h2>
                    <table>
                        <tbody>
                            <tr>
                                <th class="text-gray-600 pr-3">Name</th>
                                <td>{{ client.name }}</td>
                            </tr>
                            <tr>
                                <th class="text-gray-600 pr-3">Email</th>
                                <td>{{ client.email }}</td>
                            </tr>
                            <tr>
                                <th class="text-gray-600 pr-3">Phone</th>
                                <td>{{ client.phone }}</td>
                            </tr>
                            <tr>
                                <th class="text-gray-600 pr-3">Address</th>
                                <td>{{ client.address }}<br />{{ client.postcode + ' ' + client.city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-2/3">
                <div>
                    <button class="btn"
                        :class="{ 'btn-primary': currentTab == 'bookings', 'btn-default': currentTab != 'bookings' }"
                        @click="switchTab('bookings')">Bookings</button>
                    <button class="btn"
                        :class="{ 'btn-primary': currentTab == 'journals', 'btn-default': currentTab != 'journals' }"
                        @click="switchTab('journals')">Journals</button>
                </div>

                <!-- Bookings -->
                <div class="bg-white rounded p-4" v-if="currentTab == 'bookings'">
                    <h3 class="mb-3">List of client bookings</h3>
                    <div class="dropdown my-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtering
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <span class="dropdown-item" @click="getBookings('all')">All bookings</span>
                            <span class="dropdown-item" @click="getBookings('past')">Past bookings</span>
                            <span class="dropdown-item" @click="getBookings('future')">Future bookings</span>
                        </div>
                    </div>
                    <template v-if="bookings && bookings.length > 0">
                        <table>
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="booking in bookings" :key="booking.id">
                                    <td>{{ booking.time }}</td>
                                    <td>{{ booking.notes }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            @click="deleteBooking(booking)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>

                    <template v-else>
                        <p class="text-center">The client has no bookings.</p>
                    </template>

                </div>

                <!-- Journals -->
                <div class="bg-white rounded p-4" v-if="currentTab == 'journals'">
                    <h3 class="mb-3">List of client journals</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        New Journal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Journal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="dateOfJournal">Date of Journal</label>
                                        <input type="date" v-model="written_at" class="form-control" id="dateOfJournal" />
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content of the journal</label>
                                        <textarea class="form-control" v-model="content" id="content" rows="3"></textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" @click="submitJournal">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th>Written at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="journal in journals" :key="journal.id">
                            <td>{{ journal.content }}</td>
                            <td>{{ journal.written_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    :href="`/clients/${client.id}/journal/${journal.id}`">View</a>
                                <button class="btn btn-danger btn-sm" @click="deleteJournal(journal.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div></template>

<script>
import axios from 'axios';

export default {
    name: 'ClientShow',

    props: ['client'],

    data() {
        return {
            currentTab: 'bookings',
            bookings: [],
            written_at: "",
            content: '',
            journals: []
        }
    },

    methods: {
        switchTab(newTab) {
            this.currentTab = newTab;
        },

        deleteBooking(booking) {
            axios.delete(`/bookings/${booking.id}`);
        },
        getBookings(type) {
            axios.get(`/api/client/${this.client.id}/bookings?type=${type}`).then((res) => {
                this.bookings = res.data.data
            })
        },
        submitJournal() {
            axios.post(`/api/client/${this.client.id}/journal`, {
                content: this.content,
                written_at: this.written_at,
                client_id: this.client.id
            }).then((res) => {
                console.log(res.data.data);
                this.$swalSuccessToast('Journal record created')
                this.getJournals()
                $('#exampleModal').modal('hide')
            }).catch((e) => {
                this.$swalErrorToast('Oooops, there was a problem')
            })
        },
        getJournals() {
            axios.get(`/api/client/${this.client.id}/journals`).then((res) => {
                this.journals = res.data.data
            })
        },
        deleteJournal(journalId) {
            axios.delete(`/api/client/${this.client.id}/journal/${journalId}`).then((res) => {
                this.$swalSuccessToast('Journal record deleted')
                this.getJournals()
            })
        }
    },

    mounted() {
        this.bookings = this.client.bookings_order_by_newest
        this.getJournals();
    }
}
</script>
