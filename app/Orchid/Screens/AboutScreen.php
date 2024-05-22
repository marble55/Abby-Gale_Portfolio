<?php

namespace App\Orchid\Screens;

use App\Models\AboutMe;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class AboutScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'about' => AboutMe::first(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'About Page Edit';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
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
                TextArea::make('about.description')
                    ->title('Description:')
                    ->rows(5),
                Picture::make('about.image_path')
                    ->title('Image')
                    ->required(),

                Button::make('Update')
                    ->method('save')
            ]),

        ];
    }

    public function save(Request $request)
    {
        // $validate = Validator::validate(['']);
        $about = AboutMe::first();

        $about->fill($request->input('about'));
        $about->update();
        Alert::info('You have successfully updated the about.');
        return redirect()->back();
    }
}
