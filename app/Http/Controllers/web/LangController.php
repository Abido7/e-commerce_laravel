<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function store()
    {
        session()->put('lang', 'ar');
        return back();
    }

    public function destroy()
    {
        session()->put('lang', 'en');
        return back();
    }
}