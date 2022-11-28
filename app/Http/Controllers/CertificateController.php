<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CertificateIssuer;
use App\Models\Permission;
use App\Models\Social;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_index')))
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
                            $data = Certificate::where('name','=',$search_term)->paginate($perPage);
                            break;
                        default:
                            $data = Certificate::where('name','like','%' . $search_term . '%')->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Certificate::paginate($perPage);
        }

        return view('general.index')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','certificate')
            ->with('plural','certificates')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_deleted')))
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
                            $data = Certificate::where('name','=',$search_term)->onlyTrashed()->paginate($perPage);
                            break;
                        default:
                            $data = Certificate::where('name','like','%' . $search_term . '%')->onlyTrashed()->paginate($perPage);
                            break;
                    }
                    break;
            }
        }
        else{
            $data = Certificate::onlyTrashed()->paginate($perPage);
        }

        return view('general.deleted')
            ->with('data',$data)
            ->with('search_types',$search_types)
            ->with('singular','certificate')
            ->with('plural','certificates')
            ->with('no_create',true)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $issuers = CertificateIssuer::all();

        return view('certificates.create')
            ->with('singular','certificate')
            ->with('plural','certificates')
            ->with('issuers',$issuers)
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_create')))
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

        if(config('system.demo_mode') AND Str::contains($request->note,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('note')." ".__('contains')." ".__('banned')." ".__('phrases'))
                ->withInput()
            ;
        }

        if (!isset($request->name) && !empty($request->name)){
            return back()
                ->with('error',__('name')." ".__('cannot')." ".__('beBlank'))
                ->withInput()
            ;
        }

        $name_filtered = str_replace(":", '',$request->name);

        $file = $request->file('file');
        $destinationPath = 'files';
        $original_name = $file->getClientOriginalName();
        $orginal_parts = explode(".",$original_name);
        $extension = $orginal_parts[1];
        $file->move($destinationPath,$name_filtered.".".$extension);

        if(isset($request->note)){
            $note = $request->note;
        }
        else{
            $note = Null;
        }

        $object = Certificate::create([
            'name' => $request->name,
            'earn_date' => $request->earn_date,
            'expire_date' => $request->expire_date,
            'note' => $note,
            'file' => $destinationPath.'/'.$name_filtered.".".$extension,
            'certificate_issuer_id' => $request->certificate_issuer,

        ]);

        return redirect()
            ->route('certificates.index')
            ->with('success',__('certificate')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('created'))
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show($tag): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Certificate::where('id','=',$tag)->first();

        return view('general.show')
            ->with('data',$object)
            ->with('singular','certificate')
            ->with('plural','certificates')
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tag): View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Certificate::where('id','=',$tag)->first();
        $issuers = CertificateIssuer::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('singular','certificate')
            ->with('plural','certificates')
            ->with('issuers',$issuers)
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($certificate, Request $request): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_update')))
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

        $object = Certificate::where('id', '=', $certificate)->first();

        if (isset($request->name) && !empty($request->name)){
            $object->name = $request->name;
        }

        if (isset($request->note) && !empty($request->note)){
            $object->note = $request->note;
        }
        else{
            $object->note = Null;
        }

        if (isset($request->certificate_issuer) && !empty($request->certificate_issuer)){
            $object->certificate_issuer_id = $request->certificate_issuer;
        }

        if (isset($request->expire_date) && !empty($request->expire_date)){
            $object->expire_date = $request->expire_date;
        }

        if (isset($request->earn_date) && !empty($request->earn_date)){
            $object->earn_date = $request->earn_date;
        }

        $name_filtered = str_replace(":", '',$request->name);

        $old_parts = explode('.',$object->file);
        $extension = $old_parts[1];
        $old_name = $object->file;
        $new_name =  "files/".$name_filtered.".".$extension;
        File::move($old_name, $new_name);

        $object->file = $new_name;

        $object->save();

        return redirect()
            ->route('certificates.index')
            ->with('success',__('certificate')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Certificate::where('id','=',$tag)->first();

        $object->delete();

        return redirect()
            ->route('certificates.index')
            ->with('success',__('certificate')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_delete_force')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Certificate::onlyTrashed()
            ->where('id','=',$tag)
            ->first()
        ;

        File::delete($object->file);

        $object->forceDelete();

        return redirect()
            ->route('certificates.deleted')
            ->with('success',__('certificate')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($tag): RedirectResponse|View
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','certificates_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Certificate::onlyTrashed()
            ->where('id','=',$tag)
            ->first()
        ;

        $object->restore();

        return redirect()
            ->route('certificates.deleted')
            ->with('success',__('certificate')." ".__('with')." ".__('name')." : ".$object->name." ".__('and')." ID : ".$object->id." ".__('restored'))
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function file_form($certificate, Request $request): RedirectResponse|View
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

        $object = Certificate::where('id','=',$certificate)->first();

        return view('certificates.file')
            ->with('data',$object)
            ->with('singular','certificate')
            ->with('plural','certificates')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function file_submit($certificate, Request $request): RedirectResponse|View
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

        $object = Certificate::where('id','=',$certificate)->first();

        File::delete($object->file);

        $name_filtered = str_replace(":", '',$object->name);

        $file = $request->file('file');
        $destinationPath = 'files';
        $original_name = $file->getClientOriginalName();
        $orginal_parts = explode(".",$original_name);
        $extension = $orginal_parts[1];
        $file->move($destinationPath,$name_filtered.".".$extension);

        return redirect()
            ->route('certificates.index')
            ->with('success',__('certificate')." ".__('file')." ".__('updated'))
        ;
    }
}
