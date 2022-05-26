<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Group extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $timestamps=true;
    protected $dates = ['deleted_at'];
    public function creators()
    {
    return $this->belongsToMany(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }
}
