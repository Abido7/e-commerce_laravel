<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait ProdLocalization
{

    public function name($lang = null)
    {
        $lang = $lang ??  App::getLocale();
        return json_decode($this->name)->$lang;
    }

    public function description($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->description)->$lang;
    }
}