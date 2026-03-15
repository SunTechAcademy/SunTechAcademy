<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'chapter_user')
                    ->withPivot('completed_at');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
