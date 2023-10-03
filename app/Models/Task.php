<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'assigned_to_id',
        'assigned_by_id',
    ];


    function getUserNameAttribute()
    {
        $user = User::where('id',$this->assigned_to_id)->first();
        return $user->name;
    }
    function getAdminNameAttribute()
    {
        $admin = User::where('id',$this->assigned_by_id)->first();
        return $admin->name;
    }


    public function users()
    {
        return $this->belongsTo(User::class);
    }


}
