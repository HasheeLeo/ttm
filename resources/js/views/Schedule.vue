<template>
    <section class="section">
        <div class="container">
            <h1 class="title">List of Schedules</h1>
            <menu-collapse-add data-name="schedule">
                <form @submit.prevent="generateSchedule">
                    <b-field label="Name" horizontal>
                        <b-input v-model="newScheduleName"/>
                    </b-field>

                    <b-field horizontal>
                        <input
                            class="button is-primary"
                            type="submit"
                            value="Generate">
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
                        <b-table-column field="id" label="ID" numeric>
                            {{ props.row.id }}
                        </b-table-column>

                        <b-table-column field="name" label="Name">
                            {{ props.row.name }} {{ isSelectedSchedule(props.row) }}
                        </b-table-column>

                        <b-table-column field="author" label="Author">
                            {{ props.row.author }}
                        </b-table-column>

                        <b-table-column field="lastModified" label="Last Modified">
                            {{ props.row.lastModified }}
                        </b-table-column>
                    </template>

                </b-table>
            </template>

            <template v-else>
                <p class="is-size-3">There are no schedules currently.</p>
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
            newScheduleName: ''
        }
    },

    created() {
        this.getSchedules();
    },

    methods: {
        isSelectedSchedule: function(schedule) {
            if(schedule.isSelected)
                return '(selected)';
            else
                return '';
        },

        getSchedules: function() {
            axios.get('api/schedules')
                .then(response => (this.data = response.data))
                .catch(error => console.log(error));
        },

        generateSchedule: function() {
            axios
                .post('api/schedules', {
                    name: this.newScheduleName
                })
                .then(response => {
                    this.$toast.open({
                        message: 'Success!',
                        type: 'is-success'
                    });
                    this.newScheduleName = '';
                    this.getSchedules();
                })
                .catch(error => console.log(error));
        }
    }
};
</script>
