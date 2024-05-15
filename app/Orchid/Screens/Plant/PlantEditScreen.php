<?php

namespace App\Orchid\Screens\Plant;

use App\Models\Plant;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class PlantEditScreen extends Screen
{
    /**
     * @var Plant
     */
    public $plant;

    /**
     * Query data.
     *
     * @param Plant $plant
     *
     * @return array
     */
    public function query(Plant $plant): array
    {
        return [
            'plant' => $plant
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->plant->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->plant->exists ? 'Edit plant details' : 'Add new plant';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->plant->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->plant->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->plant->exists),

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
        $properties = (array) json_decode($this->plant->properties, true);

        $image = array_key_exists('image', (array) $properties) ? $properties['image'] : null;
        $description = array_key_exists('description', (array) $properties) ? $properties['description'] : null;

        return [
            Layout::rows([
                Input::make('plant.name')
                    ->title('Name')
                    ->placeholder('Enter name'),

                Input::make('plant.image')
                    ->title('Image')
                    ->placeholder('Enter image link')
                    ->value($image),

                Input::make('plant.description')
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
    public function createOrUpdate(Request $request, Plant $plant)
    {
        $image = !empty($request->plant['image']) ? $request->plant['image'] : "";
        $description = !empty($request->plant['description']) ? $request->plant['description'] : "";

        $input = [
            'name' => $request->plant['name'],
            'properties' => json_encode([
                    'image' => $image,
                    'description' => $description
                ])
        ];

        $plant->fill($input)->save();

        Alert::info('You have successfully created a plant.');

        return redirect()->route('platform.plant.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Plant $plant)
    {
        $plant->delete();

        Alert::info('You have successfully deleted the plant.');

        return redirect()->route('platform.plant.list');
    }
}
