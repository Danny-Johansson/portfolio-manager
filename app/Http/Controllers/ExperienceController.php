<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_index')))
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
                            $data = Experience::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Experience::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Experience::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','experience')
            ->with('plural','experiences')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_deleted')))
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
                            $data = Experience::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Experience::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Experience::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','experience')
            ->with('plural','experiences')
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $types = ExperienceType::all();

        return view('general.create')
            ->with('types',$types)
            ->with('singular','experience')
            ->with('plural','experiences')

        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_create')))
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
                ;
        }

        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('name')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->location,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('location')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->note,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('note')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = Experience::create([
            'name' => $request->name,
            'experience_type_id' => $request->experience_type,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
        ]);

        return redirect()
            ->route('experiences.index')
            ->with('success',__('experience')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($experience): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Experience::where('id','=',$experience)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','experience')
            ->with('plural','experiences')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($experience): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $types = ExperienceType::all();

        $object = Experience::where('id','=',$experience)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('types',$types)
            ->with('singular','experience')
            ->with('plural','experiences')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($experience, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_update')))
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

        if(config('system.demo_mode') AND Str::contains($request->location,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('location')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if(config('system.demo_mode') AND Str::contains($request->note,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('note')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        $object = Experience::where('id', '=', $experience)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->location) && !empty($request->location)){
            $object->location = $request->location;
        }

        if (isset($request->start_date) && !empty($request->start_date)){
            $object->start_date = $request->start_date;
        }

        if (isset($request->end_date) && !empty($request->end_date)){
            $object->end_date = $request->end_date;
        }

        if (isset($request->note) && !empty($request->end_date)){
            $object->note = $request->note;
        }
        else{
            $object->note = Null;
        }

        if (isset($request->experience_type) && !empty($request->experience_type)){
            $object->experience_type_id = $request->experience_type;
        }

        $object->save();

        return redirect()
            ->route('experiences.index')
            ->with('success',__('experience')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($experience): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Experience::where('id','=',$experience)->first();

        $object->delete();

        return redirect()
            ->route('experiences.index')
            ->with('success',__('experience')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($experience): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Experience::onlyTrashed()
            ->where('id','=',$experience)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('experiences.deleted')
            ->with('success',__('experience')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($experience): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','experiences_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Experience::onlyTrashed()
            ->where('id','=',$experience)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('experiences.deleted')
            ->with('success',__('experience')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
