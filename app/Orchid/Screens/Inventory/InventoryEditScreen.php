<?php

namespace App\Orchid\Screens\Inventory;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class InventoryEditScreen extends Screen
{
    /**
     * @var Inventory
     */
    public $inventory;

    /**
     * Query data.
     *
     * @param Inventory $inventory
     *
     * @return array
     */
    public function query(Inventory $inventories): array
    {
        return [
            'inventory' => $inventories
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->inventory->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->inventory->exists ? 'Edit inventory details' : 'Add new inventory';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->inventory->exists;
        $deletePermission = Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->inventory->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->inventory->exists),

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
        // $properties = (array) json_decode($this->inventory->properties, true);

        return [
            Layout::rows([
                Input::make('inventory.qty')
                    ->title('Qty')
                    ->placeholder('Enter qty'),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Inventory $inventory)
    {
        $input = [
            'qty' => $request->inventory['qty']
        ];

        $inventory->fill($input)->save();

        Alert::info('You have successfully created a inventory.');

        return redirect()->route('platform.inventory.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Inventory $inventory)
    {
        $inventory->delete();

        Alert::info('You have successfully deleted the inventory.');

        return redirect()->route('platform.inventory.list');
    }
}
