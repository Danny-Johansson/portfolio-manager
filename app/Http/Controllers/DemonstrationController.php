<?php

namespace App\Http\Controllers;

use App\Models\Demonstration;
use App\Models\DemonstrationMode;
use App\Models\DemonstrationType;
use App\Models\Permission;
use App\Models\Tag;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DemonstrationController extends Controller
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

        $modes = DemonstrationMode::all();

        return view('general.index')
            ->with('data',$data)
            ->with('modes',$modes)
            ->with('search_types',$search_types)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function deleted(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_deleted')))
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
    public function create(): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $types = DemonstrationType::all();
        $tags = Tag::all();

        return view('demonstrations.create')
            ->with('types',$types)
            ->with('tags',$tags)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_create')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }


        if(config('system.demo_mode') AND Str::contains($request->name,config('system.banned_phrases'),true)){
            return back()
                ->with('error',__('inputs.name')." ".__('system.contains')." ".__('system.banned')." ".__('system.phrases'))
                ->withInput()
                ;
        }

        if (isset($request->name) && empty($request->name)){
            return back()
                ->with('error',__('inputs.name')." ".__('system.cannot')." ".__('system.beBlank'))
            ;
        }

        $file_input = $request->file('file');

        $destinationPath = 'demos';
        $original_name = $file_input->getClientOriginalName();
        $original_parts = explode(".",$original_name);
        $extension = $original_parts[1];
        $file_name = $request->name.".".$extension;
        $file_input->move($destinationPath,$request->name.".".$extension);
        $file = $destinationPath."/".$file_name;

        $object = Demonstration::create([
            'name' => $request->name,
            'file' => $file,
            'demonstration_type_id' => $request->demonstration_type,
        ]);

        $object->tags()->sync($request->tags);

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.created'))
        ;

    }

    /**
     * Display the specified resource.
     */
    public function show($demonstration): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_view')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('general.show')
            ->with('data',$object)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Display the specified demonstration.
     * @throws FileNotFoundException
     */
    public function demo($demonstration,$mode):View|File|string
    {
        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        switch($mode){
            case(1):
                return view('demonstrations.demo_content')
                    ->with('data',$object)
                    ->with('singular','demonstration')
                    ->with('plural','demonstrations')
                ;
            case(2):
                return view('demonstrations.demo_view')
                    ->with('data',$object)
                    ->with('singular','demonstration')
                    ->with('plural','demonstrations')
                ;
            default:
                return File::get(public_path() . '/'.$object->file);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($demonstration): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        $types = DemonstrationType::all();
        $tags = Tag::all();

        return view('general.edit')
            ->with('data',$object)
            ->with('types',$types)
            ->with('tags',$tags)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($demonstration, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id', '=', $demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
                ;
        }

        if (isset($request->name) && !empty($request->name)){
            $old_parts = explode('.',$object->file);
            $extension = $old_parts[1];
            $old_name = $object->file;
            $new_name =  "demos/".$request->name.".".$extension;
            File::move($old_name, $new_name);

            $object->file = $new_name;
            $object->name = $request->name;
        }

        if (isset($request->demonstration_type) && !empty($request->demonstration_type)){
            $object->demonstration_type_id = $request->demonstration_type;
        }

        $object->save();
        $object->tags()->sync($request->tags);

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.updated'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($demonstration): View|RedirectResponse
    {

        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_delete')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
                ;
        }

        $object->delete();

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.deleted'))
        ;
    }

    /**
     * Permanently Remove the specified resource from storage.
     */
    public function destroy_force($demonstration): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_deleteForce')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('demonstrations.deleted')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        File::delete($object->file);

        $object->forceDelete();

        return redirect()
            ->route('demonstrations.deleted')
            ->with('success',__('demonstration')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.forceDeleted'))
        ;
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($demonstration): View|RedirectResponse
    {

        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_restore')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::onlyTrashed()
            ->where('id','=',$demonstration)
            ->first()
        ;
        if(!$object){
            return redirect()
                ->route('demonstrations.deleted')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        $object->restore();

        return redirect()
            ->route('demonstrations.deleted')
            ->with('success',__('demonstration')." ".__('system.with')." ".__('inputs.name')." : ".$object->name." ".__('system.and')." ID : ".$object->id." ".__('system.restored'))
        ;
    }


    /**
     * Update the specified resource in storage.
     */
    public function file_form($demonstration): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
            ;
        }

        return view('demonstrations.file')
            ->with('data',$object)
            ->with('singular','demonstration')
            ->with('plural','demonstrations')
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function file_submit($demonstration, Request $request): View|RedirectResponse
    {
        if(Auth::user()){
            if(!Auth::user()->role->permissions->contains(Permission::firstWhere('name', '=','demonstrations_update')))
            {
                return view('pages.denied');
            }
        }
        else{
            return view('pages.denied');
        }

        $object = Demonstration::where('id','=',$demonstration)->first();
        if(!$object){
            return redirect()
                ->route('demonstrations.index')
                ->with('error',__('demonstration')." ".__('not')." ".__('system.found'))
                ;
        }

        File::delete($object->file);

        $file = $request->file('file');
        $destinationPath = 'demos';
        $original_name = $file->getClientOriginalName();
        $original_parts = explode(".",$original_name);
        $extension = $original_parts[1];
        $file->move($destinationPath,$object->name.".".$extension);

        return redirect()
            ->route('demonstrations.index')
            ->with('success',__('demonstration')." ".__('file')." ".__('system.updated'))
        ;
    }

}
