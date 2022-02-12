<div>
    <div class="grid md:grid-cols-3 lg:grid-cols-4 md:gap-2 lg:gap-4">
        @if (count($drafts) === 0)
            <span class="text-slate-400 italic">Nothing to see here</span>
        @else
            @foreach ($drafts as $draft)
                <div class="mb-2 p-4 text-slate-400 text-md">
                    <div class="flex mb-2">
                        <a class="underline text-blue-200 hover:text-blue-400" href="{{ route('prompt', ['id' => $draft->Prompt->id]) }}">{{ date('m/d/y \a\t g:i a', strtotime($draft->updated_at)) }}</a>
                        &nbsp;&nbsp;
                        <svg
                        onclick="confirm('Are you sure you want to delete this draft?') || event.stopImmediatePropagation()"
                        wire:click="deleteDraft({{ $draft->id }})"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="lightslategray"
                        class="stroke-red-600 hover:stroke-red-400 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <span class="italic font-bold">Prompt:</span> {{ $draft->Prompt->text }}
                </div>
            @endforeach
        @endif
    </div>
</div>
