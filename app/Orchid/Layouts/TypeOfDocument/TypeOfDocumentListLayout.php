<?php

namespace App\Orchid\Layouts\TypeOfDocument;

use App\Models\TypeOfDocument;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TypeOfDocumentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tods';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->render(function (TypeOfDocument $tod) {
                    return Link::make($tod->id)
                        ->route('platform.tod.edit', ['tod' => $tod->id]);
                }),
            TD::make('name', 'Наименование документа')
                ->render(function (TypeOfDocument $tod) {
                    return Link::make($tod->name)
                        ->route('platform.tod.edit', ['tod' => $tod->id]);
                }),
            TD::make('is_active', 'Активность')->usingComponent(Boolean::class),
        ];
    }
}
