<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        view()->composer('backend.*',function($view){
            $view->with('siteLocales', config('translatable.languages'));
        });
    }
}
