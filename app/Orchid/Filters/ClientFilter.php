<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use App\Models\Client;
use App\Models\Brand;

class ClientFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Client';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['client_id'];
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
        return $builder->whereJsonContains('properties->client_id', $this->request->get('client_id'))
                        ->whereJsonContains('properties->brand_id', $this->request->get('brand_id'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        $clients = Client::pluck('long_name', 'id');
        $brands = Brand::pluck('long_name', 'id');

        return [
            Select::make('client_id')
                    ->options($clients)
                    ->value($this->request->get('client_id'))
                    ->title('Client'),

            Select::make('brand_id')
                    ->options($brands)
                    ->value($this->request->get('brand_id'))
                    ->title('Brand'),
        ];
    }
}
