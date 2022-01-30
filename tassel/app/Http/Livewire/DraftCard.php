<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prompt;

class DraftCard extends Component
{
    public $draft;
    public $prompt;

    public function render()
    {
        $this->prompt = Prompt::find($this->draft->prompt_id);

        return view('livewire.draft-card');
    }
}
