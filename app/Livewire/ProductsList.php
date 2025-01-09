<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductsList extends Component
{
    use WithPagination;

    public string $paginationTheme = 'tailwind';
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

        return view('livewire.products-list', [
            'products' => $products,
        ]);
    }
}
