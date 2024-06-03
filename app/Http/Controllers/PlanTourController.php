<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PlanTour;
use App\Models\Tour;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class PlanTourController extends Controller
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
        $request->validate([
            'seat_cnt'=>'required',
            'date_start'=>'required',
            'date_finish'=>'required',
        ]);
        $plan = new PlanTour();
        $plan->tour_id = $tour->id;
        $plan->date_start = $request->date_start;
        $plan->date_finish = $request->date_finish;
        $plan->seat_cnt = $request->seat_cnt;
        $plan->save();
        return redirect()->back()->with('success','Тур запланирован');
    }

    /**
     * Display the specified resource.
     */
    public function fast_search(PlanTour $planTour, Request $request)
    {
        // dd($request->all());
        $words = explode(' ',$request->search);
        $query = Tour::query();
        foreach($words as $word){
            $query = $query->where('title','LIKE',"%{$word}%");
        }
        $res = $query->get();
        $plans = [];
        foreach($res as $r){
            $plan = PlanTour::query()->where('status','запланирован')->where('tour_id',$r->id)->get();
            if($plan){
                foreach($plan as $p){
                    array_push($plans,$p);
                }
            }
        }
        // dd($plans);
        return view('guest.catalog',['plans'=>$plans,'search'=>$request->search]);
    }

    public function full_search(PlanTour $planTour, Request $request)
    {
        // dd($request->all());
        if($request->search){
            $words = explode(' ',$request->search);
            $query = Tour::query();
            foreach($words as $word){
                $query = $query->where('title','LIKE',"%{$word}%");
            }
            $res = $query->get();
        }
        else{
            $res = Tour::all();
        }
        // dd($res);
        $plans = [];
        foreach($res as $r){
            $plan = PlanTour::query()->where('status','запланирован')->where('tour_id',$r->id)->get();
            if($plan){
                foreach($plan as $p){
                    array_push($plans,$p);
                }
            }
        }
        //ПОЧИНИТЬ

        if($request->date_start != null){

            foreach($plans as $key=>$p){
                if($p->date_start != $request->date_start){
                    array_splice($plans,$key,1);
                }
            }
        }
        // dd($plans);
        if($request->date_finish != null){
            foreach($plans as $key=>$p){
                if($p->date_finish != $request->date_finish){
                    array_splice($plans,$key,1);
                }
            }
        }
        if($request->seat_cnt != null){

            foreach($plans as $key=>$p){

                if($p->seat_cnt != (int)$request->seat_cnt){
                    // dd('if');
                    array_splice($plans,$key,1);

                }
            }
            // dd($plans);


        }
        // dd($plans);
        return view('guest.catalog',['plans'=>$plans,'search'=>$request->search]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function complete(PlanTour $planTour)
    {
        $planTour = PlanTour::query()->where('id',$planTour->id)->first();
        $planTour->status = 'выполнен';
        $books = Book::query()->where('plan_tour_id',$planTour->id)->get();
        foreach($books as $book){
            $b = Book::query()->where('id',$book->id)->first();
            $b->status = 'выполнено';
            $b->update();
        }
        $planTour->update();
        return redirect()->back()->with('success','Тур выполнен');
    }

    public function edit(PlanTour $planTour)
    {
        $planTour = PlanTour::query()->where('id',$planTour->id)->first();
        $planTour->status = 'отменен';
        $books = Book::query()->where('plan_tour_id',$planTour->id)->get();
        foreach($books as $book){
            $b = Book::query()->where('id',$book->id)->first();
            $b->status = 'тур отменен';
            $b->update();
        }
        $planTour->update();
        return redirect()->back()->with('success','Тур отменён');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanTour $planTour)
    {
        $request->validate([
            'seat_cnt'=>['required','regex:/^[0-9]{1,}$/'],
            'date_start'=>'required',
            'date_finish'=>'required',
        ]);
        $planTour = PlanTour::query()->where('id',$planTour->id)->first();
        $planTour->date_start = $request->date_start;
        $planTour->date_finish = $request->date_finish;
        $planTour->seat_cnt = $request->seat_cnt;
        $planTour->update();
        return redirect()->back()->with('success','Данные о запланированном туре изменены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanTour $planTour)
    {
        //
    }
}
