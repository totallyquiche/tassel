<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Draft;

class Prompt extends Model
{
    use HasFactory;

    public function draft() {
        return $this->hasOne(Draft::class);
    }
}
