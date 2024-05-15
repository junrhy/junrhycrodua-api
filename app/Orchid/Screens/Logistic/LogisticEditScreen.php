<?php

namespace App\Orchid\Screens\Logistic;

use App\Models\Logistic;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class LogisticEditScreen extends Screen
{
    /**
     * @var Logistic
     */
    public $logistic;

    /**
     * Query data.
     *
     * @param Logistic $logistic
     *
     * @return array
     */
    public function query(Logistic $logistic): array
    {
        return [
            'logistic' => $logistic
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->logistic->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->logistic->exists ? 'Edit logistic details' : 'Add new logistic';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->logistic->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->logistic->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->logistic->exists),

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
        // $properties = (array) json_decode($this->logistic->properties, true);

        return [
            Layout::rows([
                Input::make('logistic.destination')
                    ->title('Destination')
                    ->placeholder('Enter destination'),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Logistic $logistic)
    {
        $input = [
            'destination' => $request->logistic['destination']
        ];

        $logistic->fill($input)->save();

        Alert::info('You have successfully created a logistic.');

        return redirect()->route('platform.logistic.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Logistic $logistic)
    {
        $logistic->delete();

        Alert::info('You have successfully deleted the logistic.');

        return redirect()->route('platform.logistic.list');
    }
}
