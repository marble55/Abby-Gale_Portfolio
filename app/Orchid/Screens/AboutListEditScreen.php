<?php

namespace App\Orchid\Screens;

use App\Models\AboutList;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AboutListEditScreen extends Screen
{
    private $dataID;
    private $action;
    private $aboutList;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->dataID = request()->route('id');
        $this->action = request()->route('action');
        $this->aboutList = AboutList::find($this->dataID);
        return [
            'aboutList' => $this->aboutList,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return ucfirst($this->action) . " Background List";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Submit')
                ->method('createOrUpdate', ['id' => 0, 'action' => $this->action]),
            // ->type('primary'),
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
                Select::make('aboutList.category')
                    ->options([
                        'skill' => 'Skill',
                        'interest' => 'Interest',
                        'education' => 'Education',
                    ])
                    ->title('Type'),

                Input::make('aboutList.title')
                    ->title('Title')
                    ->required(),
                Input::make('aboutList.description')
                    ->title('Description')
                    ->rows(10)
                    ->placeholder('Say something nice')
                    ->required(),
                Input::make('aboutList.icon')
                    ->title('Icon')
                    ->rows(10)
                    ->placeholder('bs.icon')
                    ->popover('This field is optional'),

                Picture::make("aboutList.image_path")
                    ->title('Image')
                    ->popover('This field is optional'),
            ])
        ];
    }

    public function createOrUpdate(Request $request, $action, $id)
    {

        if ($action == 'create') {
            // dd($request->all());
            AboutList::create($request->input('aboutList'));


            Alert::info('Background detail created.');
        } else {

            $aboutList = AboutList::find($id);
            $aboutList->fill($request->input('aboutList'));
            $aboutList->save();

            Alert::info('Background detail updated.');
        }

        // Redirect or provide feedback
        return redirect()->route('platform.about.background');
    }
}
