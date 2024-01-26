<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\View\View;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public ?int $academy_id = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'academy_id',
        'image',
        'name',
        'surname',
        'email',
        'password',
        'short_bio',
        'is_edited',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    private mixed $image;
    public mixed $avatar = '';

    public function academy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Academy::class, 'academy_id');
    }

    public function skills(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function applications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function Avatar(): string
    {
        return $this->avatar ? "/storage/{$this->avatar}" : asset('/bg-images/unknown.jpg');
    }
}
