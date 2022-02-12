<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Draft;

class DraftCards extends Component
{
    protected $listeners = ['$refresh'];

    public $drafts;

    public function render()
    {
        $user = auth()->user();
        $this->drafts = Draft::with('Prompt')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->unique('prompt_id');

        return view('livewire.draft-cards');
    }

    public function deleteDraft(int $draft_id)
    {
        Draft::where('id', $draft_id)
            ->where('user_id', auth()->user()->id)
            ->delete();
    }
}
