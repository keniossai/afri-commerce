<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $pagesize;
    public $sorting;
    public $slug;

    public $min_value = 500;
    public $max_value = 200000;

    public function store($product_id,$product_name,$product_regular_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_regular_price)->associate('\App\Models\Product');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Item added to Cart');
        return view('livewire.shop-component');
    }

    

    public function mount($slug){
        $this->slug = $slug;
        $this->sorting = 'default';
        $this->pagesize = 20;
    }

    public function render()
    {

        $category = Category::where('slug',$this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if($this->sorting == 'default')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id', $category_id)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-high')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id', $category_id)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'date')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id', $category_id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-low')
        {
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id', $category_id)->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else{
            $products = Product::whereBetween('regular_price', [$this->min_value, $this->max_value])->where('category_id', $category_id)->paginate($this->pagesize);
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name'=>$category_name]);
    }
}
