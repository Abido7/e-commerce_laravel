<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait CatLocalization
{

    public function name($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }
}