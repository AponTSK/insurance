<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use GlobalStatus;
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'feature_plans');
    }
}
