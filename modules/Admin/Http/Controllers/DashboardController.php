<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request) {
        return view('admin::index');
    }


}
