<?php

namespace App\Models\Admin\UtmTracking;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    // use HasFactory;
    protected $fillable = [
        "title",
        "original_url",
        "url_code",
        "status",
        "params",
        "added_by",
    ];
    public function history()
    {
        return $this->hasMany(UrlTrackingHistory::class, 'url_id', 'id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}
