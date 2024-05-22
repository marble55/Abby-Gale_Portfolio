<?php

namespace App\Orchid\Screens;

use App\Models\Project;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProjectFormScreen extends Screen
{
    private $dataID;
    private $action;
    private $projects;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->dataID = request()->route('id');
        $this->action = request()->route('action');
        $this->projects = Project::find($this->dataID);

        return [
            'projects' => $this->projects,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return ucfirst($this->action) . " Project";
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
                Input::make('projects.title')
                    ->title('Title')
                    ->required(),
                TextArea::make('projects.description')
                    ->title('Description')
                    ->rows(10)
                    ->placeholder('Say something nice')
                    ->required(),
                Picture::make("projects.image_path")
                    ->title('Image')
                    ->popover('This field is optional'),
            ])
        ];
    }

    public function createOrUpdate(Request $request, $action, $id)
    {
        
        if ($action == 'create') {
            // dd($request->all());
            Project::create($request->input('projects'));
            Alert::info('Project added.');
        } else {

            $projects = Project::find($id);
            $projects->fill($request->input('projects'));
            $projects->save();

            Alert::info('Project updated.');
        }

        // Redirect or provide feedback
        return redirect()->route('platform.projects');
    }
}
