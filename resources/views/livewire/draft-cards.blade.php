<div>
    <div class="grid md:grid-cols-3 lg:grid-cols-4 md:gap-2 lg:gap-4">
        @if (count($drafts) === 0)
            <span class="text-slate-400 italic">Nothing to see here</span>
        @else
            @foreach ($drafts as $draft)
                <div class="mb-2 p-4 text-slate-400 text-sm">
                    <div class="mb-2">
                        <a href="{{ route('prompt', ['id' => $draft->Prompt->id]) }}" class="link">{{ date('m/d/y \a\t g:i a', strtotime($draft->updated_at)) }}</a>
                    </div>
                    <span class="italic font-bold">Prompt:</span> {{ $draft->Prompt->text }}
                </div>
            @endforeach
        @endif
    </div>
</div>
