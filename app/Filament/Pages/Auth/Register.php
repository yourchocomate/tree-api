<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Facades\Filament;
use Illuminate\Auth\Events\Registered;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;

class Register extends BaseRegister
{

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = $this->getUserModel()::create($data);

        $user->profile()->create();

        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        $user->notify(
            Notification::make()
            ->title('Update your profile')
            ->success()
            ->body('Profile update is required to publish your handle.')
            ->actions([
                Action::make('markAsUnread')
                    ->button()
                    ->markAsUnread(),
            ])
            ->toDatabase(),
            );

        return app(RegistrationResponse::class);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                TextInput::make('username')
                    ->required()
                    ->autofocus()
                    ->unique($this->getUserModel())
                    ->maxLength(255),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ])
            ->statePath('data');
    }
}
