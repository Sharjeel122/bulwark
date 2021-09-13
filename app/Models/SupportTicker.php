<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicker extends Model
{
    protected $guarded = [];

    public function get_ticker_website()
    {
    	return $this->belongsTo(Website::class, 'website_id');
    }

     public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
