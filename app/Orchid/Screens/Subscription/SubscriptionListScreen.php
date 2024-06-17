<?php

namespace App\Orchid\Screens\Subscription;

use App\Orchid\Layouts\Subscription\SubscriptionListLayout;
use App\Models\Subscription;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SubscriptionListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'subscriptions' => Subscription::filters()->defaultSort('name', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Subscriptions';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All subscriptions";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Add')
                ->icon('plus')
                ->route('platform.subscription.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            SubscriptionListLayout::class
        ];
    }
}
