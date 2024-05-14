<?php

namespace App\Orchid\Screens\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class SaleEditScreen extends Screen
{
    /**
     * @var Sale
     */
    public $sale;

    /**
     * Query data.
     *
     * @param Sale $sale
     *
     * @return array
     */
    public function query(Sale $sale): array
    {
        return [
            'sale' => $sale
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->sale->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->sale->exists ? 'Edit sale details' : 'Add new sale';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->sale->exists;
        $deletePermission = Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->sale->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->sale->exists),

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
        // $properties = (array) json_decode($this->sale->properties, true);

        return [
            Layout::rows([
                Input::make('sale.amount')
                    ->title('Amount')
                    ->placeholder('Enter amount'),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Sale $sale)
    {
        $input = [
            'amount' => $request->sale['amount']
        ];

        $sale->fill($input)->save();

        Alert::info('You have successfully created a sale.');

        return redirect()->route('platform.sale.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Sale $sale)
    {
        $sale->delete();

        Alert::info('You have successfully deleted the sale.');

        return redirect()->route('platform.sale.list');
    }
}
