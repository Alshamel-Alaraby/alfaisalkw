<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            'backend.layouts.partial.sidebar', 'App\Http\ViewComposers\BackendMenuComposer'
        );
    }

    public function register()
    {
    }
}
