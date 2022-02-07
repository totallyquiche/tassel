<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Models\Draft;
use App\Models\QuillContent;

class PromptController extends Controller
{
    public function index(Request $request, int $prompt_id) {
        $prompt = Prompt::with('draft')->find($prompt_id);
        $draft = $prompt->draft;
        $user = auth()->user();
        $delta = null;

        if (is_null($prompt)) {
            return redirect(route('dashboard'));
        }

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

        $prompt = Prompt::inRandomOrder()
            ->leftJoin('drafts', 'drafts.id', '=', 'prompts.id')
            ->where('drafts.user_id', '!=', $user_id)
            ->orWhereNull('drafts.user_id')
            ->get('prompts.id')
            ->first();

        return redirect(route('prompt', ['id' => $prompt->id]));
    }
}
