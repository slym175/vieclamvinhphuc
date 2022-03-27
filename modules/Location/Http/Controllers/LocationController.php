<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Modules\Location\Models\Location;

class LocationController extends Controller
{
    public function index(Request $request) {
        $provinces = Location::getLocations()->orderBy('name', 'asc')->get();
        return view('location::index', [
            'provinces' => $provinces
        ]);
    }
}
