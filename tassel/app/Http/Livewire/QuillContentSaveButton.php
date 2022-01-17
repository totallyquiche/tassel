<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\QuillContent;

class QuillContentSaveButton extends Component
{
    protected $listeners = ['saveDelta'];

    public function saveDelta(string $delta)
    {
        (new QuillContent(['delta' => $delta]))->save();
    }
}
