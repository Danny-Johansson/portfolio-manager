<?php

namespace App\Http\Controllers;

use App\Models\LanguageLevel;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_index')))
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
                            $data = LanguageLevel::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = LanguageLevel::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = LanguageLevel::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','languageLevel')
            ->with('plural','languageLevels')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_deleted')))
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
                            $data = LanguageLevel::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = LanguageLevel::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = LanguageLevel::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','languageLevel')
            ->with('plural','languageLevels')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','languageLevel')
            ->with('plural','languageLevels')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_create')))
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

        if (isset($request->name) && !empty($request->name)){
            $object = LanguageLevel::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        return redirect()
            ->route('languageLevels.index')
            ->with('success',__('languageLevel')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($languageLevel): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = LanguageLevel::where('id','=',$languageLevel)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','languageLevel')
            ->with('plural','languageLevels')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($languageLevel): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = LanguageLevel::where('id','=',$languageLevel)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','languageLevel')
            ->with('plural','languageLevels')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($languageLevel, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_update')))
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

        $object = LanguageLevel::where('id', '=', $languageLevel)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('languageLevels.index')
            ->with('success',__('languageLevel')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($languageLevel): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = LanguageLevel::where('id','=',$languageLevel)->first();

        $object->delete();

        return redirect()
            ->route('languageLevels.index')
            ->with('success',__('languageLevel')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($languageLevel): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = LanguageLevel::onlyTrashed()
            ->where('id','=',$languageLevel)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('languageLevels.deleted')
            ->with('success',__('languageLevel')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($languageLevel): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','languageLevels_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = LanguageLevel::onlyTrashed()
            ->where('id','=',$languageLevel)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('languageLevels.deleted')
            ->with('success',__('languageLevel')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }
}
