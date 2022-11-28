<?php

namespace App\Http\Controllers;

use App\Models\JobsearchStatus;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobsearchStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_index')))
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
                            $data = JobsearchStatus::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = JobsearchStatus::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = JobsearchStatus::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','jobsearchStatus')
            ->with('plural','jobsearchStatuses')

        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_deleted')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $perPage = $request->input('per_page') ?? 10;
        $search_term =  $request->input('search_term');
        $search_Status = $request->input('search_Status');
        $search_compare = $request->input('search_compare');

        $search_types = [];
        $search_types[] = array("value" => "name", "name" => "name");

        if($search_term != ""){
            switch ($search_Status){
                case "name":
                    switch($search_compare){
                        case("="):
                            $data = JobsearchStatus::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = JobsearchStatus::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = JobsearchStatus::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','jobsearchStatus')
            ->with('plural','jobsearchStatuses')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        return view('general.create')
            ->with('singular','jobsearchStatus')
            ->with('plural','jobsearchStatuses')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_create')))
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
            $object = JobsearchStatus::create([
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
            ->route('jobsearchStatuses.index')
            ->with('success',__('jobsearchStatus')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($jobsearchStatus): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = JobsearchStatus::where('id','=',$jobsearchStatus)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','jobsearchStatus')
            ->with('plural','jobsearchStatuses')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($jobsearchStatus): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = JobsearchStatus::where('id','=',$jobsearchStatus)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','jobsearchStatus')
            ->with('plural','jobsearchStatuses')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($jobsearchStatus, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_update')))
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

        $object = JobsearchStatus::where('id', '=', $jobsearchStatus)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('jobsearchStatuses.index')
            ->with('success',__('jobsearchStatus')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jobsearchStatus): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = JobsearchStatus::where('id','=',$jobsearchStatus)->first();

        $object->delete();

        return redirect()
            ->route('jobsearchStatuses.index')
            ->with('success',__('jobsearchStatus')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($jobsearchStatus): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = JobsearchStatus::onlyTrashed()
            ->where('id','=',$jobsearchStatus)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('jobsearchStatuses.deleted')
            ->with('success',__('jobsearchStatus')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($jobsearchStatus): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearchStatuses_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = JobsearchStatus::onlyTrashed()
            ->where('id','=',$jobsearchStatus)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('jobsearchStatuses.deleted')
            ->with('success',__('jobsearchStatus')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
