<template>
    <div class="form-group">
        <div class="contain-credit">
            <input type="number" hidden="hidden" v-bind:value="credits">
            <a class="btn add-credit" @click="submit" style="width: 100%;">Pay Package</a>
        </div>

        <!-- Modal loading-->
        <div class="modal fade" id="modal_loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="text-align: center; height: 300px; margin-left: -10px;">
                    <div class="modal-header">
                        <label for="card-element">
                            PROCESSING, PLEASE WAIT
                        </label>
                        <button type="button" class="close_loading" data-dismiss="modal" hidden="hidden" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="loading_text">
                        <i class="fa text-white fa-spinner fa-spin mr-2" style="margin-bottom: 2px;"></i> LOADING...
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChargeCredit",
        props: {
            credit: {
                type: String,
                default: '0'
            }
        },
        data() {
            return {
                credits: this.credit
            }
        },
        mounted() {
        },
        methods: {
            submit() {
                $('#modal_loading').modal({
                    keyboard: false,
                    backdrop : false,
                    show : true
                });
                axios.post('api/users/chargeCredit', {
                    credits: this.credits
                }).then((res) => {
                    $('.close_loading').trigger('click');
                    this.$toasted.show(res.data.message);
                }).catch((error) => {
                    this.$toasted.error(error.message);
                })
            }
        }
    }
</script>

<style scoped>
    .contain-credit {
        margin: 20% auto;
    }
    .loading_text {
        margin: 15% auto;
        font-size: 17px;
        font-weight: 500;
    }
</style>