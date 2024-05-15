<?php

namespace App\Orchid\Screens\State;

use App\Orchid\Layouts\State\StateListLayout;
use App\Models\State;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class StateListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'states' => State::filters()->defaultSort('long_name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'States';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All states";
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
                ->route('platform.state.edit')
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
            StateListLayout::class
        ];
    }
}
