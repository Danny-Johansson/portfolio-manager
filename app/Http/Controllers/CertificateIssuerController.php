<?php

namespace App\Http\Controllers;

use App\Models\CertificateIssuer;
use App\Models\Permission;
use App\Models\TagCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateIssuerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_index')))
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
                            $data = CertificateIssuer::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = CertificateIssuer::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = CertificateIssuer::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','certificateIssuer')
            ->with('plural','certificateIssuers')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_deleted')))
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
                            $data = CertificateIssuer::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = CertificateIssuer::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = CertificateIssuer::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','certificateIssuer')
            ->with('plural','certificateIssuers')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','certificateIssuer')
            ->with('plural','certificateIssuers')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_create')))
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

        if (!isset($request->text_color) && !empty($request->text_color)){
            return back()
                ->with('error',__('text_color')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (!isset($request->background_color) && !empty($request->background_color)){
            return back()
                ->with('error',__('background_color')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        if (!isset($request->border_color) && !empty($request->border_color)){
            return back()
                ->with('error',__('border_color')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        $object = CertificateIssuer::create([
            'name' => $request->name,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'border_color' => $request->border_color,
        ]);

        return redirect()
            ->route('certificateIssuers.index')
            ->with('success',__('certificateIssuer')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($tagCategory): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = CertificateIssuer::where('id','=',$tagCategory)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','certificateIssuer')
            ->with('plural','certificateIssuers')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tagCategory): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = CertificateIssuer::where('id','=',$tagCategory)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','certificateIssuer')
            ->with('plural','certificateIssuers')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($tagCategory, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_update')))
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

        $object = CertificateIssuer::where('id', '=', $tagCategory)->first();

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
            ->route('certificateIssuers.index')
            ->with('success',__('certificateIssuer')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tagCategory): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = CertificateIssuer::where('id','=',$tagCategory)->first();

        $object->delete();

        return redirect()
            ->route('certificateIssuers.index')
            ->with('success',__('certificateIssuer')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($tagCategory): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = CertificateIssuer::onlyTrashed()
            ->where('id','=',$tagCategory)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('certificateIssuers.deleted')
            ->with('success',__('certificateIssuer')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($tagCategory): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificateIssuers_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = CertificateIssuer::onlyTrashed()
            ->where('id','=',$tagCategory)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('certificateIssuers.deleted')
            ->with('success',__('certificateIssuer')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }
}
