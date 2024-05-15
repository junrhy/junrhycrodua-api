<?php

namespace App\Orchid\Screens\Person;

use App\Orchid\Layouts\Person\PersonListLayout;
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
            'people' => Person::filters()->defaultSort('amount', 'asc')->paginate()
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
            Link::make('Create new')
                ->icon('pencil')
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
            PersonListLayout::class
        ];
    }
}
