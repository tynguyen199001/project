<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'slug',
        'status'
    ];
    public function sub_categories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
