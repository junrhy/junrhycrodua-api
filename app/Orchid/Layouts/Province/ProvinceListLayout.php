<?php

namespace App\Orchid\Layouts\Province;

use App\Models\Province;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class ProvinceListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'provinces';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (Province $province) {
                    return Link::make($province->long_name)
                        ->route('platform.province.edit', $province);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Province $province) {
                    return date_format($province->created_at, "Y-m-d");
                }),
        ];
    }
}
