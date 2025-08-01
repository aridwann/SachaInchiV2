<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardIndex extends Component
{
    use WithPagination;

    public $query = '';
    
    public function updatingQuery(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dashboard-index', [
            'products' => Product::latest()
                ->where("name", 'like', "%$this->query%")
                ->paginate(6)
        ]);
    }
}
