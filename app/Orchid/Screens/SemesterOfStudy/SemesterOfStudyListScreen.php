<?php

namespace App\Orchid\Screens\SemesterOfStudy;

use App\Models\SemesterOfStudy;
use App\Orchid\Layouts\SemesterOfStudy\SemesterOfStudyListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SemesterOfStudyListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'sos' => SemesterOfStudy::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список семестров';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')
                ->icon('pencil')
                ->route('platform.sos.edit')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            SemesterOfStudyListLayout::class
        ];
    }
}
