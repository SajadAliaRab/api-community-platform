
    <x-filament::card>
        <div class="space-y-4">
            <div>
                <strong>Username:</strong> {{ $user->userName }}
            </div>
            <div>
                <strong>Full Name:</strong> {{ $user->fName }} {{ $user->lName }}
            </div>
            <div>
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div>
                <strong>Type:</strong> {{ ucfirst($user->type) }}
            </div>
            @if($user->user_detail)
                <div>
                    <strong>Tagline:</strong> {{ $user->user_detail->tagline }}
                </div>
                <div>
                    <strong>Title:</strong> {{ $user->user_detail->title }}
                </div>
                <div>
                    <strong>Website:</strong> {{ $user->user_detail->website }}
                </div>
                <div>
                    <strong>Mobile:</strong> {{ $user->user_detail->mobile }}
                </div>
                <div>
                    <strong>Points:</strong> {{ $user->user_detail->point }}
                </div>
            @endif
        </div>
    </x-filament::card>
