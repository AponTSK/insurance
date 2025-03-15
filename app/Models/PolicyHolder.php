<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyHolder extends Model
{

    protected $casts = [
        'other_details' => 'object',
    ];

    public function insuredPlan()
    {
        return $this->belongsTo(InsuredPlan::class);
    }
}
