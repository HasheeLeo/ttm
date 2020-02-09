<template>
    <section class="section">
        <div class="container">
            <time-table
            	:initialDayNo="1"
            	department="CS"
            	:batch="2016"
            	initialSection="C"/>
        </div>
    </section>
</template>

<script>
import TimeTable from '@/components/TimeTable';

export default {
    components: { TimeTable }
};
</script>
