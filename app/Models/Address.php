<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Address extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone',
        'address',
        'city',
        'postcode',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
