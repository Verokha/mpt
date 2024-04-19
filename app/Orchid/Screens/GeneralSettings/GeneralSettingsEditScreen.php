<?php

namespace App\Orchid\Screens\GeneralSettings;

use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class GeneralSettingsEditScreen extends Screen
{
    public $techName;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(string $techName): iterable
    {
        $item = GeneralSettings::byTechName($techName);

        return [
            'content' => $item->content,
            'techName' => $techName
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'GeneralSettingsEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('note')
                ->method('createOrUpdate'),
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
                TextArea::make('content.data.description_page')
                    ->title('Описание страницы')
                    ->rows(10)
                    ->required(),
            ])
        ];
    }

    public function createOrUpdate(string $techName, Request $request)
    {
        $item = GeneralSettings::byTechName($techName);
        $item->content = $request->get('content');
        $item->save();

        Alert::info('Изменения сохранены');

        return redirect()->route('platform.gs.list', ['techName' => $techName]);
    }
}
