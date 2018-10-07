<template>
    <button :class="btnClass" @click.prevent="submit">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "BulkButton",
        props: {
            btnClass: {
                type: String,
                default: 'btn btn-primary'
            },
            checkboxSelector: {
                type: String
            },
            action: {
                type: String,
                default: 'active'
            },
            resourceUrl: {
                type: String
            }
        },
        methods: {
            submit() {
                let ids = $(this.checkboxSelector + ':checked').map(function() {
                    return $(this).data('id');
                });

                this.axios.post(this.resourceUrl, {
                    action: this.action,
                    ids
                }).then((res) => {
                    if(res.data.success) {
                        this.toasted.success(res.data.message);
                    } else {
                        this.toasted.error(res.data.message);
                    }
                }).catch((error) => {
                    this.toasted.error('Something went wrong!');
                })
            }
        }
    }
</script>

<style scoped>

</style>