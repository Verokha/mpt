<?php

namespace App\Orchid\Screens\TypeOfDocument;

use App\Models\TypeOfDocument;
use App\Orchid\Layouts\TypeOfDocument\TypeOfDocumentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TypeOfDocumentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tods' => TypeOfDocument::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список выдаваемых документов';
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
                ->route('platform.tod.edit')
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
            TypeOfDocumentListLayout::class
        ];
    }
}
