<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PlanTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
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

        foreach($request->all() as $elem){
            $plan = PlanTour::query()->where('id',(int)$elem['plan_tour_id'])->first();
            $book = new Book();
            $book->fio = $elem['fio'];
            $book->birthday = $elem['birthday'];
            $book->phone = $elem['phone'];
            $book->price = $elem['price'];
            $book->status = 'бронь';
            $book->plan_tour_id = (int)$elem['plan_tour_id'];
            $book->user_id = Auth::id();
            $book->save();
            $plan->seat_cnt -= 1;
            $plan->update();
        }
        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->status = 'отменен';
        $plan = PlanTour::query()->where('id',$book->plan_tour_id)->first();
        $plan->seat_cnt += 1;
        $book->update();
        $plan->update();
        return redirect()->back()->with('success','Бронь отменена');
    }
}
