<?php

namespace App\Orchid\Screens\Province;

use App\Orchid\Layouts\Province\ProvinceListLayout;
use App\Models\Province;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProvinceListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'provinces' => Province::filters()->defaultSort('long_name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Provinces';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All provinces";
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
                ->route('platform.province.edit')
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
            ProvinceListLayout::class
        ];
    }
}
