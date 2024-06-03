@extends('layout.app')
@section('title')
Туры
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h2>результаты поиска</h2>
    </div>
    <div class="row justify-content-center" style="padding:45px; margin-bottom: 90px;">
        <div class="col-auto">
            <form method="post" action="{{ route('fast_search') }}">
                @csrf
                @method('post')
                <img style="margin-right: 20px;" src="{{ asset('public\images\search.svg') }}" alt="search">
                <input value="{{ $search }}" style="margin-right: 20px;" class="mr-2" type="text" placeholder="название тура" name="search">
                <button class="style-btn" type="submit">найти</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (count($plans) > 0)


        @foreach ($plans as $plan)
            <div class="row tour-card w-75 mb-5">
                <div class="col-4 img-block">
                    <img style="width: 100%; height:100%; border-radius: 6px 0px 0px 6px;" src="{{ asset('public'.$plan->tour->img) }}">
                </div>
                <div class="text-block p-4 col-8">
                    <div class="row mb-3">
                            <div class="row mb-3 justify-content-between">
                                <div class="col-auto ">
                                    <h5 class="bold">{{ $plan->tour->title }}</h5>

                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('detail',['plan'=>$plan]) }}">подробнее</a>
                                </div>
                            </div>

                            <p style="font-size: 12px;" class="mb-5">{{ $plan->tour->description }}</p>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <p><strong><span style="margin-right: 20px;">{{ implode('.',array_reverse(explode('-',$plan->date_start))) }} - {{ implode('.',array_reverse(explode('-',$plan->date_finish))) }}</span>I<span style="margin-left: 20px;">{{ $plan->tour->price }} руб/чел</span></strong> </p>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('book_page',['plan'=>$plan]) }}" class="btn btn-warning">бронь</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <h3>К сожалению, не нашли подходящих туров</h3>
        @endif
    </div>
</div>
<style>
    .text-block{
        border-radius: 6px;
        /* background: #F8F8F8; */
        z-index:1;

    }
    .tour-card{
        height: auto;
        border-radius: 6px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        padding: 0px !important;
        background: #F8F8F8;
    }
    .bold{
        font-weight: 700;
    }
    .tour-card p, .tour-card a, .tour-card button{
        margin-bottom: 0;
        font-size: 14px;
        color: black;
    }
    .img-block{
        padding: 0px !important;

    }
    .style-btn{
        border-radius: 6px;
        border: 1px solid #000;
        padding: 8px 30px;
        background: none;
    }
    input{
        border-radius: 6px;
        border: 1px solid #000 !important;
        padding: 8px;
        background: transparent;
    }
</style>
@endsection
