<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class PersonFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Person';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [
            'first_name',
            'last_name'
        ];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('first_name', 'like', '%' . $this->request->get('first_name') . '%')
                        ->where('last_name', 'like', '%' . $this->request->get('last_name') . '%');
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('first_name')
                ->type('text')
                ->value($this->request->get('first_name'))
                ->placeholder('Search...')
                ->title('First Name'),

            Input::make('last_name')
                ->type('text')
                ->value($this->request->get('last_name'))
                ->placeholder('Search...')
                ->title('Last Name')
        ];
    }
}
