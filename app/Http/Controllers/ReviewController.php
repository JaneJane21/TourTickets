<?php

namespace App\Http\Controllers;

use App\Models\PlanTour;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
    public function store(Request $request, Tour $tour)
    {
        // dd($request->all(),$tour);
        $request->validate([
            'text'=>'required'
        ]);
        $rev = new Review();
        $rev->text = $request->text;
        $rev->tour_id = $tour->id;
        $rev->user_id = Auth::id();
        $rev->save();
        return redirect()->back()->with('success','Отзыв сохранен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
