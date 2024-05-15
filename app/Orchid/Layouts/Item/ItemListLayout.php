<?php

namespace App\Orchid\Layouts\Item;

use App\Models\Item;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class ItemListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'items';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Item $item) {
                    return Link::make($item->name)
                        ->route('platform.item.edit', $item);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Item $item) {
                    return date_format($item->created_at, "Y-m-d");
                }),
        ];
    }
}
