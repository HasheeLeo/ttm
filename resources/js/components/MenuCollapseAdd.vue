<template>
    <div id="component">
        <a
            v-show="!isAddMenuVisible"
            class="button is-primary"
            id="mb"
            @click='isAddMenuVisible = !isAddMenuVisible'>

            <span class="icon" aria-hidden>
                <i class="fas fa-plus" aria-hidden></i>
            </span>
            <span v-once :aria-label="'Add new ' + dataName">New</span>
        </a>

        <div v-show="isAddMenuVisible" class="message is-primary">
            <div class="message-header">
                <h5 class="is-size-5">Add New {{ dataName | capitalize }}</h5>
                <button
                    class="delete"
                    type="button"
                    aria-label="close"
                    @click='isAddMenuVisible = false'>
                </button>
            </div>
            <div class="message-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        dataName: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            isAddMenuVisible: false
        }
    }
};
</script>

<style scoped>
#component {
    margin-bottom: 1rem;
}

#mb {
    margin-bottom: 1.5rem;
}
</style>
