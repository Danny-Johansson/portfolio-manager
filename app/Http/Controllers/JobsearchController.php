<?php

namespace App\Http\Controllers;

use App\Models\Jobsearch;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobsearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
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
    public function deleted(Request $request): View
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
    public function create(): View
    {
        return view('general.create')
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        if (isset($request->name) && !empty($request->name)){
            $object = Jobsearch::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
            ;
        }

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($jobsearch): View
    {
        $object = Jobsearch::where('id','=',$jobsearch)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($jobsearch): View
    {
        $object = Jobsearch::where('id','=',$jobsearch)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','jobsearch')
            ->with('plural','jobsearches')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($jobsearch, Request $request): RedirectResponse
    {
        $object = Jobsearch::where('id', '=', $jobsearch)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jobsearch): RedirectResponse
    {
        $object = Jobsearch::where('id','=',$jobsearch)->first();

        $object->delete();

        return redirect()
            ->route('jobsearches.index')
            ->with('success',__('jobsearch')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($jobsearch): RedirectResponse
    {
        $object = Jobsearch::onlyTrashed()
            ->where('id','=',$jobsearch)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('jobsearches.deleted')
            ->with('success',__('jobsearch')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($jobsearch): RedirectResponse
    {
        $object = Jobsearch::onlyTrashed()
            ->where('id','=',$jobsearch)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('jobsearches.deleted')
            ->with('success',__('jobsearch')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }
}
