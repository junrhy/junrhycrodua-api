<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Illuminate\Support\Str;

class ClientListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'clients';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('long_name', 'Name')
                ->sort()
                ->render(function (Client $client) {
                    return Link::make($client->long_name)
                        ->route('platform.client.edit', $client);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Client $client) {
                    return date_format($client->created_at, "Y-m-d");
                }),
        ];
    }
}
