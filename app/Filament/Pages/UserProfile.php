<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Filament\Pages\Dashboard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class UserProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user-profile';

    protected static ?string $title = 'User Profile';

    public ?array $data = [];

    private Profile $profile;

    public function __construct()
    {
        $this->profile = auth()->user()->profile ?? new Profile();
    }

    public function mount(): void
    {
        $this->form->fill($this->profile->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avater')
                ->image()
                ->disk('public')
                ->directory('avaters')
                ->imagePreviewHeight('250')
                ->loadingIndicatorPosition('left')
                ->panelLayout('integrated')
                ->removeUploadedFileButtonPosition('right')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left'),

                TextInput::make('handle')
                ->required()
                ->maxLength(255)
                ->autofocus()
                ->unique(ignoreRecord: true),

                Textarea::make('bio')
                ->rows(10)
                ->cols(20)

            ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function create(): void
    {
        $newdata = $this->form->getState();

        if($newdata['handle'] == $this->profile->handle){
            unset($newdata['handle']);
        }

        try {
            $this->profile->updateOrCreate([
                'user_id' => auth()->id()
            ], $newdata);

            Notification::make()
            ->title('Success')
            ->body('Profile updated successfully!')
            ->success()
            ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
