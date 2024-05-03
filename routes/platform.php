<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Animal\AnimalEditScreen;
use App\Orchid\Screens\Animal\AnimalListScreen;
use App\Orchid\Screens\Plant\PlantEditScreen;
use App\Orchid\Screens\Plant\PlantListScreen;
use App\Orchid\Screens\Barangay\BarangayEditScreen;
use App\Orchid\Screens\Barangay\BarangayListScreen;
use App\Orchid\Screens\Town\TownEditScreen;
use App\Orchid\Screens\Town\TownListScreen;
use App\Orchid\Screens\Province\ProvinceEditScreen;
use App\Orchid\Screens\Province\ProvinceListScreen;
use App\Orchid\Screens\Country\CountryEditScreen;
use App\Orchid\Screens\Country\CountryListScreen;
use App\Orchid\Screens\State\StateEditScreen;
use App\Orchid\Screens\State\StateListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example screen'));

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

Route::screen('animal/{animal?}', AnimalEditScreen::class)
    ->name('platform.animal.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Animal');
    });

Route::screen('animals', AnimalListScreen::class)
    ->name('platform.animal.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Animal');
    });

Route::screen('plant/{plant?}', PlantEditScreen::class)
    ->name('platform.plant.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Plant');
    });

Route::screen('plants', PlantListScreen::class)
    ->name('platform.plant.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Plant');
    });

Route::screen('barangay/{barangay?}', BarangayEditScreen::class)
    ->name('platform.barangay.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Barangay');
    });

Route::screen('barangays', BarangayListScreen::class)
    ->name('platform.barangay.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Barangay');
    });

Route::screen('town/{town?}', TownEditScreen::class)
    ->name('platform.town.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Town');
    });

Route::screen('towns', TownListScreen::class)
    ->name('platform.town.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Town');
    });

Route::screen('province/{province?}', ProvinceEditScreen::class)
    ->name('platform.province.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Province');
    });

Route::screen('provinces', ProvinceListScreen::class)
    ->name('platform.province.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Province');
    });

Route::screen('country/{country?}', CountryEditScreen::class)
    ->name('platform.country.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Country');
    });

Route::screen('countries', CountryListScreen::class)
    ->name('platform.country.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Country');
    });

Route::screen('state/{state?}', StateEditScreen::class)
    ->name('platform.state.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('State');
    });

Route::screen('states', StateListScreen::class)
    ->name('platform.state.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('State');
    });