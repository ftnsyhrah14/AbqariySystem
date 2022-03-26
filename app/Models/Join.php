<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    use HasFactory;
    public function group()
    {
    return $this->belongsTo('App\Models\Group','groupID');
    }

    public function user()
    {
    return $this->belongsTo('App\Models\User','userID');
    }

}
