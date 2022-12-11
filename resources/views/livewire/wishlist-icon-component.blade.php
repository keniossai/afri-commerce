<style>
    .wishlist .cart-count{
        position: absolute;
        width: 1.9rem;
        height: 1.9rem;
        border-radius: 50%;
        font-style: normal;
        z-index: 1;
        /* left: -50px; */
        right: 180px;
        top: 72px;
        font-family: Poppins, sans-serif;
        font-size: 1.1rem;
        font-weight: 400;
        line-height: 1.8rem;
        background: #ed1d25;
        color: #fff;
        text-align: center;
}
    
</style>
<div>
    <a class="wishlist label-down link d-xs-show" href="{{route('wishlist.product')}}">
        <i class="w-icon-heart"></i>
        @if (Cart::instance('wishlist')->count() > 0)
            <span class="cart-count">{{ Cart::instance('wishlist')->count() }}</span>
        @endif
        <span class="wishlist-label d-lg-show">Wishlist</span>
    </a>
</div>