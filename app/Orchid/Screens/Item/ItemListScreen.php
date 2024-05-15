<?php

namespace App\Orchid\Screens\Item;

use App\Orchid\Layouts\Item\ItemListLayout;
use App\Models\Item;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ItemListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'items' => Item::filters()->defaultSort('amount', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Items';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All items";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.item.edit')
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
            ItemListLayout::class
        ];
    }
}
