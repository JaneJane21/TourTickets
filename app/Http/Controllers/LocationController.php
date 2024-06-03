<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','unique:locations'],
            'img'=>'required',
        ]);
        $path = $request->file('img')->store('public/img');
        $loc = new Location();
        $loc->title = $request->title;
        if($path){
            $loc->img = '/storage/'.$path;
        }
        $loc->save();
        return redirect()->back()->with('success','Локация сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'title'=>['required',Rule::unique('locations')->ignore($location)]
        ]);
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $location->img = '/storage/'.$path;
        }
        $location->title = $request->title;
        $location->update();
        return redirect()->back()->with('success','Успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success','Успешно удалено');
    }
}
