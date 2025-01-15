<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Contact extends Model
{
    protected $table = 'user_contact';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id', 'id');
    }


}
