<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PlanTour;
use App\Models\Review;
use App\Models\Sale;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function welcome(){
        $sales = Sale::all();
        $tours = Tour::query()->inRandomOrder()->limit(6)->get();
        $reviews = Review::all();
        return view('welcome',['sales'=>$sales,'tours'=>$tours,'reviews'=>$reviews]);
    }
    public function reg(){
        return view('guest.reg');
    }
    public function auth(){
        return view('guest.auth');
    }
    public function profile(){
        $user = Auth::user();
        $books = Book::query()->where('user_id',Auth::id())->where('status','бронь')->get();
        foreach($books as $book){
            // $b = Book::query()->where('id',$book->id)->first();
            $all_books = Book::query()->where('plan_tour_id',$book->plan_tour_id)->get();
            $book->all_books = $all_books;
        }
        // dd($books);
        $total = count(Book::query()->where('user_id',Auth::id())->where('status','выполнено')->get());
        return view('user.profile',['user'=>$user,'books'=>$books,'total'=>$total]);
    }
    public function detail($plan){
        $other = PlanTour::query()->where('id','!=',$plan)->inRandomOrder()->limit(2)->get();
        $plan = PlanTour::query()->where('id',$plan)->first();
        return view('guest.detail',['plan'=>$plan,'other'=>$other]);
    }

    public function book($plan){
        $plan = PlanTour::query()->where('id',$plan)->first();
        return view('guest.book',['plan'=>$plan]);
    }

    public function catalog(){
        $search = "";
        $plans = PlanTour::all();
        return view('guest.catalog',['search'=>$search,'plans'=>$plans]);
    }
}
