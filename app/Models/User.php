<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     * Trả về ID của user để lưu vào JWT
     */
    public function getJWTIdentifier() {
        // Trả về primary key (id)
        return $this->getKey();
    }
    
    /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    * Thêm các thông tin tùy chỉnh vào JWT
    */
    public function getJWTCustomClaims() {
        return [
            'role' => $this->role,
            'email' => $this->email,
        ];
    }


    // Admin có thể tạo nhiều tasks
    public function createdTasks() 
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // User được giao nhiều Tasks
    public function assignedTasks() 
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // Kiểm tra role
    public function isAdmin() 
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];  
}
