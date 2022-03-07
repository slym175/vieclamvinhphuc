<?php


namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait AliasAttribute
{
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'alias'
            ]
        ];
    }

    public function getAliasAttribute()
    {
        $title = isset($this->name) && $this->name ? $this->name : (isset($this->title) && $this->title ? $this->title : Hash::make($this->id));
        return $title . ' ' . explode('\\', get_class($this))[0] . ' ' . $this->id;
    }
}
