@include('partials.errors')

<form action="{{ $scheduled_message->exists ? route('scheduled_messages.admin.update', $scheduled_message) : route('scheduled_messages.admin.create') }}" method="POST">
    <div class="p-8">
        @csrf
        <character-count>
            @include('partials/fields/textarea', [
                'label' => __('Body (English)'),
                'name' => 'body_en',
                'value' => old('body_en', $scheduled_message->body_en),
                'attributes' => [
                    'required' => true,
                    'disabled' => (bool) $scheduled_message->sent,
                    'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
                    'rows' => 5,
                ]
            ])
        </character-count>

        <character-count class="mt-6">
            @include('partials/fields/textarea', [
                'label' => __('Body (Spanish)'),
                'name' => 'body_es',
                'value' => old('body_es', $scheduled_message->body_es),
                'attributes' => [
                    'required' => true,
                    'disabled' => (bool) $scheduled_message->sent,
                    'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
                    'rows' => 5,
                ]
            ])
        </character-count>

        @include('partials/fields/input', [
            'label' => __('Send At'),
            'name' => 'send_at',
            'value' => old('send_at', $scheduled_message->send_at->format('Y-m-d\TH:i')),
            'class' => 'mt-6',
            'attributes' => [
                'required' => true,
                'disabled' => (bool) $scheduled_message->sent,
                'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
            ]
        ])

    </div>
    @if (! $scheduled_message->sent)
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-{{ $scheduled_message->exists ? 'between' : 'end' }} items-center">
            @if ($scheduled_message->exists && ! $scheduled_message->sent)
                <a
                    href="{{ route('scheduled_messages.admin.destroy', $scheduled_message) }}"
                    onclick="return confirm('Are you sure?');"
                    class="focus:text-red-500 hover:text-red-500"
                >
                    Delete Message
                </a>
                <input type="hidden" name="_method" value="PUT">
            @endif
            <button class="btn">
                {{ $scheduled_message->exists ? 'Update' : 'Create' }}
            </button>
        </div>
    @endif
</form>
