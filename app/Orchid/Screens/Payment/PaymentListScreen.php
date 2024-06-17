<?php

namespace App\Orchid\Screens\Payment;

use App\Orchid\Layouts\Payment\PaymentListLayout;
use App\Models\Payment;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PaymentListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'payments' => Payment::filters()->defaultSort('amount', 'asc')->paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Payments';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All payments";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Add')
                ->icon('plus')
                ->route('platform.payment.edit')
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
            PaymentListLayout::class
        ];
    }
}
