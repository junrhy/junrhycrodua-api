<?php

namespace App\Orchid\Layouts\Barangay;

use App\Models\Barangay;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class BarangayListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'barangays';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Barangay $barangay) {
                    return Link::make($barangay->name)
                        ->route('platform.barangay.edit', $barangay);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Barangay $barangay) {
                    return date_format($barangay->created_at, "Y-m-d");
                }),
        ];
    }
}
