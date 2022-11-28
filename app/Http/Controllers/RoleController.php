<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_index')))
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
                            $data = Role::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Role::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Role::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','role')
            ->with('plural','roles')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_deleted')))
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
                            $data = Role::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Role::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Role::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','role')
            ->with('plural','roles')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $permissions = Permission::all();

        return view('general.create')
            ->with('singular','role')
            ->with('plural','roles')
            ->with('permissions',$permissions)
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_create')))
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
            $object = Role::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        $object->permissions()->sync($request->permissions);

        return redirect()
            ->route('roles.index')
            ->with('success',__('role')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($role): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Role::where('id','=',$role)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','role')
            ->with('plural','roles')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($role): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Role::where('id','=',$role)->first();
        $permissions = Permission::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','role')
            ->with('plural','roles')
            ->with('permissions',$permissions)
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($role, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_update')))
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

        $object = Role::where('id', '=', $role)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        $object->permissions()->sync($request->permissions);

        return redirect()
            ->route('roles.index')
            ->with('success',__('role')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Role::where('id','=',$role)->first();

        $object->delete();

        return redirect()
            ->route('roles.index')
            ->with('success',__('role')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($role): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Role::onlyTrashed()
            ->where('id','=',$role)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('roles.deleted')
            ->with('success',__('role')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($role): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'roles_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Role::onlyTrashed()
            ->where('id','=',$role)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('roles.deleted')
            ->with('success',__('role')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
