<?php

namespace App\Orchid\Screens\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class ClientEditScreen extends Screen
{
    /**
     * @var Client
     */
    public $client;

    /**
     * Query data.
     *
     * @param Client $client
     *
     * @return array
     */
    public function query(Client $client): array
    {
        return [
            'client' => $client
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->client->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->client->exists ? 'Edit client details' : 'Add new client';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->client->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->client->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->client->exists),

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
        // $properties = (array) json_decode($this->client->properties, true);

        return [
            Layout::rows([
                Input::make('client.long_name')
                    ->title('Name')
                    ->placeholder('Enter name'),
            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request, Client $client)
    {
        $input = [
            'amount' => $request->client['amount']
        ];

        $client->fill($input)->save();

        Alert::info('You have successfully created a client.');

        return redirect()->route('platform.client.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Client $client)
    {
        $client->delete();

        Alert::info('You have successfully deleted the client.');

        return redirect()->route('platform.client.list');
    }
}
