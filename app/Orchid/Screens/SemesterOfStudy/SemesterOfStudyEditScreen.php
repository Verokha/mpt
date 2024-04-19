<?php

namespace App\Orchid\Screens\SemesterOfStudy;

use App\Models\SemesterOfStudy;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SemesterOfStudyEditScreen extends Screen
{
    /** @var SemesterOfStudy */
    public $sos;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(SemesterOfStudy $sos): iterable
    {
        if (!$sos->exists) {
            $sos->is_active = true;
        }
        return [
            'sos' => $sos
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->sos->exists ? 'Редактировать элемент' : 'Добавить элемент';
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
                ->canSee(!$this->sos->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->sos->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->sos->exists),
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
                Input::make('sos.name')
                    ->title('Наименование')
                    ->required(),
                CheckBox::make('sos.is_active')
                    ->title('Активен')
                    ->sendTrueOrFalse(),

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->sos->fill($request->get('sos'))->save();

        Alert::info('Изменения сохранены');

        return redirect()->route('platform.sos.list');
    }

    public function remove()
    {
        $this->sos->delete();

        Alert::info('Элемент удален');

        return redirect()->route('platform.sos.list');
    }
}
