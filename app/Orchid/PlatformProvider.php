<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Animals')
            ->icon('fa.dog')
            ->route('platform.animal.list')
            ->title('Data Management'),

            Menu::make('Plants')
            ->icon('fa.tree')
            ->route('platform.plant.list'),

            Menu::make('Locations')
                ->icon('location-dot')
                ->list([
                    Menu::make('Barangays')->route('platform.barangay.list'),
                    Menu::make('Towns')->route('platform.town.list'),
                    Menu::make('Provinces')->route('platform.province.list'),
                    Menu::make('Countries')->route('platform.country.list'),
                    Menu::make('States')->route('platform.state.list'),
                ]),

            Menu::make('Orders')
            ->icon('fa.cash-register')
            ->route('platform.order.list'),

            Menu::make('Logistics')
            ->icon('fa.truck')
            ->route('platform.logistic.list'),
            
            Menu::make('Sales')
            ->icon('fa.credit-card')
            ->route('platform.sale.list'),

            Menu::make('Payments')
            ->icon('fa.credit-card')
            ->route('platform.payment.list'),

            Menu::make('Subscriptions')
            ->icon('fa.credit-card')
            ->route('platform.subscription.list'),
            
            Menu::make('Inventory')
            ->icon('fa.boxes-stacked')
            ->route('platform.inventory.list'),

            Menu::make('Items')
            ->icon('fa.box')
            ->route('platform.item.list'),

            Menu::make('Clients')
            ->icon('fa.people-arrows')
            ->route('platform.client.list'),

            Menu::make('People')
            ->icon('fa.people-group')
            ->route('platform.person.list'),
            
            // Menu::make('Example screen')
            //     ->icon('monitor')
            //     ->route('platform.example')
            //     ->title('Navigation')
            //     ->badge(fn () => 6),

            // Menu::make('Dropdown menu')
            //     ->icon('code')
            //     ->list([
            //         Menu::make('Sub element item 1')->icon('bag'),
            //         Menu::make('Sub element item 2')->icon('heart'),
            //     ]),

            // Menu::make('Basic Elements')
            //     ->title('Form controls')
            //     ->icon('note')
            //     ->route('platform.example.fields'),

            // Menu::make('Advanced Elements')
            //     ->icon('briefcase')
            //     ->route('platform.example.advanced'),

            // Menu::make('Text Editors')
            //     ->icon('list')
            //     ->route('platform.example.editors'),

            // Menu::make('Overview layouts')
            //     ->title('Layouts')
            //     ->icon('layers')
            //     ->route('platform.example.layouts'),

            // Menu::make('Chart tools')
            //     ->icon('bar-chart')
            //     ->route('platform.example.charts'),

            // Menu::make('Cards')
            //     ->icon('grid')
            //     ->route('platform.example.cards')
            //     ->divider(),

            // Menu::make('Documentation')
            //     ->title('Docs')
            //     ->icon('docs')
            //     ->url('https://orchid.software/en/docs'),

            // Menu::make('Changelog')
            //     ->icon('shuffle')
            //     ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
            //     ->target('_blank')
            //     ->badge(fn () => Dashboard::version(), Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.delete', __('Delete')),
        ];
    }
}
