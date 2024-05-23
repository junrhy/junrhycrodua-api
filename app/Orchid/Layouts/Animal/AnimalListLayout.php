<?php

namespace App\Orchid\Layouts\Animal;

use App\Models\Animal;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class AnimalListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'animals';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Animal $animal) {
                    return Link::make($animal->name)
                        ->route('platform.animal.edit', $animal);
                }),

            TD::make('image', 'Image')
                ->render(function (Animal $animal) {
                    $properties = json_decode($animal->properties, true);

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

            TD::make('pronunciation', 'Pronunciation')
                ->render(function (Animal $animal) {
                    $properties = json_decode($animal->properties, true);

                    if (array_key_exists('pronunciation', (array) $properties)) {
                        return Link::make($properties['pronunciation'])->href($properties['pronunciation'])->target('_BLANK');
                    }
                }),

            TD::make('video', 'Video')
                ->render(function (Animal $animal) {
                    $properties = json_decode($animal->properties, true);

                    if (array_key_exists('video', (array) $properties)) {
                        return Link::make($properties['video'])->href($properties['video'])->target('_BLANK');
                    }
                }),

            TD::make('sound', 'Sound')
                ->render(function (Animal $animal) {
                    $properties = json_decode($animal->properties, true);

                    if (array_key_exists('sound', (array) $properties)) {
                        return Link::make($properties['sound'])->href($properties['sound'])->target('_BLANK');
                    }
                }),

            TD::make('description', 'Description')
                ->render(function (Animal $animal) {
                    $properties = json_decode($animal->properties, true);

                    if (array_key_exists('description', (array) $properties)) {
                        return Link::make($properties['description'])->href($properties['description'])->target('_BLANK');
                    }
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Animal $animal) {
                    return date_format($animal->created_at, "Y-m-d");
                }),
        ];
    }
}
