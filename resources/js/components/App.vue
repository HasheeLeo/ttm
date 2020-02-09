<template>
    <div>
        <header>
    	   <the-navbar/>
        </header>

        <main>
            <router-view/>
        </main>
    </div>
</template>

<script>
import TheNavbar from './TheNavbar';

export default {
	components: { TheNavbar }
};
</script>
