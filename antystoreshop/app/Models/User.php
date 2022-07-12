<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use  App\Models\Role;
use App\Traits\HasPermissions;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];
    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }
    public function checkPermissionAccess($pemissionCheck)
    {
//         use login co quyen add, sua danh muc va xem menu
//         B1 lay duoc tat ca cac quyen cua user dang login he thong
//         B2 So sanh gia tri dua vao cua router hien tai xem co ton tai trong cac quyen ma minh lay dc hay khong
        $roles = auth()->user()->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('keycode', $pemissionCheck)) {
                return true;
            }
        }
        return false;
    }

}
