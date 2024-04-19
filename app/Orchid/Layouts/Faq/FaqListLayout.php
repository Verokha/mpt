<?php

namespace App\Orchid\Layouts\Faq;

use App\Models\Faq;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FaqListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'faqs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->render(function (Faq $faq) {
                    return Link::make($faq->id)
                        ->route('platform.faq.edit', ['faq' => $faq->id]);
                }),
            TD::make('question', 'Вопрос')
                ->render(function (Faq $faq) {
                    return Link::make($faq->question)
                        ->route('platform.faq.edit', ['faq' => $faq->id]);
                }),
            TD::make('answer', 'Ответ')
                ->render(function (Faq $faq) {
                    return Link::make(mb_substr($faq->answer, 0, 40).'...')
                        ->route('platform.faq.edit', ['faq' => $faq->id]);
                }),
            TD::make('is_active', 'Активность')->usingComponent(Boolean::class),
        ];
    }
}
