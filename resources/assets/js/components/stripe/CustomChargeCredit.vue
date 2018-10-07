<template>
    <div class="form-group">
        <div class="row">
            <div class="col-10 col-sm-12 col-md-10 col-lg-10 col-xl-10 ">
                <input type="number" class="form-control" v-model="credits">
            </div>
            <div class="col-2 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <a class="btn add-credit" @click="submit">Pay Package</a>
            </div>
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
        name: "CustomChargeCredit",
        data() {
            return {
                credits: 0
            }
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
                    this.$toasted.show(error.message);
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