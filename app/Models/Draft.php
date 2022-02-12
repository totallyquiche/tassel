<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prompt;
use App\Models\QuillContent;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quill_content_id', 'prompt_id'];

    public function prompt()
    {
        return $this->belongsTo(Prompt::class);
    }

    public function quill_content()
    {
        return $this->belongsTo(QuillContent::class);
    }

    public function delete()
    {
        $this->quill_content()
            ->delete();

        return parent::delete();
    }
}
