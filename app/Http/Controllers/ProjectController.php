<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $object = Project::all();

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
        $object = Project::onlyTrashed()->all();

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
        $object = Project::create([

        ]);

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('created')." ".__('with')." ID :".$object->id)
            ;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request,$project)
    {
        $object = Project::where('id','=',$project)->first();

        return view('general.show')
            ->with('data',$object)
            ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request,$project)
    {
        $object = Project::where('id','=',$project)->first();

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
    public function update(Request $request,$project)
    {
        $object = Project::where('id','=',$project)->first();

        $object->save();

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('with')." ID :".$object->id." ".__('updated'))
            ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,$project)
    {
        $object = Project::where('id','=',$project)->first();

        $object->delete();

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('with')." ID :".$object->id." ".__('deleted'))
            ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_force(Request $request,$project)
    {
        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('projects.deleted')
            ->with('success',__('project')." ".__('with')." ID :".$object->id." ".__('force_deleted'))
            ;
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request,$project)
    {
        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;

        $object->restore();

        return redirect()->route('projects.deleted')->with('success',__('project')." ".__('with')." ID :".$object->id." ".__('restored'));;
    }
}
