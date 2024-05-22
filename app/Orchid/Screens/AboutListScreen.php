<?php

namespace App\Orchid\Screens;


use App\Models\AboutList;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AboutListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'skills' => AboutList::where('category', '=', 'skill')->get(),
            'interests' => AboutList::where('category', '=', 'interest')->get(),
            'educations' => AboutList::where('category', '=', 'education')->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'My Skills/Interest/Education';
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
                ->route('platform.about.background.create', ['action' => 'create']),
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
                'skills',
                [
                    TD::make('title', 'Title'),
                    TD::make('description', 'Description'),
                    TD::make('icon', 'Icon'),

                    //Image
                    TD::make('image_path', "Image")
                        ->render(fn(AboutList $aboutList) => view('components.orchid.image-render')->with(['image_path' => $aboutList->image_path])),

                    //Delete Button
                    TD::make('delete', 'Delete')->render(function (AboutList $aboutList) {
                        return Button::make('Delete')
                            ->method('delete', ['aboutList' => $aboutList])
                            ->confirm('Are you sure to delete ' . $aboutList->title . '?')
                            ->icon('trash');
                    })->alignRight(),

                    //Update Button
                    TD::make('update', 'Update')->render(function (AboutList $aboutList) {
                        return Link::make('Edit')
                            ->icon('bs.pen')
                            ->route('platform.about.background.update', ['id' => $aboutList->getAttribute('id'), 'action' => 'update']);
                    })->alignRight(),
                ]
            )->title('Skills'),

            Layout::table('interests', [
                TD::make('title', 'Title'),
                TD::make('description', 'Description'),
                TD::make('icon', 'Icon'),

                //Image
                TD::make('image_path', "Image")
                    ->render(fn(AboutList $aboutList) => view('components.orchid.image-render')->with(['image_path' => $aboutList->image_path])),

                //Delete Button
                TD::make('delete', 'Delete')->render(function (AboutList $aboutList) {
                    return Button::make('Delete')
                        ->method('delete', ['aboutList' => $aboutList])
                        ->confirm('Are you sure to delete ' . $aboutList->title . '?')
                        ->icon('trash');
                })->alignRight(),

                //Update Button
                TD::make('update', 'Update')->render(function (AboutList $aboutList) {
                    return Link::make('Edit')
                        ->icon('bs.pen')
                        ->route('platform.about.background.update', ['id' => $aboutList->getAttribute('id'), 'action' => 'update']);
                })->alignRight(),
            ])->title('Interests'),

            Layout::table('educations', [
                TD::make('title', 'Title'),
                TD::make('description', 'Description'),
                TD::make('icon', 'Icon'),

                //Image
                TD::make('image_path', "Image")
                    ->render(fn(AboutList $aboutList) => view('components.orchid.image-render')->with(['image_path' => $aboutList->image_path])),

                //Delete Button
                TD::make('delete', 'Delete')->render(function (AboutList $aboutList) {
                    return Button::make('Delete')
                        ->method('delete', ['aboutList' => $aboutList])
                        ->confirm('Are you sure to delete ' . $aboutList->title . '?')
                        ->icon('trash');
                })->alignRight(),

                //Update Button
                TD::make('update', 'Update')->render(function (AboutList $aboutList) {
                    return Link::make('Edit')
                        ->icon('bs.pen')
                        ->route('platform.about.background.update', ['id' => $aboutList->getAttribute('id'), 'action' => 'update']);
                })->alignRight(),
            ])->title('Educations'),

        ];
    }

    public function delete(AboutList $aboutList)
    {
        $aboutList->delete();
        Alert::info('Background detail deleted.');
    }
    private function createPage()
    {
        return redirect()->route('platform.about.background.form');
    }
}
