<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'display_name',
        'parent_id',
    ];
    public function sub_permissions()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

}
