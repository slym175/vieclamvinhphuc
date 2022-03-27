<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = "user_metas";
    protected $fillable = [
        'user_id', 'avatar', 'phone', 'fax', 'address', 'ward_id', 'district_id', 'province_id'
    ];
}
