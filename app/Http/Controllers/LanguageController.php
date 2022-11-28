<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_index')))
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
                            $data = Language::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Language::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Language::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','language')
            ->with('plural','languages')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_deleted')))
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
                            $data = Language::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Language::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Language::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','language')
            ->with('plural','languages')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $levels = LanguageLevel::all();

        return view('general.create')
            ->with('levels',$levels)
            ->with('singular','language')
            ->with('plural','languages')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if (isset($request->name) && empty($request->name)){
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        $object = Language::create([
            'name' => $request->name,
            'understand' => $request->understand,
            'speak' => $request->speak,
            'write' => $request->write,
            'read' => $request->read,
        ]);

        return redirect()
            ->route('languages.index')
            ->with('success',__('language')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.s
     */
    public function show($language): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Language::where('id','=',$language)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','language')
            ->with('plural','languages')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($language): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Language::where('id','=',$language)->first();
        $levels = LanguageLevel::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('levels',$levels)
            ->with('singular','language')
            ->with('plural','languages')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($language, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = Language::where('id', '=', $language)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->read) && !empty($request->read)){
            $object->read = $request->read;
        }

        if (isset($request->write) && !empty($request->write)){
            $object->write = $request->write;
        }

        if (isset($request->understand) && !empty($request->understand)){
            $object->understand = $request->understand;
        }

        if (isset($request->speak) && !empty($request->speak)){
            $object->speak = $request->speak;
        }

        $object->save();

        return redirect()
            ->route('languages.index')
            ->with('success',__('language')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($language): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Language::where('id','=',$language)->first();

        $object->delete();

        return redirect()
            ->route('languages.index')
            ->with('success',__('language')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($language): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Language::onlyTrashed()
            ->where('id','=',$language)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('languages.deleted')
            ->with('success',__('language')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($language): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languages_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Language::onlyTrashed()
            ->where('id','=',$language)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('languages.deleted')
            ->with('success',__('language')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }
}
