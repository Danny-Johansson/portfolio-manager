<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Permission;
use App\Models\Social;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','owner_index')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Owner::first();

        return view('owner.index')
            ->with('data',$object)
            ->with('singular','owner')
            ->with('plural','owner')
            ->with('no_deleted',true)
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','owner_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Owner::first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','owner')
            ->with('plural','owner')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','owner_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->first_name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('first_name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->initials,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('initials')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
                ;
        }

        if(config('system.demo_mode') AND Str::contains($request->last_name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('last_name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->street_name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('street_name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->street_number,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('street_number')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->email,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('email')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->country,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('country')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->city,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('city')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->zipcode,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('zipcode')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = Owner::first();

        if (isset($request->first_name) && !empty($request->first_name)){
            $object->first_name = $request->first_name;
        }
        else{
            $object->first_name = Null;
        }

        if (isset($request->last_name) && !empty($request->last_name)){
            $object->last_name = $request->last_name;
        }
        else{
            $object->last_name = Null;
        }

        if (isset($request->initials) && !empty($request->initials)){
            $object->initials = $request->initials;
        }
        else{
            $object->initials = Null;
        }

        if (isset($request->birthday) && !empty($request->birthday)){
            $object->birthday = $request->birthday;
        }
        else{
            $object->birthday = Null;
        }

        if (isset($request->email) && !empty($request->email)){
            $object->email = $request->email;
        }
        else{
            $object->email = Null;
        }

        if (isset($request->phone) && !empty($request->phone)){
            $object->phone = $request->phone;
        }
        else{
            $object->phone = Null;
        }

        if (isset($request->country) && !empty($request->country)){
            $object->country = $request->country;
        }
        else{
            $object->country = Null;
        }

        if (isset($request->city) && !empty($request->city)){
            $object->city = $request->city;
        }
        else{
            $object->city = Null;
        }

        if (isset($request->zipcode) && !empty($request->zipcode)){
            $object->zip = $request->zipcode;
        }
        else{
            $object->zip = Null;
        }

        if (isset($request->street_name) && !empty($request->street_name)){
            $object->street_name = $request->street_name;
        }
        else{
            $object->street_name = Null;
        }

        if (isset($request->street_number) && !empty($request->street_number)){
            $object->street_number = $request->street_number;
        }
        else{
            $object->street_number = Null;
        }

        if (isset($request->license) && !empty($request->license)){
            if($request->license == "on"){
                $object->license = 1;
            }
            else{
                $object->license = 0;
            }
        }

        $object->save();

        return redirect()
            ->route('owner.index')
            ->with('success',__('owner')." ".__('updated'))
        ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function image_form(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','owner_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Owner::first();

        return view('owner.image')
            ->with('data',$object)
            ->with('singular','owner')
            ->with('plural','owner')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function image_submit(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','owner_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Owner::first();

        if(!empty($object->image)){
            File::delete($object->image);
        }

        $file = $request->file('image');
        $destinationPath = 'images';
        $original_name = $file->getClientOriginalName();
        $orginal_parts = explode(".",$original_name);
        $extension = $orginal_parts[1];
        $file_name = "owner.".$extension;
        $file->move($destinationPath,$file_name);

        $object->image = $destinationPath."/".$file_name;
        $object->save();

        return redirect()
            ->route('owner.index')
            ->with('success',__('owner')." ".__('image')." ".__('updated'))
        ;

    }
}
