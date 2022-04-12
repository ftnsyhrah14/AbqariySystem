<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $table = "attendances";
    
    use HasFactory;

    public function attend()
{
    return $this->belongsTo('App\Models\Meeting','meetingID');
}

public function member()
{
    return $this->belongsTo('App\Models\User','userID');
}
}
