<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Social;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_index')))
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
                            $data = Social::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Social::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Social::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','social')
            ->with('plural','socials')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_deleted')))
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
                            $data = Social::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Social::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Social::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','social')
            ->with('plural','socials')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('socials.create')
            ->with('singular','social')
            ->with('plural','socials')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_create')))
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

        if (isset($request->link) && empty($request->link)){
            return back()
                ->with('error',__('link')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->logo) && empty($request->logo)){
            return back()
                ->with('error',__('logo')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        $file = $request->file('logo');
        $destinationPath = 'images';
        $original_name = $file->getClientOriginalName();
        $orginal_parts = explode(".",$original_name);
        $extension = $orginal_parts[1];
        $file->move($destinationPath,$request->name.".".$extension);

        $object = Social::create([
            'name' => $request->name,
            'link' => $request->link,
            'logo' => $destinationPath."/".$request->name.".".$extension,
        ]);

        return redirect()
            ->route('socials.index')
            ->with('success',__('social')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($social): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::where('id','=',$social)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','social')
            ->with('plural','socials')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($social): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::where('id','=',$social)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','social')
            ->with('plural','socials')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($social, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_update')))
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

        if(config('system.demo_mode') AND Str::contains($request->link,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('link')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = Social::where('id', '=', $social)->first();

        if (isset($request->name) && !empty($request->name)){
            $old_parts = explode('.',$object->logo);
            $extension = $old_parts[1];
            $old_name = $object->logo;
            $new_name =  "images/".$request->name.".".$extension;
            File::move($old_name, $new_name);

            $object->logo = $new_name;
            $object->name = $request->name;
        }

        if(config('system.demo_mode')){
            $link = config('app.url');
        }
        elseif (isset($request->link) && !empty($request->link)){
            $link = $request->link;
        }
        else{
            $link = $object->link;
        }

        $object->link = $link;

        $object->save();

        return redirect()
            ->route('socials.index')
            ->with('success',__('social')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($social): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::where('id','=',$social)->first();

        $object->delete();

        return redirect()
            ->route('socials.index')
            ->with('success',__('social')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($social): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::onlyTrashed()
            ->where('id','=',$social)
            ->first()
        ;

        File::delete($object->logo);

        $object->forceDelete();

        return redirect()
            ->route('socials.deleted')
            ->with('success',__('social')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($social): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::onlyTrashed()
            ->where('id','=',$social)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('socials.deleted')
            ->with('success',__('social')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function logo_form($social, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::where('id','=',$social)->first();

        return view('socials.logo')
            ->with('data',$object)
            ->with('singular','social')
            ->with('plural','socials')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function logo_submit($social, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','socials_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Social::where('id','=',$social)->first();

        File::delete($object->logo);

        $file = $request->file('logo');
        $destinationPath = 'images';
        $original_name = $file->getClientOriginalName();
        $orginal_parts = explode(".",$original_name);
        $extension = $orginal_parts[1];
        $file->move($destinationPath,$object->name.".".$extension);

        return redirect()
            ->route('socials.index')
            ->with('success',__('social')." ".__('logo')." ".__('updated'))
        ;
    }
}
