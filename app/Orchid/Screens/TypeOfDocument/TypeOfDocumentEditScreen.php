<?php

namespace App\Orchid\Screens\TypeOfDocument;

use App\Models\TypeOfDocument;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class TypeOfDocumentEditScreen extends Screen
{
    /** @var TypeOfDocument */
    public $tod;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(TypeOfDocument $tod): iterable
    {
        if (!$tod->exists) {
            $tod->is_active = true;
        }
        return [
            'tod' => $tod
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->tod->exists ? 'Редактировать элемент' : 'Добавить элемент';
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
                ->canSee(!$this->tod->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->tod->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->tod->exists),
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
                Input::make('tod.name')
                    ->title('Наименование')
                    ->required(),
                CheckBox::make('tod.is_active')
                    ->title('Активен')
                    ->sendTrueOrFalse(),

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->tod->fill($request->get('tod'))->save();

        Alert::info('Изменения сохранены');

        return redirect()->route('platform.tod.list');
    }

    public function remove()
    {
        $this->tod->delete();

        Alert::info('Элемент удален');

        return redirect()->route('platform.tod.list');
    }
}
