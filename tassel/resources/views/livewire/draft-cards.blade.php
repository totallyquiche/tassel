<div>
    @foreach ($drafts as $draft)
        <a href="{{ route('prompt', ['id' => $draft->Prompt->id]) }}" class="link">{{ $draft->Prompt->text }}</a>
        <br/><br/>
    @endforeach
</div>
