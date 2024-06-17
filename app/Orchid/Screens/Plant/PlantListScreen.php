<?php

namespace App\Orchid\Screens\Plant;

use App\Orchid\Layouts\Plant\PlantListLayout;
use App\Models\Plant;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PlantListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'plants' => Plant::filters()->defaultSort('name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Plants';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All kind of plants";
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
                ->route('platform.plant.edit')
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
            PlantListLayout::class
        ];
    }
}
