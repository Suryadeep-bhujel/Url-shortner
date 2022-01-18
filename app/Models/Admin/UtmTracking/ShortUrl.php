<?php

namespace App\Models\Admin\UtmTracking;

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
}
