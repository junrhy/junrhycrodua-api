<?php

namespace App\Orchid\Screens\Animal;

use App\Models\Animal;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class AnimalEditScreen extends Screen
{
    /**
     * @var Animal
     */
    public $animal;

    /**
     * Query data.
     *
     * @param Animal $animal
     *
     * @return array
     */
    public function query(Animal $animal): array
    {
        return [
            'animal' => $animal
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->animal->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->animal->exists ? 'Edit animal details' : 'Add new animal';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->animal->exists;
        $deletePermission = Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->animal->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->animal->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the record is deleted, all of its resources and data will be permanently deleted.'))
                ->canSee($deletePermission),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        $properties = (array) json_decode($this->animal->properties, true);

        $image = array_key_exists('image', (array) $properties) ? $properties['image'] : null;
        $pronunciation = array_key_exists('pronunciation', (array) $properties) ? $properties['pronunciation'] : null;
        $sound = array_key_exists('sound', (array) $properties) ? $properties['sound'] : null;
        $description = array_key_exists('description', (array) $properties) ? $properties['description'] : null;

        return [
            Layout::rows([
                Input::make('animal.name')
                    ->title('Name')
                    ->placeholder('Enter name'),

                Input::make('animal.image')
                    ->title('Image')
                    ->placeholder('Enter image link')
                    ->value($image),

                Input::make('animal.pronunciation')
                    ->title('Pronunciation')
                    ->placeholder('Enter pronunciation link')
                    ->value($pronunciation),

                Input::make('animal.sound')
                    ->title('Sound')
                    ->placeholder('Enter sound link')
                    ->value($sound),

                Input::make('animal.description')
                    ->title('Description')
                    ->placeholder('Enter description link')
                    ->value($description),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Animal $animal)
    {
        $image = !empty($request->animal['image']) ? $request->animal['image'] : "";
        $pronunciation = !empty($request->animal['pronunciation']) ? $request->animal['pronunciation'] : "";
        $sound = !empty($request->animal['sound']) ? $request->animal['sound'] : "";
        $description = !empty($request->animal['description']) ? $request->animal['description'] : "";

        $input = [
            'name' => $request->animal['name'],
            'properties' => json_encode([
                    'image' => $image,
                    'pronunciation' => $pronunciation,
                    'sound' => $sound,
                    'description' => $description
                ])
        ];

        $animal->fill($input)->save();

        Alert::info('You have successfully created a animal.');

        return redirect()->route('platform.animal.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Animal $animal)
    {
        $animal->delete();

        Alert::info('You have successfully deleted the animal.');

        return redirect()->route('platform.animal.list');
    }
}
