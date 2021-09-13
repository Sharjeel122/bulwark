<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $guarded = [];

    public function get_plan()
    {
        return $this->belongsTo(PaypalPlan::class, 'plan');
    }

    public function get_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
