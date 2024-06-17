<?php

namespace App\Orchid\Screens\Sale;

use App\Orchid\Layouts\Sale\SaleListLayout;
use App\Models\Sale;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SaleListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'sales' => Sale::filters()->defaultSort('amount', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Sales';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All sales";
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
                ->route('platform.sale.edit')
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
            SaleListLayout::class
        ];
    }
}
