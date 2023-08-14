<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\UserScope;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

use function PHPSTORM_META\type;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Image;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'password', 'date_of_birth', 'address', 'avatar', 'gender', 'email_verified_at', 'type'];


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

    protected static function booted(): void
    {


       

      
        static::deleted(function (User $user) {

            self::deleteImage($user->avatar);
        });
    }
    public static function gender_types(): array
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
        ];
    }
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return "https://ui-avatars.com/api/?name=$this->first_name+$this->last_name";
        }

        return asset('storage/' . $this->attributes['avatar']);
    }
    public function getShortNameAttribute()
    {
        $firstCharFirstName = $this->first_name ? mb_substr($this->first_name, 0, 1) : '';
        $firstCharLastName = $this->last_name ? mb_substr($this->last_name, 0, 1) : '';

        return $firstCharFirstName . $firstCharLastName;
    }

    public function getfullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'user_id', 'id');
    }
    public function isAdmin()
    {
        return $this->type === 'admin'; 
    }

    public function scopeEmployees(Builder $query)
    {
        return $query->where('type', 'employee');
    }
}
