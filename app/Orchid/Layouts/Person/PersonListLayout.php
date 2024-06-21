<?php

namespace App\Orchid\Layouts\Person;

use App\Models\Person;
use App\Models\Client;
use App\Models\Brand;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Repository;
use Illuminate\Support\Str;

class PersonListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'people', $client, $brand;

    /**
     * ReusableEditLayout constructor.
     *
     * @param array $client
     * @param array $brand
     */
    public function __construct($client = [], $brand = [])
    {
        $this->client = Client::pluck('long_name', 'id');
        $this->brand = Brand::pluck('long_name', 'id');
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('first_name', 'First Name')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make($person->first_name)
                        ->route('platform.person.edit', $person);
                }),

            TD::make('middle_name', 'Middle Name')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make($person->middle_name)
                        ->route('platform.person.edit', $person);
                }),

            TD::make('last_name', 'Last Name')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make($person->last_name)
                        ->route('platform.person.edit', $person);
                }),

            TD::make('dob', 'DOB')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make($person->dob)
                        ->route('platform.person.edit', $person);
                }),

            TD::make('gender', 'Gender')
                ->sort()
                ->render(function (Person $person) {
                    return Link::make(Str::headline($person->gender))
                        ->route('platform.person.edit', $person);
                }),

            TD::make('client', 'Client')
                ->sort()
                ->render(function (Person $person) {
                    $properties = json_decode($person->properties, true);

                    if (array_key_exists('client_id', (array) $properties)) {
                        if (!empty($properties['client_id'])) {
                            return Link::make(Str::headline($this->client[$properties['client_id']]))
                                ->route('platform.person.edit', $person);
                        }
                    }
                }),

            TD::make('brand', 'Brand')
                ->sort()
                ->render(function (Person $person) {
                    $properties = json_decode($person->properties, true);

                    if (array_key_exists('brand_id', (array) $properties)) {
                        if (!empty($properties['brand_id'])) {
                            return Link::make(Str::headline($this->brand[$properties['brand_id']]))
                                ->route('platform.person.edit', $person);
                        }
                    }
                }),

            TD::make('type', 'Type')
                ->sort()
                ->render(function (Person $person) {
                    $properties = json_decode($person->properties, true);

                    if (array_key_exists('type', (array) $properties)) {
                        if (!empty($properties['type'])) {
                            return Link::make(Str::headline($properties['type']))
                                ->route('platform.person.edit', $person);
                        }
                    }
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Person $person) {
                    return date_format($person->created_at, "Y-m-d");
                }),
        ];
    }
}
