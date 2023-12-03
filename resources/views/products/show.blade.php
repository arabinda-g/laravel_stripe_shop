<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto px-4 py-6">
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-5">
                        <!-- Product Details -->
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>

                        <!-- Stripe Payment Form -->
                        <form id="payment-form" method="post" action="{{ route('purchase', $product->id) }}">
                            @csrf
                            <div id="card-element" class="my-4">
                                <!-- Stripe Elements will be inserted here -->
                            </div>
                            <div id="card-errors" role="alert"></div>
                            <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Confirm Purchase</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element
        var style = {
            base: {
                // Base style here
            },
            invalid: {
                color: '#fa755a',
            }
        };

        // Create an instance of the card Element with the style
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

</x-app-layout>
