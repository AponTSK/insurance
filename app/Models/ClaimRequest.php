<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimRequest extends Model
{

    protected $casts= [
        'others_details'=>'object'
    ];
    public function insuredPlan()
    {
        return $this->belongsTo(InsuredPlan::class);
    }
    public function claimAttachments(){
        return $this->hasMany(ClaimAttachment::class);
    }
}
