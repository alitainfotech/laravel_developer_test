<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    <h1>Payment Form</h1>
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <form action="{{ route('subscription.create') }}" method="post">
        @csrf

        <input type="hidden" name="product" id="product" value="{{ $product->id }}">
        <label for="payment_method">Card details:</label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        <br>
        <button type="submit">Submit Payment</button>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();

        // Create an instance of the card Element.
        const card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        const form = document.querySelector('form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                // Inform the user if there was an error.
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send the token to your server.
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = 'payment_method';
                tokenInput.value = token.id;
                form.appendChild(tokenInput);

                // Submit the form.
                form.submit();
            }
        });
    </script>
</body>
</html>
