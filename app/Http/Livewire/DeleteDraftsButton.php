<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Draft;

class DeleteDraftsButton extends Component
{
    protected $listeners = ['deleteDrafts'];

    public string $prompt_id;

    public function deleteDrafts()
    {
        $user = auth()->user();

        Draft::where('prompt_id', $this->prompt_id)
            ->where('user_id', $user->id)
            ->delete();

        redirect(route('prompt', [$this->prompt_id]));
    }
}
