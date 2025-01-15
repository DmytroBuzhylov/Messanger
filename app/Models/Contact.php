<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsToMany(User::class, 'user_contact', 'contact_id', 'user_id')
            ->withPivot('email', 'status', 'created_at', 'updated_at');
    }


}
