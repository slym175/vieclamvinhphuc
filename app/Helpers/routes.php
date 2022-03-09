<?php
function route_check($name, $parameters = [], $absolute = true)
{
    if (Illuminate\Support\Facades\Route::has($name)) {
        return \route($name, $parameters = [], $absolute = true);
    }

    return "javascript:void(0)";
}

function is_current_route($name = '') {
    if(!$name) return false;
    return request()->route()->getName() === $name;
}
