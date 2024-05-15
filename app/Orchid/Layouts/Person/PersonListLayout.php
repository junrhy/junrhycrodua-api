<?php

namespace App\Orchid\Layouts\Person;

use App\Models\Person;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class PersonListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'people';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('amount', 'Amount')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make($person->amount)
                        ->route('platform.person.edit', $person);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Person $person) {
                    return date_format($person->created_at, "Y-m-d");
                }),
        ];
    }
}
