<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\TagCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_index')))
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
                            $data = TagCategory::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = TagCategory::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = TagCategory::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','tagCategory')
            ->with('plural','tagCategories')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_deleted')))
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
                            $data = TagCategory::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = TagCategory::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = TagCategory::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','tagCategory')
            ->with('plural','tagCategories')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','tagCategory')
            ->with('plural','tagCategories')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_create')))
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
                ->withInput()
            ;
        }

        if (isset($request->text_color) && empty($request->text_color)){
            return back()
                ->with('error',__('inputs.text_color')." ".__('system.cannot')." ".__('system.beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->background_color) && empty($request->background_color)){
            return back()
                ->with('error',__('background_color')." ".__('system.cannot')." ".__('system.beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->border_color) && empty($request->border_color)){
            return back()
                ->with('error',__('inputs.border_color')." ".__('system.cannot')." ".__('system.beBlank'))
                ->withInput()
            ;
        }

        $object = TagCategory::create([
            'name' => $request->name,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'border_color' => $request->border_color,
        ]);

        return redirect()
            ->route('tagCategories.index')
            ->with('success',__('tagCategory')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($tagCategory): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = TagCategory::where('id','=',$tagCategory)->first();
        if(!$object){
            return redirect()
                ->route('tagCategories.index')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','tagCategory')
            ->with('plural','tagCategories')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tagCategory): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = TagCategory::where('id','=',$tagCategory)->first();
        if(!$object){
            return redirect()
                ->route('tagCategories.index')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','tagCategory')
            ->with('plural','tagCategories')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($tagCategory, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_update')))
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

        $object = TagCategory::where('id', '=', $tagCategory)->first();
        if(!$object){
            return redirect()
                ->route('tagCategories.index')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->text_color) && !empty($request->text_color)){
            $object->text_color = $request->text_color;
        }

        if (isset($request->background_color) && !empty($request->background_color)){
            $object->background_color = $request->background_color;
        }

        if (isset($request->border_color) && !empty($request->border_color)){
            $object->border_color = $request->border_color;
        }

        $object->save();

        return redirect()
            ->route('tagCategories.index')
            ->with('success',__('tagCategory')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tagCategory): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = TagCategory::where('id','=',$tagCategory)->first();
        if(!$object){
            return redirect()
                ->route('tagCategories.index')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->delete();

        return redirect()
            ->route('tagCategories.index')
            ->with('success',__('tagCategory')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($tagCategory): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = TagCategory::onlyTrashed()
            ->where('id','=',$tagCategory)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('tagCategories.deleted')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->forceDelete();

        return redirect()
            ->route('tagCategories.deleted')
            ->with('success',__('tagCategory')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($tagCategory): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tagCategories_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = TagCategory::onlyTrashed()
            ->where('id','=',$tagCategory)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('tagCategories.deleted')
                ->with('error',__('tagCategory')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->restore();

        return redirect()
            ->route('tagCategories.deleted')
            ->with('success',__('tagCategory')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }
}
