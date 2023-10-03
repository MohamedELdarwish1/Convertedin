<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_of_tasks',
        'user_id',

    ];


    function getUserNameAttribute()
    {
        $user = User::where('id',$this->user_id)->first();
        return $user->name;
    }

}
