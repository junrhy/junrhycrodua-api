<?php

namespace App\Orchid\Screens\Item;

use App\Models\Item;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class ItemEditScreen extends Screen
{
    /**
     * @var Item
     */
    public $item;

    /**
     * Query data.
     *
     * @param Item $item
     *
     * @return array
     */
    public function query(Item $item): array
    {
        return [
            'item' => $item
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->item->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->item->exists ? 'Edit item details' : 'Add new item';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->item->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->item->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->item->exists),

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
        // $properties = (array) json_decode($this->item->properties, true);

        return [
            Layout::rows([
                Input::make('item.name')
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
    public function createOrUpdate(Request $request, Item $item)
    {
        $input = [
            'name' => $request->item['name']
        ];

        $item->fill($input)->save();

        Alert::info('You have successfully created a item.');

        return redirect()->route('platform.item.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Item $item)
    {
        $item->delete();

        Alert::info('You have successfully deleted the item.');

        return redirect()->route('platform.item.list');
    }
}
