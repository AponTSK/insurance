<?php
namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ClaimRequest extends Model
{
    use GlobalStatus;
    protected $casts = [
        'others_details' => 'object',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insuredPlan()
    {
        return $this->belongsTo(InsuredPlan::class, 'plan_subscribe_id');
    }
    public function claimAttachments()
    {
        return $this->hasMany(ClaimAttachment::class);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::PAYMENT_SUCCESS) {
                $html = '<span class="badge badge--success">' . trans('Success') . '</span>';
            } else if ($this->status == Status::PAYMENT_PENDING) {
                $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
            } else if ($this->status == Status::PAYMENT_REJECT) {
                $html = '<span class="badge badge--danger">' . trans('Rejected') . '</span>';
            }
            return $html;
        });
    }
}
