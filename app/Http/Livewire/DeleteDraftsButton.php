<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\QuillContent;
use App\Models\Draft;

class DeleteDraftsButton extends Component
{
    protected $listeners = ['deleteDrafts'];

    public function deleteDrafts(int $prompt_id)
    {
        $user = auth()->user();

        Draft::where('prompt_id', $prompt_id)
            ->where('user_id', $user->id)
            ->delete();

        redirect(route('prompt', [$prompt_id]));
    }
}
