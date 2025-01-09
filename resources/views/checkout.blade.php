<x-frontend.app>
    <x-slot name="title">
        Checkout
    </x-slot>
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Payment Details</h3>
                        </div>
                        <form action="{{ route('checkout.charge') }}" method="post" id="payment-form" data-secret="{{ $intent->client_secret }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="cardholder-name">Cardholder Name</label>
                                    <input type="text" class="form-control" id="cardholder-name" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid first name is required.</div>
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <div id="card-element" class="my-4 border-2 p-3">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <div class="col-12 d-flex shopping-box">
                                <button type="submit" class="ml-auto btn hvr-hover">
                                    Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> $ 440</div>
                                </div>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> $ 388</div>
                                </div>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-slot name="scripts">
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe({!! json_encode(config('cashier.key')) !!});
            const elements = stripe.elements();

            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Futura", "Helvetica Neue", Helvetica, sans-serif',
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
            };

            const card = elements.create('card', {style: style, hidePostalCode: true});

            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function (event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const form = document.getElementById('payment-form');
            const cardHolderName = document.getElementById('cardholder-name');
            const clientSecret = form.dataset.secret;

            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const {setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card,
                            billing_details: {name: cardHolderName.value}
                        }
                    }
                );

                if (error) {
                    // Inform the user if there was an error.
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    stripeTokenHandler(setupIntent);
                }
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(setupIntent) {
                // Insert the token ID into the form, so it gets submitted to the server
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethod');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                form.submit();
            }

        </script>
    </x-slot>
</x-frontend.app>
