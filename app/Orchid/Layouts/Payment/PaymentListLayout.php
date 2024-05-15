<?php

namespace App\Orchid\Layouts\Payment;

use App\Models\Payment;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class PaymentListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'payments';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('amount', 'Amount')
                ->sort()
                ->render(function (Payment $payment) {
                    return Link::make($payment->amount)
                        ->route('platform.payment.edit', $payment);
                }),

            TD::make('created_at', 'Added Date')
                ->sort()
                ->render(function (Payment $payment) {
                    return date_format($payment->created_at, "Y-m-d");
                }),
        ];
    }
}
