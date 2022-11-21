<?php

namespace App\Http\Controllers;

use App\Models\Jobsearch;
use Illuminate\Http\Request;

class JobsearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $object = Jobsearch::all();

        return view('general.index')
            ->with('data',$object)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jobsearch  $jobsearch
     * @return \Illuminate\Http\Response
     */
    public function show(Jobsearch $jobsearch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobsearch  $jobsearch
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobsearch $jobsearch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jobsearch  $jobsearch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobsearch $jobsearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobsearch  $jobsearch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobsearch $jobsearch)
    {
        //
    }
}
