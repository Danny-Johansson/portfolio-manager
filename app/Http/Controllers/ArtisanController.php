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
            ->with('success', __('artisan.cached')." ".__('artisan.config').", ".__('artisan.views')." ".__('artisan.and')." ".__('artisan.routes'))
        ;
    }

    public function cacheConfig(){

        Artisan::call('config:cache');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cached')." ".__('artisan.config'))
        ;
    }

    public function cacheView(){

        Artisan::call('view:cache');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cached')." ".__('artisan.views'))
        ;
    }

    public function cacheRoute(){

        Artisan::call('route:cache');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cached')." ".__('artisan.routes'))
        ;
    }


    public function clearAll(){

        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cleared')." ".__('artisan.config').", ".__('artisan.views')." ".__('artisan.and')." ".__('artisan.routes'))
        ;
    }

    public function clearConfig(){

        Artisan::call('config:clear');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cleared')." ".__('artisan.config'))
        ;
    }

    public function clearView(){

        Artisan::call('view:clear');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cleared')." ".__('artisan.views'))
        ;
    }

    public function clearRoute(){

        Artisan::call('route:clear');

        return redirect()
            ->route('root')
            ->with('success', __('artisan.cleared')." ".__('artisan.routes'))
        ;
    }
}
