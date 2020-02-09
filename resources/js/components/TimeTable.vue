<template>
    <div>
        <template v-if="courses.length > 0 && schedule.length > 0">
            <nav class="time-table-nav has-text-centered">
                <button class="icon is-medium has-text-grey-dark" title="Previous" @click="previous">
                    <i class="fas fa-arrow-left fa-2x" aria-hidden></i>
                </button>

                <span class="is-size-3">{{ dayName }}</span>
                
                <button class="icon is-medium has-text-grey-dark" title="Next" @click="next">
                    <i class="fas fa-arrow-right fa-2x" aria-hidden></i>
                </button>
            </nav>

            <table class="table is-bordered is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th>Timing</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="entry in schedule" :key="entry.id">
                        <td>{{ entry.start_time }} - {{ entry.end_time }}</td>
                        <td>{{ entry.course_name }} {{ evalClassLocation(entry) }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="table is-bordered is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th class="is-hidden-mobile">Subject Code</th>
                        <th>Subject</th>
                        <th>Instructor</th>
                        <th class="is-hidden-mobile">Credit Hrs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses" :key="course.id">
                        <td class="is-hidden-mobile">{{ course.course_code }}</td>
                        <td>{{ course.course_name }}</td>
                        <td>{{ course.faculty_name }}</td>
                        <td class="is-hidden-mobile">{{ evalCourseCredit(course) }}</td>
                    </tr>
                </tbody>
            </table>
        </template>

        <template v-else>
            <p class="is-size-3">There is no schedule currently.</p>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        initialDayNo: {
            type: Number,
            required: true,
            validator: function(value) {
                return value >= 0 && value <= 6;
            }
        },

        department: {
            type: String,
            required: true
        },

        batch: {
            type: Number,
            required: true
        },

        initialSection: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            courses: [],
            schedule: [],
            dayNo: this.initialDayNo,
            section: this.initialSection
        }
    },

    computed: {
        dayName: function() {
            let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return days[this.dayNo];
        }
    },

    watch: {
        department: function() {
            this.getData();
        },

        batch: function() {
            this.getData();
        },

        section: function() {
            this.getSchedule();
        },

        dayNo: function() {
            this.getSchedule();
        }
    },

    created() {
        this.getData();
    },

    methods: {
        evalClassLocation: function(entry) {
            if(entry.room_name)
                return `(${entry.room_name} ${entry.location})`;
            else
                return '';
        },

        evalCourseCredit: function(course) {
            if(course.lab)
                return `${course.credit}+1`;
            else
                return `${course.credit}+0`;
        },

        getData: function() {
            axios
                .get('api/timetables', {
                    params: {
                        dept: this.department,
                        batch: this.batch,
                        section: this.section,
                        dayNo: this.dayNo
                    }
                })
                .then(response => {
                    this.courses = response.data['courses'];
                    this.schedule = response.data['timeTable'];
                })
                .catch(error => console.log(error));
        },

        getSchedule: function() {
            axios.get('api/timetables/schedule', {
                params: {
                    dept: this.department,
                    batch: this.batch,
                    section: this.section,
                    dayNo: this.dayNo
                }
            })
            .then(response => (this.schedule = response.data))
            .catch(error => console.log(error));
        },

        next: function() {
            this.dayNo++;
            if(this.dayNo > 6)
                this.dayNo = 0;
        },

        previous: function() {
            this.dayNo--;
            if(this.dayNo < 0)
                this.dayNo = 6;
        }
    }
};
</script>

<style lang="scss" scoped>
.table {
    margin-top: 1.25rem;
}

.time-table-nav {
    button,
    span {
        vertical-align: middle;
    }

    button {
        background: transparent;
        border: none;
        cursor: pointer;
    }

    span {
        display: inline-block;
        margin: 0 1rem;
        min-width: 20%;
    }
}
</style>
