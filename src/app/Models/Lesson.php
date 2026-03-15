<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function chapters() {
        return $this->hasMany(Chapter::class)->orderBy('sort_order');
    }
}
