<template>
	<nav class="navbar is-fixed-top has-shadow" aria-label="app navigation">
        <div class="navbar-brand" :class="{ 'is-active': isActive }">
            <a
                class="navbar-burger"
                aria-label="menu"
                role="button"
                :aria-expanded="isActive"
                @click="isActive = !isActive">
                <span aria-hidden></span>
                <span aria-hidden></span>
                <span aria-hidden></span>
            </a>
        </div>

		<div class="navbar-menu" :class="{ 'is-active': isActive }">
			<div class="navbar-start">
                <router-link class="navbar-item" :to="{ name: 'home' }">Home</router-link>
                <router-link class="navbar-item" :to="{ name: 'timetables' }">Time Tables</router-link>
				<router-link class="navbar-item" :to="{ name: 'schedule' }">Schedule</router-link>
                <router-link class="navbar-item" :to="{ name: 'list.faculty' }">Faculty</router-link>
                <router-link class="navbar-item" :to="{ name: 'courses' }">Courses</router-link>
                <router-link class="navbar-item" :to="{ name: 'rooms' }">Rooms</router-link>
                <router-link class="navbar-item" :to="{ name: 'sections' }">Sections</router-link>
			</div>

			<div class="navbar-end" :class="{ 'is-active': isActive }">
				<a class="navbar-item">Log Out</a>
			</div>
		</div>
	</nav>
</template>

<script>
export default {
    data() {
        return {
            isActive: false
        }
    }
};
</script>
