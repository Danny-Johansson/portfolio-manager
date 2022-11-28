<?php

namespace App\Http\Controllers;

use App\Models\Demonstration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DemonstrationController extends Controller
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
                            $data = Demonstration::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Demonstration::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Demonstration::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
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
                            $data = Demonstration::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Demonstration::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Demonstration::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('general.create')
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        if (isset($request->name) && !empty($request->name)){
            $object = Demonstration::create([
                'name' => $request->name
            ]);
        }
        else{
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
            ;
        }

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($demonstration): View
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Display the specified demonstration.
     */
    public function demo($demonstration): View
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($demonstration): View
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($demonstration, Request $request): RedirectResponse
    {
        $object = Demonstration::where('id', '=', $demonstration)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        $object->save();

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($demonstration): RedirectResponse
    {
        $object = Demonstration::where('id','=',$demonstration)->first();

        $object->delete();

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($demonstration): RedirectResponse
    {
        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;

        $object->forceDelete();

        return redirect()
            ->route('demonstrations.deleted')
            ->with('success',__('demonstration')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($demonstration): RedirectResponse
    {
        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('demonstrations.deleted')
            ->with('success',__('demonstration')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

}
