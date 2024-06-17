<?php

namespace App\Orchid\Screens\Barangay;

use App\Orchid\Layouts\Barangay\BarangayListLayout;
use App\Models\Barangay;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BarangayListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'barangays' => Barangay::filters()->defaultSort('name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Barangays';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All barangays";
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
                ->route('platform.barangay.edit')
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
            BarangayListLayout::class
        ];
    }
}
