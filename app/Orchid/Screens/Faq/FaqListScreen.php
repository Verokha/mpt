<?php

namespace App\Orchid\Screens\Faq;

use App\Models\Faq;
use App\Orchid\Layouts\Faq\FaqListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FaqListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'faqs' => Faq::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Вопросы и ответы';
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
                ->route('platform.faq.edit')
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
            FaqListLayout::class
        ];
    }
}
