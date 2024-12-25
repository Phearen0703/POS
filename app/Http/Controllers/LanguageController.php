<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class LanguageController extends Controller
{
    public function SwitchLang($lang){
        App::setLocale($lang);
        session()->put('language', $lang);

        return redirect()->back();
    }
}
