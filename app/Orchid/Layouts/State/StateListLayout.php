<?php

namespace App\Orchid\Layouts\State;

use App\Models\State;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class StateListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'states';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (State $state) {
                    return Link::make($state->long_name)
                        ->route('platform.state.edit', $state);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (State $state) {
                    return date_format($state->created_at, "Y-m-d");
                }),
        ];
    }
}
