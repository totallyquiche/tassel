<div>
    <div class="grid md:grid-cols-3 lg:grid-cols-4 md:gap-2 lg:gap-4">
        @if (count($drafts) === 0)
            <span class="text-slate-400 italic">Nothing to see here</span>
        @else
            @foreach ($drafts as $draft)
                <div class="mb-2 p-4 text-slate-400 text-sm">
                    <div class="flex mb-2">
                        <a class="underline text-blue-200 hover:text-blue-400" href="{{ route('prompt', ['id' => $draft->Prompt->id]) }}">{{ date('m/d/y \a\t g:i a', strtotime($draft->updated_at)) }}</a>
                        &nbsp;&nbsp;
                        <button onclick="confirm('Are you sure you want to delete this draft?') || event.stopImmediatePropagation()" wire:click="deleteDraft({{ $draft->id }})" class="font-bold rounded-full bg-cyan-600 text-blue-200 hover:text-blue-600 flex items-center justify-center font-mono h-4 w-4">x</button>
                    </div>
                    <span class="italic font-bold">Prompt:</span> {{ $draft->Prompt->text }}
                </div>
            @endforeach
        @endif
    </div>
</div>
