<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaypalPlan extends Model
{
    protected $guarded = [];

    public function get_plan()
    {
        return $this->hasOne(Website::class, 'Plan_id');
    }
}
