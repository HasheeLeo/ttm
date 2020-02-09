<template>
    <section class="section">
        <div class="container">
            <h1 class="title">List of Faculty</h1>
            <menu-collapse-add data-name="faculty">
                <form @submit.prevent="addFaculty">
                    <b-field label="Name" horizontal>
                        <b-input v-model="newFacultyName"/>
                    </b-field>

                    <b-field label="Position" horizontal>
                        <b-select v-model="newFacultyPosition">
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
                <b-field label="Search by name">
                    <b-input v-model="searchQuery" icon="search" placeholder="e.g. Dr. Asad Ali Shah"/>
                </b-field>
                <b-table
                    bordered
                    hoverable
                    :paginated="data.length > 15 ? true : false"
                    per-page="15"
                    :data="filteredData">

                    <template slot-scope="props">
                        <b-table-column field="empId" label="Employee ID">
                            <router-link :to="{ name: 'view.faculty', params: { id: props.row.id } }">
                                {{ props.row.id }}
                            </router-link>
                        </b-table-column>

                        <b-table-column field="name" label="Name">
                            {{ props.row.name }}
                        </b-table-column>

                        <b-table-column field="position" label="Position">
                            {{ props.row.position }}
                        </b-table-column>
                    </template>

                </b-table>
            </template>

            <template v-else>
                <p class="is-size-3">There is no faculty currently.</p>
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
            newFacultyName: '',
            newFacultyPosition: '',
            searchQuery: ''
        }
    },

    computed: {
        filteredData: function() {
            let regExp = new RegExp(this.searchQuery, 'i');
            let data = [];
            for(let i in this.data) {
                if(this.data[i].name.match(regExp))
                    data.push(this.data[i]);
            }
            return data;
        }
    },

    created() {
        this.getFaculty();
    },

    methods: {
        addFaculty: function() {
            axios
                .post('api/faculty', {
                    name: this.newFacultyName
                })
                .then(response => {
                    this.$toast.open({
                        message: 'Successfully added!',
                        type: 'is-success'
                    });
                    this.newFacultyName = '';
                    this.getFaculty();
                })
                .catch(error => console.log(error));
        },

        getFaculty: function() {
            axios.get('api/faculty')
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
