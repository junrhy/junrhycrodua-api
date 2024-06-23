<?php

namespace App\Orchid\Layouts\Brand;

use App\Models\Brand;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Illuminate\Support\Str;

class BrandListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'brands';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (Brand $brand) {
                    return Link::make($brand->long_name)
                        ->route('platform.brand.edit', $brand);
                }),

            TD::make('client_id', 'Client')
                ->sort()
                ->render(function (Brand $brand) {
                    return Link::make($brand->client->long_name)
                        ->route('platform.brand.edit', $brand);
                }),

            TD::make('apps', 'Features')
                ->sort()
                ->render(function (Brand $brand) {
                    $properties = json_decode($brand->properties, true);

                    if (array_key_exists('apps', (array) $properties)) {
                        if (!empty($properties['apps'])) {
                            $apps = [];
                            foreach ($properties['apps'] as $key => $value) {
                                if ($value == 1) {
                                    $appName = Str::headline(str_replace('-', ' ', $key));
                                    array_push($apps, $appName);
                                }
                            }

                            return implode(', ', $apps);
                        }
                    }
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Brand $brand) {
                    return date_format($brand->created_at, "Y-m-d");
                }),
        ];
    }
}
