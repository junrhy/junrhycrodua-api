<?php

namespace App\Orchid\Screens\State;

use App\Models\State;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class StateEditScreen extends Screen
{
    /**
     * @var State
     */
    public $state;

    /**
     * Query data.
     *
     * @param State $state
     *
     * @return array
     */
    public function query(State $state): array
    {
        return [
            'state' => $state
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->state->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->state->exists ? 'Edit state details' : 'Add new state';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->state->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->state->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->state->exists),

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
        // $properties = (array) json_decode($this->state->properties, true);

        return [
            Layout::rows([
                Input::make('state.long_name')
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
    public function createOrUpdate(Request $request, State $state)
    {
        $input = [
            'long_name' => $request->state['long_name']
        ];

        $state->fill($input)->save();

        Alert::info('You have successfully created a state.');

        return redirect()->route('platform.state.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(State $state)
    {
        $state->delete();

        Alert::info('You have successfully deleted the state.');

        return redirect()->route('platform.state.list');
    }
}
