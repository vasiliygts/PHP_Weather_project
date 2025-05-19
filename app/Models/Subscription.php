<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['email', 'city', 'frequency', 'confirmation_token', 'unsubscribe_token'];
}
