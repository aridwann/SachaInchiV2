<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class Products extends Component
{
    public $query = "";
    public $products;

    public function mount(){
        $this->products = Product::latest()
        ->where("name", 'like', "%$this->query%")
        ->get();
    }
    
    public function search(){}
    
    public function render()
    {
        return view('livewire.products');
    }
}
