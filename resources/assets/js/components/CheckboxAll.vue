<template>
    <c-checkbox v-model="isCheck"></c-checkbox>
</template>

<script>
    import CCheckbox from './CCheckbox';
    export default {
        name: "CheckboxAll",
        comments: {
            CCheckbox
        },
        props: {
            checkboxItemSelector: {
                type: String
            }
        },
        data() {
            return {
                isCheck: false
            }
        },
        watch: {
            isCheck: (newVal) => {
                $(checkboxItemSelector).val(newVal)
            }
        }
    }
</script>

<style scoped>

</style>