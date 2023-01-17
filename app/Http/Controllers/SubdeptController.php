<?php

namespace App\Http\Controllers;

use App\Models\Subdept;
use App\Http\Requests\StoreSubdeptRequest;
use App\Http\Requests\UpdateSubdeptRequest;

class SubdeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubdept()
    {
        $subdept = DB::table('subdept')->get();
        return view('form.designations', compact('subdept'));
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
     * @param  \App\Http\Requests\StoreSubdeptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubdeptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subdept  $subdept
     * @return \Illuminate\Http\Response
     */
    public function show(Subdept $subdept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subdept  $subdept
     * @return \Illuminate\Http\Response
     */
    public function edit(Subdept $subdept)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubdeptRequest  $request
     * @param  \App\Models\Subdept  $subdept
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubdeptRequest $request, Subdept $subdept)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subdept  $subdept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subdept $subdept)
    {
        //
    }
}
