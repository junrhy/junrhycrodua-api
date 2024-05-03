<?php

namespace App\Orchid\Screens\Town;

use App\Orchid\Layouts\Town\TownListLayout;
use App\Models\Town;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TownListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'towns' => Town::filters()->defaultSort('long_name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Towns';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All towns";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.town.edit')
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
            TownListLayout::class
        ];
    }
}
