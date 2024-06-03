<?php

namespace App\Orchid\Layouts\SemesterOfStudy;

use App\Models\SemesterOfStudy;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SemesterOfStudyListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'sos';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->render(function (SemesterOfStudy $sos) {
                    return Link::make($sos->id)
                        ->route('platform.sos.edit', ['sos' => $sos->id]);
                }),
            TD::make('name', 'Наименование документа')
                ->render(function (SemesterOfStudy $sos) {
                    return Link::make($sos->name)
                        ->route('platform.sos.edit', ['sos' => $sos->id]);
                }),
            TD::make('is_active', 'Активность')->usingComponent(Boolean::class),
        ];
    }
}
