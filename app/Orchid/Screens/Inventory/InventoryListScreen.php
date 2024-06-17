<?php

namespace App\Orchid\Screens\Inventory;

use App\Orchid\Layouts\Inventory\InventoryListLayout;
use App\Models\Inventory;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class InventoryListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'inventories' => Inventory::filters()->defaultSort('qty', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Inventory';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All inventory";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Add')
                ->icon('plus')
                ->route('platform.inventory.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            InventoryListLayout::class
        ];
    }
}
