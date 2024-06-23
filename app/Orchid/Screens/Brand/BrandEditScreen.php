<?php

namespace App\Orchid\Screens\Brand;

use App\Models\Brand;
use App\Models\Client;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class BrandEditScreen extends Screen
{
    /**
     * @var Client
     */
    public $brand;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Brand $brand): array
    {
        return [
            'brand' => $brand
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->brand->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->brand->exists ? 'Edit brand details' : 'Add new brand';;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $deletePermission = $this->brand->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->brand->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->brand->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the record is deleted, all of its resources and data will be permanently deleted.'))
                ->canSee($deletePermission),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        $properties = (array) json_decode($this->brand->properties, true);

        $clients = Client::pluck('long_name', 'id');

        return [
            Layout::rows([
                Select::make('brand.client_id')
                    ->options($clients)
                    ->title('Client'),

                CheckBox::make('brand.app.rental')
                    ->value(0)
                    ->title('Brand Features')
                    ->placeholder('Rental Management')
                    ->sendTrueOrFalse(),

                CheckBox::make('brand.app.loan')
                    ->value(0)
                    ->placeholder('Loan Management')
                    ->sendTrueOrFalse(),

                CheckBox::make('brand.app.retail')
                    ->value(0)
                    ->placeholder('Retail Management')
                    ->sendTrueOrFalse(),

                CheckBox::make('brand.app.restaurant')
                    ->value(0)
                    ->placeholder('Restaurant Management')
                    ->sendTrueOrFalse(),

                Input::make('brand.long_name')
                    ->title('Name')
                    ->placeholder('Enter long name')
                    ->required(),

                Input::make('brand.short_name')
                    ->title('Name')
                    ->placeholder('Enter short name')
                    ->required(),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Brand $brand)
    {
        $input = [
            'client_id' => $request->brand['client_id'],
            'long_name' => $request->brand['long_name'],
            'short_name' => $request->brand['short_name'],
            'properties' => json_encode([
                    'apps' => $request->brand['app']
                ])
        ];

        $brand->fill($input)->save();

        Alert::info('You have successfully created a brand.');

        return redirect()->route('platform.brand.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Client $brand)
    {
        $brand->delete();

        Alert::info('You have successfully deleted the brand.');

        return redirect()->route('platform.brand.list');
    }
}
