<template>
    <section class="section">
        <div class="container">
            <form @submit.prevent="submitPressed = true">
                <h1 class="title">View a Time Table</h1>
                <b-field horizontal label="Department">
                    <b-field>
                        <b-radio-button v-model="department" native-value="ee">
                            EE
                        </b-radio-button>

                        <b-radio-button v-model="department" native-value="cs">
                            CS
                        </b-radio-button>

                        <b-radio-button v-model="department" native-value="se">
                            SE
                        </b-radio-button>
                    </b-field>
                </b-field>

                <b-field horizontal label="Batch">
                    <b-field>
                        <b-radio-button v-model="batch" :native-value="2014">
                            2014
                        </b-radio-button>

                        <b-radio-button v-model="batch" :native-value="2015">
                            2015
                        </b-radio-button>

                        <b-radio-button v-model="batch" :native-value="2016">
                            2016
                        </b-radio-button>

                        <b-radio-button v-model="batch" :native-value="2017">
                            2017
                        </b-radio-button>
                    </b-field>
                </b-field>

                <b-field horizontal label="Date">
                    <b-datepicker placeholder="dd/mm/yyyy"/>
                </b-field>

                <b-field v-show="!submitPressed" horizontal>
                    <input
                        class="button is-primary"
                        type="submit"
                        value="Submit">
                </b-field>
            </form>

            <time-table
                v-if="submitPressed"
                :initialDayNo="1"
                :department="department"
                :batch="batch"
                initialSection="A"/>
        </div>
    </section>
</template>

<script>
import TimeTable from '@/components/TimeTable';

export default {
    components: { TimeTable },

    data() {
        return {
            batch: undefined,
            department: undefined,

            submitPressed: false
        }
    }
};
</script>

<style scoped>
div.field.is-horizontal {
    margin-top: 1.5rem;
}
</style>
