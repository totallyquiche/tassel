<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prompt;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quill_content_id', 'prompt_id'];

    public function prompt()
    {
        return $this->belongsTo(Prompt::class);
    }
}
