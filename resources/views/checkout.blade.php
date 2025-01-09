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
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
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
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to
                            Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to
                            Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="payment-form"
                          data-secret="{{ $intent->client_secret }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" placeholder="First Name"></div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid first name is required.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid last name is required.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" placeholder="" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" placeholder="">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping
                                    updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="address2">Address 2 *</label>
                                <input type="text" class="form-control" id="address2" placeholder=""></div>
                            <div class="mb-3">
                                <label for="country">Country *</label>
                                <input type="text" class="form-control" id="country" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="city">city *</label>
                                <input type="text" class="form-control" id="city" placeholder="">
                            </div>

                            <hr class="mb-4">
                            <div class="title"><span>Payment</span></div>
                            <h1>payment</h1>
                            <div class="flex flex-col w-full">
                                <div id="card-element" class="my-4 border-2 p-3">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <div class="col-12 d-flex shopping-box"><a type="submit" class="ml-auto btn hvr-hover">
                                    Place
                                    Order</a></div>
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
