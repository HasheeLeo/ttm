<template>
    <section class="section">
        <div class="container">
            <h1 class="title">List of Rooms</h1>
            <menu-collapse-add data-name="room">
                <form @submit.prevent="addRoom">
                    <b-field label="Name" horizontal>
                        <b-input v-model="newRoomName"/>
                    </b-field>

                    <b-field label="Location" horizontal>
                        <b-select v-model="newRoomLocation">
                        </b-select>
                    </b-field>

                    <b-field horizontal>
                        <input
                            class="button is-primary"
                            id="add-btn"
                            type="submit"
                            value="Add">
                    </b-field>
                </form>
            </menu-collapse-add>

            <template v-if="data.length > 0">
                <b-table
                    bordered
                    hoverable
                    :paginated="data.length > 15 ? true : false"
                    per-page="15"
                    :data="data">

                    <template slot-scope="props">
                        <b-table-column field="name" label="Name">
                            {{ props.row.name }}
                        </b-table-column>

                        <b-table-column field="location" label="Location">
                            {{ props.row.location }}
                        </b-table-column>
                    </template>

                </b-table>
            </template>

            <template v-else>
                <p class="is-size-3">There are no rooms currently.</p>
            </template>
        </div>
    </section>
</template>

<script>
import MenuCollapseAdd from '@/components/MenuCollapseAdd';

export default {
    components: { MenuCollapseAdd },

    data() {
        return {
            data: [],
            newRoomName: '',
            newRoomLocation: ''
        }
    },

    created() {
        this.getRooms();
    },

    methods: {
        addRoom: function() {
            axios
                .post('api/rooms', {
                    name: this.newRoomName,
                    location: this.newRoomLocation
                })
                .then(response => {
                    this.$toast.open({
                        message: 'Successfully added!',
                        type: 'is-success'
                    });
                    this.newRoomName = '';
                    this.newRoomLocation = '';
                    this.getRooms();
                })
                .catch(error => console.log(error));
        },

        getRooms: function() {
            axios.get('api/rooms')
                .then(response => (this.data = response.data))
                .catch(error => console.log(error));
        }
    }
};
</script>

<style scoped>
#add-btn {
    padding: 0 1.4rem;
}
</style>
