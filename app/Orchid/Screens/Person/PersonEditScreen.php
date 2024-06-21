<?php

namespace App\Orchid\Screens\Person;

use App\Models\Person;
use App\Models\Client;
use App\Models\Brand;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use Auth;

class PersonEditScreen extends Screen
{
    /**
     * @var Person
     */
    public $person;

    /**
     * Query data.
     *
     * @param Person $person
     *
     * @return array
     */
    public function query(Person $person): array
    {
        return [
            'person' => $person
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->person->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->person->exists ? 'Edit person details' : 'Add new person';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->person->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->person->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->person->exists),

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
        $properties = (array) json_decode($this->person->properties, true);

        $clients = Client::pluck('long_name', 'id');
        $brands = Brand::pluck('long_name', 'id');
        $type = array_key_exists('type', (array) $properties) ? $properties['type'] : null;
        $client = array_key_exists('client', (array) $properties) ? $properties['client'] : null;
        $brand = array_key_exists('brand', (array) $properties) ? $properties['brand'] : null;

        return [
            Layout::rows([
                Select::make('person.type')
                    ->options([
                        'customer' => 'Customer',
                        'member'   => 'Member',
                        'patient' => 'Patient',
                        'other' => 'Others'
                    ])
                    ->value($type)
                    ->title('Type'),

                Select::make('person.client')
                    ->options($clients)
                    ->value($client)
                    ->title('Client'),

                Select::make('person.brand')
                    ->options($brands)
                    ->value($brand)
                    ->title('Brand'),

                Input::make('person.first_name')
                    ->title('First Name')
                    ->placeholder('Enter First Name'),

                Input::make('person.middle_name')
                    ->title('Middle Name')
                    ->placeholder('Enter Middle Name'),

                Input::make('person.last_name')
                    ->title('Last Name')
                    ->placeholder('Enter Last Name'),

                DateTimer::make('person.dob')
                    ->title('Date Of Birth')
                    ->format('Y-m-d'),

                Select::make('person.gender')
                    ->options([
                        'male'   => 'Male',
                        'female' => 'Female',
                    ])
                    ->title('Gender'),

                Input::make('id')->type('hidden')->value($this->person->id)
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Person $person)
    {
        $type = !empty($request->person['type']) ? $request->person['type'] : "";
        $client = !empty($request->person['client']) ? $request->person['client'] : "";
        $brand = !empty($request->person['brand']) ? $request->person['brand'] : "";

        $input = [
            'first_name' => Str::headline($request->person['first_name']),
            'middle_name' => Str::headline($request->person['middle_name']),
            'last_name' => Str::headline($request->person['last_name']),
            'dob' => $request->person['dob'],
            'gender' => $request->person['gender'],
            'properties' => json_encode([
                    'type' => $type,
                    'client_id' => $client,
                    'brand_id' => $brand
                ])
        ];

        $person->fill($input)->save();

        if (!empty($request->id)) {
            Alert::info('You have successfully updated the person record.');
        } else {
            Alert::info('You have successfully added an person into the record.');
            return redirect()->route('platform.person.list');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Person $person)
    {
        $person->delete();

        Alert::info('You have successfully deleted the person.');

        return redirect()->route('platform.person.list');
    }
}
