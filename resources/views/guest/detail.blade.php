@extends('layout.app')
@section('title')
Об экскурсии
@endsection
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <div class="row mb-5 align-items-start">
                <div class="col-5 img-block" style="margin: 10px;">
                    <img style="width: 100%;" src="{{ asset('public'.$plan->tour->img) }}">
                </div>
                <div class="col-6">
                    <div class="row mb-3">
                            <div class="row mb-3 justify-content-between">
                                <div class="col-auto ">
                                    <h5 class="bold">{{ $plan->tour->title }}</h5>

                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <p style="margin-bottom: 0px;"><strong><span style="margin-right: 20px;">{{ implode('.',array_reverse(explode('-',$plan->date_start))) }} - {{ implode('.',array_reverse(explode('-',$plan->date_finish))) }}</span>I<span style="margin-left: 20px;">{{ $plan->tour->price }} руб/чел</span></strong> </p>
                                    <p style="font-size: 12px; text-align:right;">скидка для ребенка младше 16 лет: {{ $plan->tour->discount }}%</p>
                                </div>
                            </div>
                            <p style="font-size: 12px;" class="mb-5">{{ $plan->tour->description }}</p>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('book_page',['plan'=>$plan]) }}" class="btn btn-warning">забронировать</a>
                </div>
            </div>
        </div>
        <div class="col-4" style="border-left: 1px solid #FFC600; padding-left:20px;">
            <p class="bold">Локации тура:</p>
            @foreach ($plan->tour->locationintours as $loc)
            {{-- <div class="">{{ $plan->tour->locationintours }}</div> --}}
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <img style="border-radius: 50%;width:70px; height:70px;" class="img-fluid" src="{{ asset('public'.$loc->location->img) }}">
                    </div>
                    <div class="col-auto">
                        <p>{{ $loc->location->title }}</p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <div class="row mb-5 align-items-center" style="margin-top: 100px;">
        <div class="row">
            <div class="col-4">
                <hr style="color: #FFC600; height: 3px; width: 100%;">
            </div>
            <div class="col-auto">
                <h4 class="mb-3 text-center">Другие запланированные туры</h4>
            </div>
            <div class="col-4">
                <hr style="color: #FFC600; height: 3px; width: 100%;">
            </div>
        </div>
        
        @foreach ($other as $plan)
        <div class="col-6">
          <div class="row tour-card" style="margin: 20px;">
            <div class="col-4 img-block">
                <img style="width: 100%; height:100%; border-radius: 6px 0px 0px 6px;" src="{{ asset('public'.$plan->tour->img) }}">
            </div>
            <div class="text-block p-3 col-8">
                <div class="row mb-3">
                        <div class="row mb-3 justify-content-between">
                            <div class="col-auto ">
                                <h5 class="bold">{{ $plan->tour->title }}</h5>
                            </div>
                        </div>
                        <div class="row mb-4">
                        <div class="col-auto">
                            <p><strong><span style="margin-right: 20px;">{{ implode('.',array_reverse(explode('-',$plan->date_start))) }} - {{ implode('.',array_reverse(explode('-',$plan->date_finish))) }}</span>I<span style="margin-left: 20px;">{{ $plan->tour->price }} руб/чел</span></strong> </p>
                        </div>
                        </div>
                        <div class="row justify-content-between align-items-center">

                            <div class="col-auto">
                                <a href="{{ route('detail',['plan'=>$plan]) }}">подробнее</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('book_page',['plan'=>$plan]) }}" class="btn btn-warning">бронь</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>

        @endforeach
    </div>
</div>
<style>
    .bold{
        font-weight: 700;
    }
    .text-block{
        border-radius: 6px;
        z-index:1;
    }
    .tour-card{
        height: auto;
        border-radius: 6px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        padding: 0px !important;
        background: #F8F8F8;
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
</style>
@endsection
