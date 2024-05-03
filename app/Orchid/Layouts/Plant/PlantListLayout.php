<?php

namespace App\Orchid\Layouts\Plant;

use App\Models\Plant;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class PlantListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'plants';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Plant $plant) {
                    return Link::make($plant->name)
                        ->route('platform.plant.edit', $plant);
                }),

            TD::make('image', 'Image')
                ->render(function (Plant $plant) {
                    $properties = json_decode($plant->properties, true);

                    if (array_key_exists('image', (array) $properties)) {
                        if (!empty($properties['image'])) {
                            return sprintf("<a href='%s' target='_BLANK'><img src='%s' class='img-thumbnail' /></a>", 
                                $properties['image'],
                                $properties['image']
                            );
                        }
                    }
                })
                ->width('100px'),

            TD::make('description', 'Description')
                ->render(function (Plant $plant) {
                    $properties = json_decode($plant->properties, true);

                    if (array_key_exists('description', (array) $properties)) {
                        return Link::make($properties['description'])->href($properties['description'])->target('_BLANK');
                    }
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Plant $plant) {
                    return date_format($plant->created_at, "Y-m-d");
                }),
        ];
    }
}
