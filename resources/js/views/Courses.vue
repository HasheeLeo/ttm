<template>
    <section class="section">
        <div class="container">
            <h1 class="title">List of Courses</h1>
            <menu-collapse-add data-name="course">
                <form @submit.prevent="addCourse">
                    <b-field label="Code" horizontal>
                        <b-input v-model="newCourseCode"/>
                    </b-field>

                    <b-field label="Name" horizontal>
                        <b-input v-model="newCourseName"/>
                    </b-field>

                    <b-field label="Department" horizontal>
                        <b-select v-model="newCourseDepartment">
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
                        <b-table-column field="code" label="Code">
                            {{ props.row.code }}
                        </b-table-column>

                        <b-table-column field="name" label="Name">
                            {{ props.row.name }}
                        </b-table-column>

                        <b-table-column field="credit" label="Credit">
                            {{ evalCourseCredit(props.row) }}
                        </b-table-column>

                        <b-table-column field="department" label="Department">
                            {{ props.row.department }}
                        </b-table-column>
                    </template>

                </b-table>
            </template>

            <template v-else>
                <p class="is-size-3">There are no courses currently.</p>
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
            newCourseCode: '',
            newCourseName: '',
            newCourseDepartment: ''
        }
    },

    created() {
        this.getCourses();
    },

    methods: {
        addCourse: function() {
            axios
                .post('api/courses', {
                    code: this.newCourseCode,
                    name: this.newCourseName
                })
                .then(response => {
                    this.$toast.open({
                        message: 'Successfully added!',
                        type: 'is-success'
                    });
                    this.newCourseCode = '';
                    this.newCourseName = '';
                    this.getCourses();
                })
                .catch(error => console.log(error));
        },

        evalCourseCredit: function(course) {
            if(course.lab)
                return `${course.credit}+1`;
            else
                return `${course.credit}+0`;
        },

        getCourses: function() {
            axios.get('api/courses')
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
