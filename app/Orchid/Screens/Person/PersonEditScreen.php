<?php

namespace App\Orchid\Screens\Person;

use App\Models\Person;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
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
        // $properties = (array) json_decode($this->person->properties, true);

        return [
            Layout::rows([
                Input::make('person.first_name')
                    ->title('First Name')
                    ->placeholder('Enter First Name'),
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
        $input = [
            'amount' => $request->person['amount']
        ];

        $person->fill($input)->save();

        Alert::info('You have successfully created a person.');

        return redirect()->route('platform.person.list');
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
