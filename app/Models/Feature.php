<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'feature_plan', 'feature_id', 'plan_id');
    }
}
