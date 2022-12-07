<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
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
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_deleted')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

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
    public function create(): View|RedirectResponse|Response
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

        $tags = Tag::leftjoin('tag_categories', 'tags.tag_category_id', '=', 'tag_categories.id')
            ->select('tags.*')
            ->orderByRaw('tags.tag_category_id IS NULL, tag_categories.name ASC')
            ->get()
        ;

        $features = Feature::orderBy('name','ASC')->get();

        return view('general.create')
            ->with('tags',$tags)
            ->with('features',$features)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('inputs.name')." ".__('system.contains')." ".__('system.banned')." ".__('system.phrases'))
                ->withInput()
            ;
        }

        if (isset($request->name) && empty($request->name)){
            return back()
                ->with('error',__('inputs.name')." ".__('system.cannot')." ".__('system.beBlank'))
            ;
        }

        $object = Project::create([
            'name' => $request->name,
            'repo_url' => $request->repo_url,
            'demo_url' => $request->demo_url,
            'note' => $request->note,
        ]);

        $object->tags()->sync($request->tags);
        $object->features()->sync($request->features);

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($project): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::where('id','=',$project)->first();
        if(!$object){
            return redirect()
                ->route('projects.index')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::where('id','=',$project)->first();
        if(!$object){
            return redirect()
                ->route('projects.index')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        $tags = Tag::leftjoin('tag_categories', 'tags.tag_category_id', '=', 'tag_categories.id')
            ->select('tags.*')
            ->orderByRaw('tags.tag_category_id IS NULL, tag_categories.name ASC')
            ->get()
        ;

        $features = Feature::orderBy('name','ASC')
            ->get()
        ;

        return view('general.edit')
            ->with('data',$object)
            ->with('tags',$tags)
            ->with('features',$features)
            ->with('singular','project')
            ->with('plural','projects')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($project, Request $request): Factory|View|RedirectResponse|Application
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::where('id', '=', $project)->first();
        if(!$object){
            return redirect()
                ->route('projects.index')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->repo_url) && !empty($request->repo_url)){
            $object->repo_url = $request->repo_url;
        }

        if (isset($request->demo_url) && !empty($request->demo_url)){
            $object->demo_url = $request->demo_url;
        }

        if (isset($request->note) && !empty($request->note)){
            $object->note = $request->note;
        }

        $object->save();

        $object->tags()->sync($request->tags);
        $object->features()->sync($request->features);

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::where('id','=',$project)->first();
        if(!$object){
            return redirect()
                ->route('projects.index')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->delete();

        return redirect()
            ->route('projects.index')
            ->with('success',__('project')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($project): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('projects.deleted')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->forceDelete();

        return redirect()
            ->route('projects.deleted')
            ->with('success',__('project')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($project): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','projects_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Project::onlyTrashed()
            ->where('id','=',$project)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('projects.deleted')
                ->with('error',__('project')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->restore();

        return redirect()
            ->route('projects.deleted')
            ->with('success',__('project')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }

}
