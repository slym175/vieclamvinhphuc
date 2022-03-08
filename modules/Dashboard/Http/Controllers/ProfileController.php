<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(Request $request) {
        return view('dashboard::profile.index');
    }
}
