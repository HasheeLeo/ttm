<template>
    <section class="section">
        <div class="container">
            <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
                <ul>
                    <li><router-link :to="{ name: 'list.faculty' }">Faculty</router-link></li>
                    <li class="is-active"><a href="#" aria-current="page">{{ data[0]['name'] }}</a></li>
                </ul>
            </nav>

            <h1 class="title">{{ data[0]['name'] }}</h1>
            <p class="is-size-4">Emp ID: {{ id }}</p>

            <h2 class="is-size-3" id="courses-h2">Courses</h2>
            <table class="table is-bordered is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th class="is-hidden-mobile">Subject Code</th>
                        <th>Subject</th>
                        <th class="is-hidden-mobile">Credit Hrs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses" :key="course.id">
                        <td class="is-hidden-mobile">{{ course.course_code }}</td>
                        <td>{{ course.course_name }}</td>
                        <td>{{ evalCourseCredit(course) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        id: {
            required: true
        }
    },

    data() {
        return {
            data: []
        }
    },

    computed: {
        courses: function() {
            
        }
    },

    created() {
        this.getFacultyData();
    },

    methods: {
        getFacultyData: function() {
            axios.get(`api/faculty/${this.id}`)
                .then(response => (this.data = response.data))
                .catch(error => console.log(error));
        }
    }
};
</script>

<style scoped>
.title {
    margin-top: 3rem;
}

#courses-h2 {
    margin-top: 2rem;
}
</style>
