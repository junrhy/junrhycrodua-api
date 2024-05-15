<?php

namespace App\Orchid\Screens\Town;

use App\Models\Town;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class TownEditScreen extends Screen
{
    /**
     * @var Town
     */
    public $town;

    /**
     * Query data.
     *
     * @param Town $town
     *
     * @return array
     */
    public function query(Town $town): array
    {
        return [
            'town' => $town
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->town->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->town->exists ? 'Edit town details' : 'Add new town';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->town->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->town->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->town->exists),

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
                Input::make('town.long_name')
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
    public function createOrUpdate(Request $request, Town $town)
    {
        $input = [
            'long_name' => $request->town['long_name']
        ];

        $town->fill($input)->save();

        Alert::info('You have successfully created a town.');

        return redirect()->route('platform.town.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Town $town)
    {
        $town->delete();

        Alert::info('You have successfully deleted the town.');

        return redirect()->route('platform.town.list');
    }
}
