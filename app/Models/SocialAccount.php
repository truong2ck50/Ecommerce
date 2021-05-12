<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $table = 'social_accounts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
