<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $pagesize;
    public $sorting;
    public $q;
    public $search_term;

    public $min_value = 500;
    public $max_value = 200000;

    public function mount(){
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
        $this->sorting = 'default';
        $this->pagesize = 20;
    }

    public function store($product_id,$product_name,$product_regular_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_regular_price)->associate('\App\Models\Product');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Item added to Cart');
        return view('livewire.shop-component');
    }

    
    public function render()
    {

        if($this->sorting == 'default')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name', 'like', $this->search_term)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-high')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name', 'like', $this->search_term)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'date')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name', 'like', $this->search_term)->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-low')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name', 'like', $this->search_term)->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else{
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('name', 'like', $this->search_term)->paginate($this->pagesize);
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.search-component', ['products' => $products, 'categories' => $categories]);
    }
}
