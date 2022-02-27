<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Models\Draft;
use App\Models\QuillContent;

class PromptController extends Controller
{
    public function index(Request $request, string $prompt_id) {
        $prompt = Prompt::with('draft')->find($prompt_id);

        if (is_null($prompt)) {
            return redirect(route('home'));
        }

        $draft = $prompt->draft;
        $user = auth()->user();
        $delta = null;

        if (!is_null($draft)) {
            $delta = QuillContent::find($draft->quill_content_id)->delta;
        }

        return view('prompt', [
            'prompt' => $prompt,
            'user' => $user,
            'delta' => $delta
        ]);
    }

    public function random() {
        $user_id = auth()->user()->id;
        $prompt = $this->getRandomPrompt();

        if ($prompt->Draft) {
            while ($prompt->Draft->user_id == $user_id) {
                $prompt = $this->getRandomPromptId();
            }
        }

        return redirect(route('prompt', ['id' => $prompt->id]));
    }

    private function getRandomPrompt() : Prompt {
        return Prompt::inRandomOrder()
            ->with('Draft')
            ->first();
    }
}
