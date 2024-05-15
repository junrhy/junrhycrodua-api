<?php

namespace App\Orchid\Screens\Country;

use App\Models\Country;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class CountryEditScreen extends Screen
{
    /**
     * @var Country
     */
    public $country;

    /**
     * Query data.
     *
     * @param Country $country
     *
     * @return array
     */
    public function query(Country $country): array
    {
        return [
            'country' => $country
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->country->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->country->exists ? 'Edit country details' : 'Add new country';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->country->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->country->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->country->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the record is deleted, all of its resources and data will be permanently deleted.'))
                ->canSee($deletePermission),
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
            Layout::rows([
                Input::make('country.long_name')
                    ->title('Name')
                    ->placeholder('Enter name'),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Country $country)
    {
        $input = [
            'long_name' => $request->country['long_name']
        ];

        $country->fill($input)->save();

        Alert::info('You have successfully created a country.');

        return redirect()->route('platform.country.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Country $country)
    {
        $country->delete();

        Alert::info('You have successfully deleted the country.');

        return redirect()->route('platform.country.list');
    }
}
