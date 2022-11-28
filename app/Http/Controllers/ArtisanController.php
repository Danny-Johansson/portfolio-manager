<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{

    public function cacheAll(){

        Artisan::call('config:cache');
        Artisan::call('view:cache');
        Artisan::call('route:cache');

        return redirect()
            ->route('root')
            ->with('success', 'Cached Config, Views and Routes')
        ;
    }

    public function cacheConfig(){

        Artisan::call('config:cache');

        return redirect()
            ->route('root')
            ->with('success', 'Cached Config')
        ;
    }

    public function cacheView(){

        Artisan::call('view:cache');

        return redirect()
            ->route('root')
            ->with('success', 'Cached Views')
        ;
    }

    public function cacheRoute(){

        Artisan::call('route:cache');

        return redirect()
            ->route('root')
            ->with('success', 'Cached Routes')
        ;
    }


    public function clearAll(){

        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return redirect()
            ->route('root')
            ->with('success', 'Cleared Config, Routes and Views')
        ;
    }

    public function clearConfig(){

        Artisan::call('config:clear');

        return redirect()
            ->route('root')
            ->with('success', 'Cleared Config')
        ;
    }

    public function clearView(){

        Artisan::call('view:clear');

        return redirect()
            ->route('root')
            ->with('success', 'Cleared Views')
        ;
    }

    public function clearRoute(){

        Artisan::call('route:clear');

        return redirect()
            ->route('root')
            ->with('success', 'Cleared Routes')
        ;
    }
}
