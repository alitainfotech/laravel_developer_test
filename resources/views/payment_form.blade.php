<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Purchase ' . $product->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl w-1/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('processPayment', [$product, $price]) }}" method="POST" id="subscribe-form">
                        <label for="card-holder-name" class="block text-sm font-medium leading-6 text-gray-900">Card Holder Name</label>
                        <input id="card-holder-name" type="text" value="{{ $user->name }}"
                            class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                            disabled>
                        @csrf
                        <input type="hidden" name="product" value="{{ $product->id }}">
                        <div class="form-row">
                            <label for="card-element" class="block text-sm font-medium leading-6 text-gray-900">Credit
                                or debit card</label>
                            <div id="card-element" class="form-control"> </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert" class="text-red-500"></div>
                        </div>
                        <div class="stripe-errors"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group mt-6">
                            <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">SUBMIT</button>
                        </div>
                    </form>
                    <script src="https://js.stripe.com/v3/"></script>
                    <script>
                        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
                        var elements = stripe.elements();
                        var style = {
                            base: {
                                color: '#32325d',
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
                        };
                        var card = elements.create('card', {
                            hidePostalCode: true,
                            style: style
                        });
                        card.mount('#card-element');
                        console.log(document.getElementById('card-element'));
                        card.addEventListener('change', function(event) {
                            var displayError = document.getElementById('card-errors');
                            if (event.error) {
                                displayError.textContent = event.error.message;
                            } else {
                                displayError.textContent = '';
                            }
                        });
                        const cardHolderName = document.getElementById('card-holder-name');
                        const cardButton = document.getElementById('card-button');
                        const clientSecret = cardButton.dataset.secret;
                        cardButton.addEventListener('click', async (e) => {
                            console.log("attempting");
                            const {
                                setupIntent,
                                error
                            } = await stripe.confirmCardSetup(
                                clientSecret, {
                                    payment_method: {
                                        card: card,
                                        billing_details: {
                                            name: cardHolderName.value
                                        }
                                    }
                                }
                            );
                            if (error) {
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = error.message;
                            } else {
                                paymentMethodHandler(setupIntent.payment_method);
                            }
                        });

                        function paymentMethodHandler(payment_method) {
                            var form = document.getElementById('subscribe-form');
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'payment_method');
                            hiddenInput.setAttribute('value', payment_method);
                            form.appendChild(hiddenInput);
                            form.submit();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
