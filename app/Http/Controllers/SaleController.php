<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SaleController extends Controller
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
            'title'=>['required','unique:sales'],
            'description'=>'required',
            'img'=>'required',
        ]);
        $path = $request->file('img')->store('public/img');
        $sale = new Sale();
        $sale->title = $request->title;
        $sale->description = $request->description;
        if($path){
            $sale->img = '/storage/'.$path;
        }
        $sale->save();
        return redirect()->back()->with('success','Акция сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        // dd($request->all(),$sale);
        $request->validate([
            'title'=>['required',Rule::unique('sales')->ignore($sale)],
            'description'=>'required'
        ]);
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $sale->img = '/storage/'.$path;
        }
        $sale->title = $request->title;
        $sale->description = $request->description;
        $sale->update();
        return redirect()->back()->with('success','Успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->back()->with('success','Успешно удалено');
    }
}
