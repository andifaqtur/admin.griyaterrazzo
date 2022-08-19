<?php

use Illuminate\Support\Facades\Route;


function setActive($uri,  $active = 'active')
{

    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $active;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $active;
        }
    }
}

function setMenuOpen($uri, $menu_open = 'menu-open')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $menu_open;
            }
        }
    }
}
