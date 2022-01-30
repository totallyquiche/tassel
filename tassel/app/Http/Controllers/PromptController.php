<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Models\Draft;
use App\Models\QuillContent;

class PromptController extends Controller
{
    public function index(Request $request, int $prompt_id) {
        $prompt = Prompt::find($prompt_id);
        $user = auth()->user();
        $delta = null;

        if (is_null($prompt)) {
            return redirect(route('dashboard'));
        }

        $draft = Draft::where('prompt_id', $prompt->id)
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->first();

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
        $prompt = Prompt::inRandomOrder()->first();
        $user = auth()->user();

        return redirect(route('prompt', ['id' => $prompt->id]));
    }
}
