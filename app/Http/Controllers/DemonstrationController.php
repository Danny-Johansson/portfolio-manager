<?php

namespace App\Http\Controllers;

use App\Models\Demonstration;
use Illuminate\Http\Request;

class DemonstrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $object = Demonstration::all();

        return view('general.index')
            ->with('data',$object)
        ;
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deleted()
    {
        $object = Demonstration::onlyTrashed()->all();

        return view('general.deleted')
            ->with('data',$object)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('general.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $object = Demonstration::create([

        ]);

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('created')." ".__('with')." ID :".$object->id)
        ;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request,$demonstration)
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        return view('general.show')
            ->with('data',$object)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request,$demonstration)
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        return view('general.edit')
            ->with('data',$object)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$demonstration)
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        $object->save();

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('with')." ID :".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,$demonstration)
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        $object->delete();

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('with')." ID :".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_force(Request $request,$demonstration)
    {
        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('demonstrations.deleted')
            ->with('success',__('demonstration')." ".__('with')." ID :".$object->id." ".__('force_deleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request,$demonstration)
    {
        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;

        $object->restore();

        return redirect()->route('demonstrations.deleted')->with('success',__('demonstration')." ".__('with')." ID :".$object->id." ".__('restored'));;
    }
}
