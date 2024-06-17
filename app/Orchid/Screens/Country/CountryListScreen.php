<?php

namespace App\Orchid\Screens\Country;

use App\Orchid\Layouts\Country\CountryListLayout;
use App\Models\Country;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CountryListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'countries' => Country::filters()->defaultSort('long_name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Countries';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All countries";
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
                ->route('platform.country.edit')
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
            CountryListLayout::class
        ];
    }
}
