<?php

namespace App\Orchid\Layouts\Sale;

use App\Models\Sale;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class SaleListLayout extends Table
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
                ->render(function (Sale $item) {
                    return Link::make($item->name)
                        ->route('platform.item.edit', $item);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Sale $item) {
                    return date_format($item->created_at, "Y-m-d");
                }),
        ];
    }
}
