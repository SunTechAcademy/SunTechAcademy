<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chapter_user')->withPivot('completed_at');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function chapters() {
        return $this->belongsToMany(Chapter::class, 'chapter_user')->withPivot('completed_at');
    }

    public function loginHistories() {
        return $this->hasMany(LoginHistory::class);
    }

    /**
     * 管理者権限を所持しているか判定
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * 完了した中級タスクとのリレーション
     */
    public function completedIntermediateTasks()
    {
        return $this->belongsToMany(IntermediateTask::class, 'intermediate_task_user')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }
}
