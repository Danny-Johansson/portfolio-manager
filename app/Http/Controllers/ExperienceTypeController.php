<?php

namespace App\Http\Controllers;

use App\Models\ExperienceType;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExperienceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_index')))
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
                            $data = ExperienceType::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = ExperienceType::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = ExperienceType::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','experienceType')
            ->with('plural','experienceTypes')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_deleted')))
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
                            $data = ExperienceType::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = ExperienceType::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = ExperienceType::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','experienceType')
            ->with('plural','experienceTypes')
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','experienceType')
            ->with('plural','experienceTypes')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_create')))
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
            $object = ExperienceType::create([
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
            ->route('experienceTypes.index')
            ->with('success',__('experienceType')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($experienceType): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = ExperienceType::where('id','=',$experienceType)->first();
        if(!$object){
            return redirect()
                ->route('experienceTypes.index')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','experienceType')
            ->with('plural','experienceTypes')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($experienceType): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = ExperienceType::where('id','=',$experienceType)->first();
        if(!$object){
            return redirect()
                ->route('experienceTypes.index')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','experienceType')
            ->with('plural','experienceTypes')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($experienceType, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_update')))
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

        $object = ExperienceType::where('id', '=', $experienceType)->first();
        if(!$object){
            return redirect()
                ->route('experienceTypes.index')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('experienceTypes.index')
            ->with('success',__('experienceType')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($experienceType): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = ExperienceType::where('id','=',$experienceType)->first();
        if(!$object){
            return redirect()
                ->route('experienceTypes.index')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->delete();

        return redirect()
            ->route('experienceTypes.index')
            ->with('success',__('experienceType')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($experienceType): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = ExperienceType::onlyTrashed()
            ->where('id','=',$experienceType)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('experienceTypes.deleted')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->forceDelete();

        return redirect()
            ->route('experienceTypes.deleted')
            ->with('success',__('experienceType')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($experienceType): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experienceTypes_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = ExperienceType::onlyTrashed()
            ->where('id','=',$experienceType)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('experienceTypes.deleted')
                ->with('error',__('experienceType')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->restore();

        return redirect()
            ->route('experienceTypes.deleted')
            ->with('success',__('experienceType')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }

}
