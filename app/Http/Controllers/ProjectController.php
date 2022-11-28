<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Project;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page') ?? 10;
        $search_term =  $request->input('search_term');
        $search_type = $request->input('search_type');
        $search_compare = $request->input('search_compare');

        $search_types = [];
        $search_types[] = array("value" => "name", "name" => "name");

        if($search_term != ""){
            switch ($search_type){
                case "name":
                    switch($search_compare){
                        case("="):
                            $data = Project::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Project::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Project::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        $perPage = $request->input('per_page') ?? 10;
        $search_term =  $request->input('search_term');
        $search_type = $request->input('search_type');
        $search_compare = $request->input('search_compare');

        $search_types = [];
        $search_types[] = array("value" => "name", "name" => "name");

        if($search_term != ""){
            switch ($search_type){
                case "name":
                    switch($search_compare){
                        case("="):
                            $data = Project::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Project::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Project::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','project')
            ->with('plural','projects')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Response
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'projects_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        if (isset($request->name) && !empty($request->name)){
            $object = Project::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
            ;
        }

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($project): View
    {
        $object = Project::where('id','=',$project)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project): View
    {
        $object = Project::where('id','=',$project)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($project, Request $request): RedirectResponse
    {
        $object = Project::where('id', '=', $project)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project): RedirectResponse
    {
        $object = Project::where('id','=',$project)->first();

        $object->delete();

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($project): RedirectResponse
    {
        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('projects.deleted')
            ->with('success',__('project')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($project): RedirectResponse
    {
        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('projects.deleted')
            ->with('success',__('project')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
