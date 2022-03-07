<?php
function route_check($name, $parameters = [], $absolute = true)
{
    if (Illuminate\Support\Facades\Route::has($name)) {
        return \route($name, $parameters = [], $absolute = true);
    }

    return "javascript:void(0)";
}
