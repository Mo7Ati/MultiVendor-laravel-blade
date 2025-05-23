<!-- Shopping Item -->
<a href="javascript:void(0)" class="main-btn">
    <i class="lni lni-cart"></i>
    <span class="total-items">{{ $items->count() }}</span>
</a>
<div class="shopping-item">
    <div class="dropdown-cart-header">
        <span>{{ $items->count() }} Items</span>
        <a href="{{ route('cart.index') }}">View Cart</a>
    </div>
    <ul class="shopping-list">
        @foreach ($items as $item)
            <form action="{{ route('cart.destroy', $item->product->id) }}" method="POST">
                @csrf
                @method('delete')
                <li>
                    <button class="remove" type="submit">
                        <i class="lni lni-close"></i>
                    </button>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{ route('product.show', $item->product) }}"><img
                                src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>
                    <div class="content">
                        <h4><a href="product-details.html">{{ $item->product->name }}</a></h4>
                        <p class="quantity">{{ $item->quantity }}x - <span
                                class="amount">${{ $item->product->price }}</span></p>
                    </div>
                </li>
            </form>
        @endforeach
    </ul>
    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">$134.00</span>
        </div>
        <div class="button">
            <a href="{{ route('checkout.index') }}" class="btn animate">Checkout</a>
        </div>
    </div>
</div>
<!--/ End Shopping Item -->
