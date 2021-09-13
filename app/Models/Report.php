<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function get_user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function get_staff(){
        return $this->belongsTo(User::class, 'staff_id');
    }
    public function get_website()
    {
    	return $this->belongsTo(Website::class, 'website_id');
    }
}
