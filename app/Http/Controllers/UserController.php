<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Response
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_index')))
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
                            $data = User::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = User::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = User::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','user')
            ->with('plural','users')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_deleted')))
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
                            $data = User::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = User::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = User::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','user')
            ->with('plural','users')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $roles = Role::all();

        return view('general.create')
            ->with('singular','user')
            ->with('plural','users')
            ->with('roles',$roles)
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if (isset($request->name) && empty($request->name)){
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->email) && empty($request->email)){
            return back()
                ->with('error',__('email')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->password) && empty($request->password)){
            return back()
                ->with('error',__('password')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }
        if(config('system.demo_mode') AND Str::contains($request->email,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('email')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $total = config('system');

        $object = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success',__('user')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($user): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = User::where('id','=',$user)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','user')
            ->with('plural','users')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = User::where('id','=',$user)->first();
        $roles = Role::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','user')
            ->with('plural','users')
            ->with('roles',$roles)
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($user, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if (isset($request->name) && empty($request->name)){
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (isset($request->email) && empty($request->email)){
            return back()
                ->with('error',__('email')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }
        if(config('system.demo_mode') AND Str::contains($request->email,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('email')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = User::where('id', '=', $user)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->email) && !empty($request->email)){
            $object->email = $request->email;
        }

        if (isset($request->role) && !empty($request->role)){
            $object->role_id = $request->role;
        }

        $object->save();

        return redirect()
            ->route('users.index')
            ->with('success',__('user')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = User::where('id','=',$user)->first();

        $object->delete();

        return redirect()
            ->route('users.index')
            ->with('success',__('user')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($user): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = User::onlyTrashed()
            ->where('id','=',$user)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('users.deleted')
            ->with('success',__('user')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($user): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=', 'users_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = User::onlyTrashed()
            ->where('id','=',$user)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('users.deleted')
            ->with('success',__('user')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
