const stripe = Stripe("pk_test_51QPpShERYerHePedHI25imoud0rZ9N4cl44Q8c6uA183YDejCtKaqOjAPkQi9B95Loj5A2OwKiMmQXb8F2q5cawd00uASy7ac3");

initialize();

// Create a Checkout Session
async function initialize() {
    const fetchClientSecret = async () => {
        const response = await fetch("http://localhost:8000/stripe/checkout", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrf_token,
            },
        });
        const { clientSecret } = await response.json();
        return clientSecret;
    };

    const checkout = await stripe.initEmbeddedCheckout({
        fetchClientSecret,
    });

    // Mount Checkout
    checkout.mount('#checkout');
}
