<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Location;
use App\Models\LocationInTour;
use App\Models\PlanTour;
use App\Models\Sale;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function control(){
        $cities = City::all();
        $locations = Location::all();
        $users = User::all();
        $tours = Tour::all();
        $sales = Sale::all();
        $plans = PlanTour::query()->where('status','запланирован')->get();

        // $totals = 
        // foreach($tours as $tour){
        //     // dd($tour);
        //     $total = PlanTour::query()->where('tour_id',$tour->id)->count();
            
        //     $all_done = (object) [
        //         'all_done'=>$total
        //     ];
        //     array_push($tour,$all_done);

        // }

        return view('admin.index',['cities'=>$cities,
        'locations'=>$locations,
        'users'=>$users,
        'tours'=>$tours,
        'sales'=>$sales,
        'plans'=>$plans
    ]);
    }

    public function show_update_tour(Tour $tour){
        
        $users = User::all();
        $cities = City::all();
        $locations = Location::all();
        $loc = LocationInTour::query()->where('tour_id',$tour->id)->get();
        
        $locationsintour = [];
        foreach($loc as $l){
            array_push($locationsintour,$l->location_id);
        }
        
        return view('admin.edit_tour',['tour'=>$tour,
        'users'=>$users,
        'cities'=>$cities,
        'locations'=>$locations,
        'locationsintour'=>$locationsintour]);
    }
}
