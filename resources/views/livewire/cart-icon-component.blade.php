<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart"></i>
        @if(Cart::instance('cart')->count()>0)
            <span class="cart-count">{{Cart::instance('cart')->count()}}</span>
        @endif
        <span class="cart-label">Cart</span>
    </a>
    <div class="dropdown-box">
        <div class="cart-header">
            <span>Shopping Cart</span>
            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
        </div>
    
        <div class="products">
            @foreach (Cart::instance('cart')->content() as $item)
                <div class="product product-cart">
                    <div class="product-detail">
                        <a href="{{route('product.details',['slug'=>$item->model->slug])}}" class="product-name">{{substr($item->model->name,0,20)}}...</a>
                        <div class="price-box">
                            <span class="product-quantity">{{$item->qty}}</span>
                            <span class="product-price">₦{{$item->model->regular_price}}</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{route('product.details',['slug'=>$item->model->slug])}}">
                            <img src="{{asset('maya/images/shop/product-')}}{{$item->model->id}}-1.jpg" alt="product" height="84"
                                width="94" />
                        </a>
                    </figure>
                </div>
            @endforeach
        </div>
    
        <div class="cart-total">
            <label>Subtotal:</label>
            <span class="price">₦{{Cart::instance('cart')->total()}}</span>
        </div>
    
        <div class="cart-action">
            <a href="{{route('cart.index')}}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
            <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
        </div>
    </div>

    <!-- End of Dropdown Box -->
</div>