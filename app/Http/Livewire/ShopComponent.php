<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $pagesize;
    public $sorting;

    public $min_value = 500;
    public $max_value = 200000;


    public function store($product_id, $product_name, $product_regular_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_regular_price)->associate('\App\Models\Product');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Item added to Cart');
        return view('livewire.shop-component');
    }

    public function addToWishlist($product_id, $product_name, $product_regular_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_regular_price)->associate('\App\Models\Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
        return view('livewire.shop-component');
    }


    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                return;
            }
        }
    }


    public function mount()
    {
        $this->sorting = 'default';
        $this->pagesize = 20;
    }

    public function render()
    {

        if ($this->sorting == 'default') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price-high') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price-low') {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->paginate($this->pagesize);
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.shop-component', ['products' => $products, 'categories' => $categories]);
    }
}
