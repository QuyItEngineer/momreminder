<template>
    <span>{{remaining}} characters remaining ({{limit}} maximum)</span>
</template>

<script>
    export default {
        name: "StringRemainingLimit",
        props: {
            limit: {
                type: Number,
                default: 160
            },
            value: String
        },
        computed: {
            remaining() {
                return this.limit - (this.value ? this.value.length : 0);
            }
        },
        watch: {
            remaining: function (val) {
                if (val >= 0) {
                    this.$emit('onLimit')
                }
            }
        }
    }
</script>

<style scoped>

</style>
