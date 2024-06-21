<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateRange;

class CreatedFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Added Date';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['created_at'];
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
        $start = isset($this->request->get('created_at')['start']) ? $this->request->get('created_at')['start'] : $this->request->get('created_at')['end'];

        return $builder->whereBetween('created_at', [
                        $start,
                        $this->request->get('created_at')['end']
                    ]);
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            DateRange::make('created_at')
                    ->value($this->request->get('created_at'))
                    ->title('Added Date'),
        ];
    }
}
