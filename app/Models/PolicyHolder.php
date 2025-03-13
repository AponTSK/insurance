<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyHolder extends Model
{

    protected $casts = [
        'other_details' => 'array',
    ];

    public function insuredPlan()
    {
        return $this->belongsTo(InsuredPlan::class);
    }
}
