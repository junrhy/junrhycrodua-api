<?php

namespace App\Orchid\Layouts\Subscription;

use App\Models\Subscription;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class SubscriptionListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'subscriptions';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Subscription $subscription) {
                    return Link::make($subscription->name)
                        ->route('platform.subscription.edit', $subscription);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Subscription $subscription) {
                    return date_format($subscription->created_at, "Y-m-d");
                }),
        ];
    }
}
