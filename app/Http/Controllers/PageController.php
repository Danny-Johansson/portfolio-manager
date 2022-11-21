<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function root()
    {
        return view('pages.welcome');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function resume()
    {
        return view('pages.resume');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function test()
    {
        return redirect()->route('root')->with('success', 'your message,here');
    }
}
