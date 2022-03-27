<?php

namespace Modules\Location\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Location\Models\Location;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        try {
//            $response = Illuminate\Support\Facades\Http::accept('application/json')->get(asset('assets/admin/modules/location/location.json'), []);
//            $res_array = json_decode($response->body());
//            foreach ($res_array as $province) {
//                $this->addLocation($province);
//            }
            return $this->jsonOutput(200, 'Fetched', []);
        } catch (\Exception $e) {
            return $this->jsonOutput(500, $e->getMessage(), []);
        }
    }

    public function addLocation($location, $type = Location::LOCATION_TYPE[0], $parent_id = 0)
    {
        $local = new Location();
        $local->name = isset($location->name) && $location->name ? $location->name : '';
        $local->code = isset($location->code) && $location->code ? $location->code : '';
        $local->codename = isset($location->codename) && $location->codename ? $location->codename : '';
        $local->division_type = isset($location->division_type) && $location->division_type ? $location->division_type : '';
        $local->type = $type;
        $local->phone_code = isset($location->phone_code) && $location->phone_code ? $location->phone_code : '';
        if ($parent_id) {
            $local->parent_id = $parent_id;
        }
        $local->save();
        if (isset($location->districts) && count($location->districts)) {
            foreach ($location->districts as $district) {
                $this->addLocation($district, Location::LOCATION_TYPE[1], $local->id);
            }
        }
        if (isset($location->wards) && count($location->wards)) {
            foreach ($location->wards as $ward) {
                $this->addLocation($ward, Location::LOCATION_TYPE[2], $local->id);
            }
        }
    }

    public function getLocations(Request $request)
    {
        try {
            if ($request->has('parent_id')) {
                $parent_id = $this->convertKeyToID($request->get('parent_id'));
                $locations = Location::where('parent_id', $parent_id)->orderBy('code', 'asc')->getLocations($request->get('type', Location::LOCATION_TYPE[1]))->get();
                return $this->jsonOutput(200, 'Get Locations!', [
                    'locations' => $locations
                ]);
            }
            throw new \Exception('Something \'s wrong!');
        } catch (\Exception $e) {
            return $this->jsonOutput(500, $e->getMessage());
        }
    }

    public function storeLocation(Request $request)
    {
        try {
            if ($request->has('action') && $request->has('location')) {
                $done = false;
                switch ($request->get('action')) {
                    case 'update':
                        if (isset($request->get('location')['id']) && $request->get('location')['id'] !== false) {
                            $location = Location::where('id', $request->get('location')['id'])->firstOrFail();
                            $done = true;
                        }
                        break;
                    case 'delete':
                        if (isset($request->get('location')['id']) && $request->get('location')['id'] !== false) {
                            $location = Location::where('id', $request->get('location')['id']);
                            if($location->delete()) {
                                unset($location);
                                $done = true;
                            }
                        }
                        break;
                    default:
                        $location = new Location(); $done = true;
                }

                if (isset($location) && $location) {
                    $location->name = isset($request->get('location')['name']) && $request->get('location')['name'] ? $request->get('location')['name'] : '';
                    $location->code = isset($request->get('location')['code']) && $request->get('location')['code'] ? $request->get('location')['code'] : 0;
                    $location->codename = isset($request->get('location')['codename']) && $request->get('location')['codename'] ? $request->get('location')['codename'] : '';
                    $location->division_type = isset($request->get('location')['division_type']) && $request->get('location')['division_type'] ? $request->get('location')['division_type'] : '';
                    $location->latitude = isset($request->get('location')['latitude']) && $request->get('location')['latitude'] ? $request->get('location')['latitude'] : 0;
                    $location->longitude = isset($request->get('location')['longitude']) && $request->get('location')['longitude'] ? $request->get('location')['longitude'] : 0;
                    if (isset($request->get('location')['parent_id']) && $request->get('location')['parent_id']) {
                        $parent_id = explode("_", $request->get('location')['parent_id']);
                    }
                    $location->parent_id = isset($parent_id) && is_array($parent_id) && count($parent_id) ? reset($parent_id) : 0;
                    $location->phone_code = isset($request->get('location')['phone_code']) && $request->get('location')['phone_code'] ? $request->get('location')['phone_code'] : '';
                    $location->type = isset($request->get('location')['type']) && $request->get('location')['type'] ? $request->get('location')['type'] : '';
                    $location->zipcode = isset($request->get('location')['zipcode']) && $request->get('location')['zipcode'] ? $request->get('location')['zipcode'] : '';
                    if ($location->save()) $done = true;
                }
                if ($done)
                    return $this->jsonOutput(200, Str::ucfirst($request->get('action')) . 'd Location!', [
                        'location' => isset($location) && $location ? $location : null
                    ]);
            }
            throw new \Exception('Something \'s wrong!');
        } catch (\Exception $e) {
            return $this->jsonOutput(500, $e->getMessage());
        }
    }

    private function convertKeyToID($key, $type = 'id')
    {
        $explode = explode('_', $key);
        $result = 0;
        if (count($explode) == 2) {
            switch ($type) {
                case 'code':
                    $result = $explode[1];
                    break;
                default:
                    $result = $explode[0];
            }
        }
        return $result;
    }
}
