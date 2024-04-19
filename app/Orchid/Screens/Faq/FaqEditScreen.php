<?php

namespace App\Orchid\Screens\Faq;

use App\Models\Faq;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class FaqEditScreen extends Screen
{
    /**
     * @var Faq
     */
    public $faq;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Faq $faq): iterable
    {
        //$this->faq = $faq;
        // if (!$this->faq) {
        //     $this->faq = new Faq();
        // }
        if (!$faq->exists) {
            $faq->is_active = true;
        }
        return [
            'faq' => $faq
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->faq->exists ? 'Редактировать запись' : 'Создать запись';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Добавить')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->faq->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->faq->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->faq->exists),
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
            Layout::rows([
                Input::make('faq.question')
                    ->required()
                    ->title('Вопрос')
                    ->maxlength(509),
                TextArea::make('faq.answer')
                    ->required()
                    ->title('Ответ')
                    ->rows(5),
                CheckBox::make('faq.is_active')
                    ->title('Активен')
                    ->sendTrueOrFalse()
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->faq->fill($request->get('faq'))->save();

        Alert::info('Изменения сохранены');

        return redirect()->route('platform.faq.list');
    }

    public function remove()
    {
        $this->faq->delete();

        Alert::info('Элемент удален');

        return redirect()->route('platform.faq.list');
    }
}
