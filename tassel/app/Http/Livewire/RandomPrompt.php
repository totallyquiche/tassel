<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prompt;

class RandomPrompt extends Component
{
    public string $text;

    public function render()
    {
        $this->text = Prompt::inRandomOrder()->first()->text;

        return view('livewire.random-prompt');
    }
}
