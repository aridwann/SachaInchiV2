<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $query = "";
    
    public function search(){}

    public function render()
    {
        return view('livewire.products', [
            'products' => Product::latest()
                ->where("name", 'like', "%$this->query%")
                ->get()
        ]);
    }
}
