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
    protected $target = 'sales';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('amount', 'Amount')
                ->sort()
                ->render(function (Sale $sale) {
                    return Link::make($sale->amount)
                        ->route('platform.sale.edit', $sale);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Sale $sale) {
                    return date_format($sale->created_at, "Y-m-d");
                }),
        ];
    }
}
