<?php

namespace App\Orchid\Layouts\Logistic;

use App\Models\Logistic;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class LogisticListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'logistics';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('destination', 'Destination')
                ->sort()
                ->render(function (Logistic $logistic) {
                    return Link::make($logistic->destination)
                        ->route('platform.logistic.edit', $logistic);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Logistic $logistic) {
                    return date_format($logistic->created_at, "Y-m-d");
                }),
        ];
    }
}
