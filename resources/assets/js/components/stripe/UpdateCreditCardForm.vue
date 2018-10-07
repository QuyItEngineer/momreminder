<template>
    <div>
        <div class="form-group" v-if="stripe_id_response == null">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" style="width: 100%">
                <span class="fw fa fa-address-card"></span> Add Card
            </button>
        </div>
        <div class="form-group" v-else>
            <label for="credit_card_number">Credit card:</label>
            <div class="row" style="display: flex;">
                <div class="col-xs-10">
                    <input type="text" v-model="card_last_four_response"
                           disabled
                           readonly
                           id="credit_card_number" class="form-control">
                </div>
                <div class="col-xs-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Update
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <label for="card-element">
                            CREDIT OR DEBIT CARD
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/update_card" method="post" id="payment-form">
                        <input type="hidden" name="_token" id="csrf-token" v-bind:value="crfs"/>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-row col-8">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button class="btn btn-primary submit_payment">Submit Payment</button>
                        </div>
                    </form>
                </div>
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
        name: "UpdateCreditCardForm",
        props: {
            stripeKey: String,
            stripe_id: String,
            crfs: String,
            card_last_four: String,
        },
        data() {
            return {
                style: {
                    base: {
                        color: '#32325d',
                        lineHeight: '18px',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                },
                stripe_id_response : null,
                card_last_four_response: null,
            }
        },
        mounted() {
            this.initStripe();
            this.initData();
        },
        methods: {
            initData() {
                if ( this.stripe_id ) {
                    this.stripe_id_response = this.stripe_id;
                }
                else {
                    this.stripe_id_response = null;
                }
                if ( this.card_last_four ) {
                    this.card_last_four_response = '**** **** **** ' + this.card_last_four;
                }
                else {
                    this.card_last_four_response = null;
                }
            },
            initStripe() {
                let stripe = Stripe(this.stripeKey);
                console.log(this.stripeKey);
                // Create an instance of Elements.
                let elements = stripe.elements();
                // Create an instance of the card Element.
                let card = elements.create('card', {style: this.style});
                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');
                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', (event) => {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
                // Handle form submission.
                let form = document.getElementById('payment-form');
                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    stripe.createToken(card).then((result) => {
                        if (result.error) {
                            // Inform the user if there was an error.
                            let errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            $('#modal_loading').modal({
                                keyboard: false,
                                backdrop : false,
                                show : true
                            });
                            // Send the token to your server.
                            this.stripeTokenHandler(result.token.id);
                            console.log(result.token);
                        }
                    });
                });
            },
            stripeTokenHandler(stripeToken) {
                axios.post('/api/users/updateCreditCard', {
                    stripeToken
                }).then((res) => {
                    this.stripe_id_response = res.data.data.user.stripe_id;
                    if (res.data.data.user.card_last_four) {
                        this.card_last_four_response = '**** **** **** ' + res.data.data.user.card_last_four;
                    }
                    else {
                        this.card_last_four_response = "";
                    }
                    $('.close_loading').trigger('click');
                    $('.close').trigger('click');
                    this.$toasted.show(res.data.message);
                }).catch((error) => {
                    this.$toasted.error(error.message);
                });
            },
        }
    }
</script>

<style scoped>
    .StripeElement {
        background-color: white;
        /*height: 40px;*/
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
    .loading_text {
        margin: 15% auto;
        font-size: 17px;
        font-weight: 500;
    }
</style>