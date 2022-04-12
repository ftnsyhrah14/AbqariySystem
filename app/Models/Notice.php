<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    public function noti()
    {
    return $this->belongsTo('App\Models\Group','meetingID');
    }
}
