<?php

namespace App\Orchid\Screens\Payment;

use App\Models\Payment;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class PaymentEditScreen extends Screen
{
    /**
     * @var Payment
     */
    public $payment;

    /**
     * Query data.
     *
     * @param Payment $payment
     *
     * @return array
     */
    public function query(Payment $payment): array
    {
        return [
            'payment' => $payment
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->payment->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->payment->exists ? 'Edit payment details' : 'Add new payment';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->payment->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->payment->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->payment->exists),

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
        // $properties = (array) json_decode($this->payment->properties, true);

        return [
            Layout::rows([
                Input::make('payment.amount')
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
    public function createOrUpdate(Request $request, Payment $payment)
    {
        $input = [
            'amount' => $request->payment['amount']
        ];

        $payment->fill($input)->save();

        Alert::info('You have successfully created a payment.');

        return redirect()->route('platform.payment.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Payment $payment)
    {
        $payment->delete();

        Alert::info('You have successfully deleted the payment.');

        return redirect()->route('platform.payment.list');
    }
}
