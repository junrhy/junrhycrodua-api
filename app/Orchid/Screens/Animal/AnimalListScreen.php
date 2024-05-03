<?php

namespace App\Orchid\Screens\Animal;

use App\Orchid\Layouts\Animal\AnimalListLayout;
use App\Models\Animal;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class AnimalListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'animals' => Animal::filters()->defaultSort('name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Animals';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All kind of animals";
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
                ->route('platform.animal.edit')
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
            AnimalListLayout::class
        ];
    }
}
