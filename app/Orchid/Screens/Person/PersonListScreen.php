<?php

namespace App\Orchid\Screens\Person;

use App\Orchid\Layouts\Person\PersonListLayout;
use App\Orchid\Layouts\Person\PersonSelection;
use App\Orchid\Filters\PersonFilter;
use App\Orchid\Filters\ClientFilter;
use App\Orchid\Filters\CreatedFilter;
use App\Models\Person;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PersonListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'people' => Person::filters([
                                PersonFilter::class,
                                ClientFilter::class,
                                CreatedFilter::class,
                            ])
                            ->defaultSort('last_name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'People';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All people";
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
                ->route('platform.person.edit')
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
            PersonSelection::class,
            PersonListLayout::class
        ];
    }
}
