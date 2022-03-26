<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps=true;
    public function creator()
    {
    return $this->belongsTo('App\Models\User','userID');
    }
}
