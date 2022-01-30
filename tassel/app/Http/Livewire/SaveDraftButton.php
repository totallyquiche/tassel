<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\QuillContent;
use App\Models\Draft;

class SaveDraftButton extends Component
{
    protected $listeners = ['saveDelta'];

    public function saveDelta(string $delta, int $prompt_id)
    {
        $quill_content = new QuillContent(['delta' => $delta]);

        $quill_content->save();

        $user = auth()->user();

        (new Draft([
            'quill_content_id' => $quill_content->id,
            'prompt_id' => $prompt_id,
            'user_id' => $user->id
        ]))->save();
    }
}
