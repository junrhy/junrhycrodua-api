<?php

namespace App\Orchid\Screens\Province;

use App\Models\Province;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class ProvinceEditScreen extends Screen
{
    /**
     * @var Province
     */
    public $province;

    /**
     * Query data.
     *
     * @param Province $province
     *
     * @return array
     */
    public function query(Province $province): array
    {
        return [
            'province' => $province
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->province->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->province->exists ? 'Edit province details' : 'Add new province';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->province->exists;
        $deletePermission = Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->province->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->province->exists),

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
                Input::make('province.long_name')
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
    public function createOrUpdate(Request $request, Province $province)
    {
        $input = [
            'long_name' => $request->province['long_name']
        ];

        $province->fill($input)->save();

        Alert::info('You have successfully created a province.');

        return redirect()->route('platform.province.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Province $province)
    {
        $province->delete();

        Alert::info('You have successfully deleted the province.');

        return redirect()->route('platform.province.list');
    }
}
