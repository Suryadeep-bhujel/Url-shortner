<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UtmTracking\ShortUrl;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function dashboard(){
        $urls = ShortUrl::count();
        return view('admin.dashboard', compact('urls'));
    }
}
