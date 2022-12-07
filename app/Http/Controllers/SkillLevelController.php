<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\SkillLevel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SkillLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_index')))
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
                            $data = SkillLevel::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = SkillLevel::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = SkillLevel::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','skillLevel')
            ->with('plural','skillLevels')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_deleted')))
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
                            $data = SkillLevel::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = SkillLevel::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = SkillLevel::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','skillLevel')
            ->with('plural','skillLevels')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','skillLevel')
            ->with('plural','skillLevels')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_create')))
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

        if (isset($request->name) && !empty($request->name)){
            $object = SkillLevel::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('inputs.name')." ".__('system.cannot')." ".__('system.beBlank'))
                ->withInput()
            ;
        }

        return redirect()
            ->route('skillLevels.index')
            ->with('success',__('skillLevel')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($skillLevel): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = SkillLevel::where('id','=',$skillLevel)->first();
        if(!$object){
            return redirect()
                ->route('skillLevels.index')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','skillLevel')
            ->with('plural','skillLevels')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($skillLevel): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = SkillLevel::where('id','=',$skillLevel)->first();
        if(!$object){
            return redirect()
                ->route('skillLevels.index')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','skillLevel')
            ->with('plural','skillLevels')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($skillLevel, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_update')))
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

        $object = SkillLevel::where('id', '=', $skillLevel)->first();
        if(!$object){
            return redirect()
                ->route('skillLevels.index')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('skillLevels.index')
            ->with('success',__('skillLevel')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($skillLevel): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = SkillLevel::where('id','=',$skillLevel)->first();
        if(!$object){
            return redirect()
                ->route('skillLevels.index')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->delete();

        return redirect()
            ->route('skillLevels.index')
            ->with('success',__('skillLevel')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($skillLevel): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = SkillLevel::onlyTrashed()
            ->where('id','=',$skillLevel)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('skillLevels.deleted')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->forceDelete();

        return redirect()
            ->route('skillLevels.deleted')
            ->with('success',__('skillLevel')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($skillLevel): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','skillLevels_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = SkillLevel::onlyTrashed()
            ->where('id','=',$skillLevel)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('skillLevels.deleted')
                ->with('error',__('skillLevel')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->restore();

        return redirect()
            ->route('skillLevels.deleted')
            ->with('success',__('skillLevel')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }
}
