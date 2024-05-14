<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Order $order) {
                    return Link::make($order->name)
                        ->route('platform.order.edit', $order);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Order $order) {
                    return date_format($order->created_at, "Y-m-d");
                }),
        ];
    }
}
