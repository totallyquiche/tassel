<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Draft;
use App\Traits\HasUuidPrimaryKey;

class Prompt extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    public function draft() {
        return $this->hasOne(Draft::class)->orderByDesc('updated_at');
    }
}
