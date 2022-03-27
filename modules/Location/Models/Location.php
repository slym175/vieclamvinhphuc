<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $appends = ['key'];

    const LOCATION_TYPE = ['province', 'district', 'ward'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Scope a query to get location by location type with children.
     *
     * @param  Builder  $query
     * @param  mixed  $with_children
     * @param  mixed  $type
     * @return Builder
     */
    public function scopeGetLocations($query, $type = self::LOCATION_TYPE[0], $with_children = false)
    {
        if(!in_array($type, self::LOCATION_TYPE)) {
            $type = self::LOCATION_TYPE[0];
        }
        $q = $query->where('type', '=', $type);
        if($with_children) {
            $q = $q->with('children.children.children');
        }
        return $q;
    }

    public function getKeyAttribute()
    {
        $code = isset($this->code) && $this->code ? $this->code : 0;
        return $this->id."_".$code;
    }
}
