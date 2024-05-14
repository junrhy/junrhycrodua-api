<?php

namespace App\Orchid\Layouts\Inventory;

use App\Models\Inventory;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class InventoryListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'inventories';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('qty', 'Qty')
                ->sort()
                ->render(function (Inventory $inventory) {
                    return Link::make($inventory->qty)
                        ->route('platform.inventory.edit', $inventory);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Inventory $inventory) {
                    return date_format($inventory->created_at, "Y-m-d");
                }),
        ];
    }
}
