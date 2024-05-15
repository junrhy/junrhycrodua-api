<?php

namespace App\Orchid\Screens\Subscription;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Auth;

class SubscriptionEditScreen extends Screen
{
    /**
     * @var Subscription
     */
    public $subscription;

    /**
     * Query data.
     *
     * @param Subscription $subscription
     *
     * @return array
     */
    public function query(Subscription $subscription): array
    {
        return [
            'subscription' => $subscription
        ];
    }

    /**
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->subscription->exists ? 'Edit' : 'Create';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
         return $this->subscription->exists ? 'Edit subscription details' : 'Add new subscription';;
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        $deletePermission = $this->subscription->exists && Auth::user()->hasAccess('platform.delete');

        return [
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->subscription->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->subscription->exists),

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
        // $properties = (array) json_decode($this->subscription->properties, true);

        return [
            Layout::rows([
                Input::make('subscription.name')
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
    public function createOrUpdate(Request $request, Subscription $subscription)
    {
        $input = [
            'name' => $request->subscription['name']
        ];

        $subscription->fill($input)->save();

        Alert::info('You have successfully created a subscription.');

        return redirect()->route('platform.subscription.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Subscription $subscription)
    {
        $subscription->delete();

        Alert::info('You have successfully deleted the subscription.');

        return redirect()->route('platform.subscription.list');
    }
}
