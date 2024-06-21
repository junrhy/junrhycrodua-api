<?php

namespace App\Orchid\Layouts\Person;

use Orchid\Filters\Filter;
use App\Orchid\Filters\PersonFilter;
use App\Orchid\Filters\ClientFilter;
use App\Orchid\Filters\CreatedFilter;
use Orchid\Screen\Layouts\Selection;

class PersonSelection extends Selection
{
    public $template = self::TEMPLATE_LINE; // or self::TEMPLATE_DROP_DOWN

    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            PersonFilter::class,
            ClientFilter::class,
            CreatedFilter::class,
        ];
    }
}
