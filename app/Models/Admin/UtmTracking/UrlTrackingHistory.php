<?php

namespace App\Models\Admin\UtmTracking;

use Illuminate\Database\Eloquent\Model;

class UrlTrackingHistory extends Model
{
    // use HasFactory;
    protected $fillable = [
        "url_id",
        "referral_url",
        "params",
        "ip",
        "country_code",
    ];
    public function urlInfo(){
        return $this->hasOne(ShortUrl::class, 'id', "url_id");
    }

}
