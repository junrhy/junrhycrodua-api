<?php

namespace App\Orchid\Layouts\Country;

use App\Models\Country;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class CountryListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'countries';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (Country $country) {
                    return Link::make($country->long_name)
                        ->route('platform.country.edit', $country);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Country $country) {
                    return date_format($country->created_at, "Y-m-d");
                }),
        ];
    }
}
