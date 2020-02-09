<template>
    <div v-if="data.length > 0">
        <h1 class="is-size-1">List of Faculty</h1>
        <a class="button is-primary" @click='showAddMenu = !showAddMenu'>
            <span class="icon" aria-hidden>
                <i class="fas" :class="iconAdd" aria-hidden></i>
            </span>
            <span aria-label="Add New Faculty">New</span>
        </a>

        <div v-show="showAddMenu">
            <h1 class="is-size-1">New Faculty</h1>
            <b-field label="Name" horizontal>
                <b-input v-model="newFacultyName"/>
            </b-field>

            <b-field label="Position" horizontal>
                <b-select v-model="newFacultyPosition">
                </b-select>
            </b-field>

            <b-field horizontal>
                <input class="button is-primary" type="button" value="Add">
            </b-field>
        </div>

        <b-field label="Search by name">
            <b-input v-model="searchQuery" icon="search" placeholder="e.g. Dr. Asad Ali Shah"/>
        </b-field>
        <b-table
            :data="filteredData"
            bordered
            hoverable
            paginated
            per-page="15">

            <template slot-scope="props">
                <b-table-column field="id" label="ID" numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="name" label="Name">
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="position" label="Position">
                    {{ props.row.position }}
                </b-table-column>
            </template>

        </b-table>
    </div>
    <div v-else>
        <p class="is-size-3">There is no faculty currently.</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: [],
            newFacultyName: '',
            newFacultyPosition: '',
            searchQuery: '',
            showAddMenu: false
        }
    },

    computed: {
        iconAdd: function() {
            return {
                'fa-plus': !this.showAddMenu,
                'fa-minus': this.showAddMenu
            }
        },

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
        axios.get('faculty/index')
            .then(response => (this.data = response.data))
            .catch(error => console.log(error));
    }
};
</script>

<style scoped>
.button {
    margin-bottom: 1.5rem;
}
</style>
