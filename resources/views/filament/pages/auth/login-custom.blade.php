
<x-filament-panels::page.simple>

    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif


    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}
        <x-filament::section
            collapsible
            collapsed
        icon="heroicon-m-exclamation-triangle"
        icon-color="danger">
            <x-slot name="heading">
                Testing Users
            </x-slot>

            <x-slot name="description">
                This website is currently under review. Please use fake details to create an account, or use the test account provided below to explore the features!
            </x-slot>

            admin@sajad.uk  <br>
            expert@sajad.uk  <br>
            user@sajad.uk  <br>
            Password : 123456789
        </x-filament::section>
        <x-filament::button
            href="https://community.sajad.uk"
            tag="a"
            color="warning"
            icon="heroicon-m-home"

        >
            Back Home
        </x-filament::button>


        <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}


        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
