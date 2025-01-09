<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ProductHome extends Component
{
    use WithPagination;

    public string $paginationTheme = 'bootstrap';
    public string $search = '';

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function (Builder $query, $search) {
                $query->where(function (Builder $q) use ($search) {
                    return $q->where('name', 'like', "%$search%");
                });
            })
            ->paginate();

        return view('livewire.product-home', [
            'products' => $products,
        ]);
    }
}
