<?php

namespace App\Orchid\Screens\Logistic;

use App\Orchid\Layouts\Logistic\LogisticListLayout;
use App\Models\Logistic;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class LogisticListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'logistics' => Logistic::filters()->defaultSort('destination', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Logistics';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All logistics";
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
                ->route('platform.logistic.edit')
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
            LogisticListLayout::class
        ];
    }
}
