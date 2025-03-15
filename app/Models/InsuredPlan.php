<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class InsuredPlan extends Model
{
    use GlobalStatus;

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function policyHolders()
    {
        return $this->hasMany(PolicyHolder::class, 'plan_purchase_id');
    }

    public function claimRequest()
    {
        return $this->hasMany(ClaimRequest::class);
    }
}
