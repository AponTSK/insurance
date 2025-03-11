<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class NotCover extends Model
{
    use GlobalStatus;
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'not_covered_plans');
    }
}
