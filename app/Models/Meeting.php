<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    public function gr()
    {
    return $this->belongsTo('App\Models\Group','groupID');
    }
}
