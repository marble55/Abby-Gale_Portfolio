<?php

namespace App\Orchid\Screens;

use App\Models\Project;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProjectScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'projects' => Project::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Project Manager';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create New')
                ->icon('bs.pen')
                ->route('platform.project.form', ['id' => 0,'action' => 'create']),
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
            Layout::table(
                'projects',
                [
                    TD::make('title', 'Title'),
                    TD::make('description', 'Description'),

                    //Image
                    TD::make('image_path', "Image")
                        ->render(fn(Project $projects) => view('components.orchid.image-render')->with(['image_path' => $projects->image_path])),

                    //Delete Button
                    TD::make('delete', 'Delete')->render(function (Project $projects) {
                        return Button::make('Delete')
                            ->method('delete', ['projects' => $projects])
                            ->confirm('Are you sure to delete ' . $projects->title . '?')
                            ->icon('trash');
                    })->alignRight(),

                    //Update Button
                    TD::make('update', 'Update')->render(function (Project $projects) {
                        return Link::make('Edit')
                            ->icon('bs.pen')
                            ->route('platform.project.form', ['id' => $projects->getAttribute('id'), 'action' => 'update']);
                    })->alignRight(),
                ]
            ),
        ];
    }

    
    public function delete(Project $projects)
    {
        $projects->delete();
        Alert::info('Project deleted.');
    }
    private function createPage()
    {
        return redirect()->route('platform.project.form');
    }
}
