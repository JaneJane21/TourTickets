<?php

namespace App\Http\Controllers;

use App\Models\LocationInTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
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
        // dd($request->all());
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            "user_id" => "required",
            "city_id" => "required",
            "price" => "required",
            "discount" => "required",
            "locations" => 'required',
            'img'=>'required'
        ]);
        $path = $request->file('img')->store('public/img');
        $tour = new Tour();
        $tour->title = $request->title;
        $tour->description = $request->description;
        $tour->user_id = $request->user_id;
        $tour->city_id = $request->city_id;
        $tour->price = $request->price;
        $tour->discount = $request->discount;
        if($path){
            $tour->img = '/storage/'.$path;
        }
        $tour->save();
        foreach ($request->locations as $location){
            $loc = new LocationInTour();
            $loc->tour_id = $tour->id;
            $loc->location_id = $location;
            $loc->save();
        }
        return redirect()->back()->with('success','Тур сохранен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        // dd($request->all(),$tour);
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            
            "price" => "required",
            "discount" => "required",
            "locations" => 'required',
        ]);
        $tour->title = $request->title;
        $tour->description = $request->description;
        if($request->city_id){
            $tour->city_id = $request->city_id;
        }
        if($request->user_id){
            $tour->user_id = $request->user_id;
        }
        $tour->price = $request->price;
        $tour->discount = $request->discount;
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $tour->img = '/storage/'.$path;
        }
        $locations = LocationInTour::query()->where('tour_id',$tour->id)->get();
        foreach($locations as $location){
            $loc = LocationInTour::query()->where('id',$location->id)->first();
            $loc->delete();
        }
        foreach ($request->locations as $location){
            $loc = new LocationInTour();
            $loc->tour_id = $tour->id;
            $loc->location_id = $location;
            $loc->save();
        }
        $tour->update();
        return redirect()->route('control')->with('success','Успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->back()->with('success','Успешно удалено');
    }
}
