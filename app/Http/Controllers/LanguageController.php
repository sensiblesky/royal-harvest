<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
     public function switchLanguage($lang)
    {
        $available = ['en','sw','fr']; // allowed languages
        
          if (in_array($lang, $available)) {
            Session::put('locale', $lang);
            App::setLocale($lang); // REQUIRED for immediate effect
        }
        return Redirect::back();
    }
}
