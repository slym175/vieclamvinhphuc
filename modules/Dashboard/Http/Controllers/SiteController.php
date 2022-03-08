<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index(Request $request) {
        return view('dashboard::site.index');
    }
}
