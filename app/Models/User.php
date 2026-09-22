<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const ROLES = [
        'super_admin',
        'admin',
        'media',
        'crm',
        'kemahasiswaan',
    ];

    public const MODULE_ACCESS = [
        'super_admin' => [
            'read' => ['*'],
            'write' => ['*'],
        ],
        'admin' => [
            'read' => ['*'],
            'write' => ['*'],
            'deny' => ['users'],
        ],
        'media' => [
            'read' => ['dashboard', 'profile', 'berita', 'banner', 'mahasiswa', 'dosen', 'civitas', 'kerjasama'],
            'write' => ['berita', 'banner', 'profile'],
        ],
        'crm' => [
            'read' => ['dashboard', 'profile', 'chat', 'mahasiswa', 'dosen', 'civitas'],
            'write' => ['chat', 'profile'],
        ],
        'kemahasiswaan' => [
            'read' => ['dashboard', 'profile', 'berita', 'mahasiswa', 'chat', 'fakultas', 'prodi'],
            'write' => ['berita', 'mahasiswa', 'chat', 'fakultas', 'prodi', 'profile'],
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'department',
        'profile_photo',
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

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public static function roleOptions(): array
    {
        return [
            'super_admin' => 'Super Admin',
            'admin' => 'Admin',
            'media' => 'Media',
            'crm' => 'CRM',
            'kemahasiswaan' => 'Kemahasiswaan',
        ];
    }

    public function loginActivities()
    {
        return $this->hasMany(LoginActivity::class);
    }

    public function canAccessModule(string $module, string $level = 'read'): bool
    {
        $access = self::MODULE_ACCESS[$this->role] ?? null;

        if (! $access) {
            return false;
        }

        $deniedModules = $access['deny'] ?? [];
        if (in_array($module, $deniedModules, true)) {
            return false;
        }

        $allowedModules = $access[$level] ?? [];

        return in_array('*', $allowedModules, true) || in_array($module, $allowedModules, true);
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return asset('images/profiles/' . basename($this->profile_photo));
        }

        return asset('images/faces/face5.jpg');
    }
}
