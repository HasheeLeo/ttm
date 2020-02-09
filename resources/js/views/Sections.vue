<template>
    <section class="section">
        <div class="container">
            <template v-if="data.length > 0">
                <h1 class="title">List of Sections</h1>
                <b-table
                    bordered
                    hoverable
                    :paginated="data.length > 15 ? true : false"
                    per-page="15"
                    :data="data">

                    <template slot-scope="props">
                        <b-table-column field="section" label="Section">
                            {{ `${props.row.department}-${props.row.batch_name}${props.row.name}` }}
                        </b-table-column>

                        <b-table-column field="batch" label="Batch">
                            {{ props.row.batch_id }}
                        </b-table-column>
                    </template>

                </b-table>
            </template>

            <template v-else>
                <p class="is-size-3">There are no sections currently.</p>
            </template>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            data: []
        }
    },

    created() {
        this.getSections();
    },

    methods: {
        getSections: function() {
            axios.get('api/sections')
                .then(response => (this.data = response.data))
                .catch(error => console.log(error));
        }
    }
};
</script>
