<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class DashboardIndex extends Component
{
    use WithPagination;

    public $query = '';
    
    public function updatingQuery(){
        $this->resetPage();
    }

    public function updateishide(Product $product)
    {
        $product->update([
            'ishide' => !$product->ishide
        ]);
        
        session()->flash('success', 'Status produk berhasil diperbarui.');
    }

    public function destroy(Product $product){
        if (!str_contains($product->img, 'img/')) {
            Storage::disk(config('filesystems.default_public_disk'))->delete(str_replace('storage/', '', $product->img));
        }
        $product->delete();
        session()->flash('success', 'Produk berhasil dihapus.');
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
