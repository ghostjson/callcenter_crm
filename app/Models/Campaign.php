<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model {
    use HasFactory;

    protected $table = 'campaigns';

    protected $dates = [ 'started_on', 'completed_on' ];

    public function scopeActive( $query ) {
        return $query->where( 'status', '!=', 'completed' )
        ->orWhereNull( 'status' );
    }

    public function staffMembers() {
        return $this->hasMany( 'App\Models\CampaignMember', 'campaign_id', 'id' );
    }

    public function leads() {
        return $this->hasMany( 'App\Models\Lead', 'campaign_id', 'id' );
    }
}
