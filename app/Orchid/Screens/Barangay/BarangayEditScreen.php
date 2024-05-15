<?php

namespace App\Orchid\Screens\Barangay;

use App\Models\Barangay;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class BarangayEditScreen extends Screen
{
    /**
     * @var Barangay
     */
    public $barangay;

    /**
     * Query data.
     *
     * @param Barangay $barangay
     *
     * @return array
     */
    public function query(Barangay $barangay): array
    {
        return [
            'barangay' => $barangay
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->barangay->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->barangay->exists ? 'Edit barangay details' : 'Add new barangay';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->barangay->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->barangay->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->barangay->exists),

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
                Input::make('barangay.name')
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
    public function createOrUpdate(Request $request, Barangay $barangay)
    {
        $image = !empty($request->barangay['image']) ? $request->barangay['image'] : "";
        $description = !empty($request->barangay['description']) ? $request->barangay['description'] : "";

        $input = [
            'name' => $request->barangay['name'],
            'properties' => json_encode([
                    'image' => $image,
                    'description' => $description
                ])
        ];

        $barangay->fill($input)->save();

        Alert::info('You have successfully created a barangay.');

        return redirect()->route('platform.barangay.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Barangay $barangay)
    {
        $barangay->delete();

        Alert::info('You have successfully deleted the barangay.');

        return redirect()->route('platform.barangay.list');
    }
}
