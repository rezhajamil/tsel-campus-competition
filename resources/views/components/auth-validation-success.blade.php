@props(['success'])

@if ($success->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($success->all() as $success)
                <li>{{ $succes }}</li>
            @endforeach
        </ul>
    </div>
@endif
