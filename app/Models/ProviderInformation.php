<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderInformation extends Model
{
    protected $fillable = [
        'user_id', 'provider_name', 'user_id', 'provider_user_id', 'provider_user_name', 'provider_user_email', 'provider_user_picture', 'provider_user_picture', 'access_token', 'refresh_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}