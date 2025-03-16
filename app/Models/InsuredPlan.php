<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class InsuredPlan extends Model
{
    use GlobalStatus;

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
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

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ENABLE) {
                $html = '<span class="badge badge--success">' . trans('Active') . '</span>';
            } else {
                $html = '<span class="badge badge--warning">' . trans('Deactive') . '</span>';
            }
            return $html;
        });
    }
}
