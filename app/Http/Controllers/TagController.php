<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Tag;
use App\Models\TagCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_index')))
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
                            $data = Tag::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Tag::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Tag::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','tag')
            ->with('plural','tags')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_deleted')))
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
                            $data = Tag::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Tag::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Tag::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','tag')
            ->with('plural','tags')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $categories = TagCategory::all();

        return view('general.create')
            ->with('singular','tag')
            ->with('plural','tags')
            ->with('categories',$categories)
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_create')))
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

        if (!isset($request->name) && !empty($request->name)){
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }


        $object = Tag::create([
            'name' => $request->name,
            'tag_category_id' => $request->tag_category ?? null,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'border_color' => $request->border_color,
        ]);

        return redirect()
            ->route('tags.index')
            ->with('success',__('tag')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;

    }

    /**
     * Display the specified resource.
     */
    public function show($tag): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Tag::where('id','=',$tag)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','tag')
            ->with('plural','tags')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tag): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Tag::where('id','=',$tag)->first();
        $categories = TagCategory::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','tag')
            ->with('plural','tags')
            ->with('categories',$categories)
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($tag, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_update')))
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

        $object = Tag::where('id', '=', $tag)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->tag_category) && !empty($request->tag_category)){
            $object->tag_category_id = $request->tag_category;
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
            ->route('tags.index')
            ->with('success',__('tag')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Tag::where('id','=',$tag)->first();

        $object->delete();

        return redirect()
            ->route('tags.index')
            ->with('success',__('tag')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Tag::onlyTrashed()
            ->where('id','=',$tag)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('tags.deleted')
            ->with('success',__('tag')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','tags_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Tag::onlyTrashed()
            ->where('id','=',$tag)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('tags.deleted')
            ->with('success',__('tag')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }
}
