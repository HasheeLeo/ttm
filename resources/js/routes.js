import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './views/Home';
import TimeTables from './views/TimeTables';
import Schedule from './views/Schedule';
import FacultyList from './views/Faculty/List';
import FacultyView from './views/Faculty/View';
import Courses from './views/Courses';
import Rooms from './views/Rooms';
import Sections from './views/Sections';

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/timetables',
            name: 'timetables',
            component: TimeTables
        },
        {
            path: '/schedule',
            name: 'schedule',
            component: Schedule
        },
        {
            path: '/faculty',
            name: 'list.faculty',
            component: FacultyList
        },
        {
            path: '/faculty/:id',
            name: 'view.faculty',
            component: FacultyView,
            props: true
        },
        {
            path: '/courses',
            name: 'courses',
            component: Courses
        },
        {
            path: '/rooms',
            name: 'rooms',
            component: Rooms
        },
        {
            path: '/sections',
            name: 'sections',
            component: Sections
        }
    ]
});
