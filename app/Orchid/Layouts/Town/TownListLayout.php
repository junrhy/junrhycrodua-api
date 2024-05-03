<?php

namespace App\Orchid\Layouts\Town;

use App\Models\Town;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class TownListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'towns';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (Town $town) {
                    return Link::make($town->long_name)
                        ->route('platform.town.edit', $town);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Town $town) {
                    return date_format($town->created_at, "Y-m-d");
                }),
        ];
    }
}
