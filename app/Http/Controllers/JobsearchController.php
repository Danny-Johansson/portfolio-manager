<?php

namespace App\Http\Controllers;

use App\Models\Jobsearch;
use App\Models\JobsearchStatus;
use App\Models\JobsearchType;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobsearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
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
                            $data = Jobsearch::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Jobsearch::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Jobsearch::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_deleted')))
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
                            $data = Jobsearch::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Jobsearch::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Jobsearch::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $types = JobsearchType::all();
        $statuses = JobsearchStatus::all();

        return view('general.create')
            ->with('types',$types)
            ->with('statuses',$statuses)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->title,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('title')." ".__('system.contains')." ".__('system.banned')." ".__('system.phrases'))
                ->withInput()
            ;
        }

        if (isset($request->title) && empty($request->title)){
            return back()
                ->with('error',__('title')." ".__('system.cannot')." ".__('system.beBlank'))
            ;
        }

        $object = Jobsearch::create([
            'company' => $request->company,
            'title' => $request->title,
            'address' => $request->address ?? null,
            'article' => $request->article ?? null,
            'website' => $request->website ?? null,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'person' => $request->person ?? null,
            'apply_date' => $request->apply_date ?? null,
            'jobsearch_type_id' => $request->jobsearch_type ?? null,
            'jobsearch_status_id' => JobsearchStatus::where('name','=','Applied')->first()->id
        ]);

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($jobsearch): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Jobsearch::where('id','=',$jobsearch)->first();
        if(!$object){
            return redirect()
                ->route('jobsearches.index')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($jobsearch): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Jobsearch::where('id','=',$jobsearch)->first();
        if(!$object){
            return redirect()
                ->route('jobsearches.index')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
            ;
        }
        $types = JobsearchType::all();
        $statuses = JobsearchStatus::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('types',$types)
            ->with('statuses',$statuses)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($jobsearch, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        if(config('system.demo_mode') AND Str::contains($request->title,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('title')." ".__('system.contains')." ".__('system.banned')." ".__('system.phrases'))
                ->withInput()
            ;
        }

        $object = Jobsearch::where('id', '=', $jobsearch)->first();
        if(!$object){
            return redirect()
                ->route('jobsearches.index')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
            ;
        }

        if (isset($request->title) && !empty($request->title)){
            $object->title = $request->title;
        }

        if (isset($request->company) && !empty($request->company)){
            $object->company = $request->company;
        }

        if (isset($request->address) && !empty($request->address)){
            $object->address = $request->address;
        }

        if (isset($request->person) && !empty($request->person)){
            $object->person = $request->person;
        }

        if (isset($request->email) && !empty($request->email)){
            $object->email = $request->email;
        }

        if (isset($request->phone) && !empty($request->phone)){
            $object->phone = $request->phone;
        }

        if (isset($request->article) && !empty($request->article)){
            $object->article = $request->article;
        }

        if (isset($request->website) && !empty($request->website)){
            $object->website = $request->website;
        }

        if (isset($request->apply_date) && !empty($request->apply_date)){
            $object->apply_date = $request->apply_date;
        }

        if (isset($request->jobsearch_status) && !empty($request->jobsearch_status)){
            $object->jobsearch_status_id = $request->jobsearch_status;
        }

        if (isset($request->jobsearch_type) && !empty($request->jobsearch_type)){
            $object->jobsearch_type_id = $request->jobsearch_type;
        }

        $object->save();

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jobsearch): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Jobsearch::where('id','=',$jobsearch)->first();
        if(!$object){
            return redirect()
                ->route('jobsearches.index')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->delete();

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($jobsearch): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Jobsearch::onlyTrashed()
            ->where('id','=',$jobsearch)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('jobsearches.deleted')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->forceDelete();

        return redirect()
            ->route('jobsearches.deleted')
            ->with('success',__('jobsearch')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($jobsearch): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','jobsearches_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Jobsearch::onlyTrashed()
            ->where('id','=',$jobsearch)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('jobsearches.deleted')
                ->with('error',__('jobsearch')." ".__('not')." ".__('system.found'))
                ;
        }

        $object->restore();

        return redirect()
            ->route('jobsearches.deleted')
            ->with('success',__('jobsearch')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }
}
