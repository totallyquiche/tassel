<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuillContent extends Model
{
    use HasFactory;

    protected $fillable = ['delta'];
}
