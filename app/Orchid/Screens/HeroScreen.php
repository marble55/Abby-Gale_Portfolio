<?php

namespace App\Orchid\Screens;

use App\Models\Hero;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class HeroScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'hero' => Hero::first()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Details';
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Description';
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
                Input::make('hero.name')
                    ->type('text')
                    ->required()
                    ->title('Name:'),
                Input::make('hero.subtitle')
                    ->type('text')
                    ->required()
                    ->title('Subtitle:'),
                Input::make('hero.description')
                    ->type('text')
                    ->required()
                    ->title('Description:'),
                Input::make('hero.email')
                    ->type('email')
                    ->required()
                    ->title('Email:'),
                Input::make('hero.telephone')
                    ->type('text')
                    ->required()
                    ->title('Telephone:')
                    ->prefix('+63 ')
                    ->mask('+63 9999 999 999') // Adding a mask
                    ->popover('Please enter a valid telephone number.'),
                Picture::make('hero.picture_path')
                    ->title('Image')
                    ->required(),
                Upload::make('hero.attachment')
                    ->title('CV')
                    ->maxFiles(1)
                    ->acceptedFiles('.pdf')
                    ->media(),


                Button::make('Update')
                    ->method('save')
            ]),
        ];
    }

    public function save(Request $request)
    {
        // dd($request);
        $hero = Hero::first();

        $hero->attachment()->syncWithoutDetaching(
            $request->input('hero.attachment', [])
        );

        $tele = $request->input('+63_')['hero'];
        $hero->fill($request->input('hero'));
        $hero->telephone = $tele['telephone'];
        
        $hero->save();
        Alert::info('You have successfully updated the details.');
        return redirect()->back();
    }
}
