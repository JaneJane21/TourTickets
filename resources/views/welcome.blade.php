@extends('layout.app')
@section('title')
ТУР-НН
@endsection
@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    <div class="row justify-content-center" style="margin-bottom: 90px;">
        <div class="col-6">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($sales as $key=>$sale)
                    <div class="carousel-item {{ $key==0?'active':'' }}" style="height: 350px;">
                            <img style="object-fit:contain; object-position:center;" src="{{ asset('public'.$sale->img) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-center">{{ $sale->title }}</h5>
                            <p class="text-center">{{ $sale->description }}</p>

                            <button style="border-radius: 11px; border: 1px solid #000; padding:5px 15px; background:white;" type="button">подробнее</button>
                            </div>
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
    <div class="row justify-content-center" style="background-color: #EBEBEB; padding:45px; margin-bottom: 90px;">
        <div class="col-auto">
            <form method="post" action="{{ route('fast_search') }}">
                @csrf
                @method('post')
                <img style="margin-right: 20px;" src="{{ asset('public\images\search.svg') }}" alt="search">
                <input style="margin-right: 20px;" class="mr-2" type="text" placeholder="название тура" name="search">
                <button class="style-btn" type="submit">найти</button>
            </form>
        </div>
    </div>
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 90px;">
        <div class="col-12" style="margin-bottom: 60px;">
            <h4 class="text-center">Преимущества</h4>
        </div>
        <div class="col-auto d-flex flex-column justify-content-end m-3">
            <div style="width: 190px;">
                <img class="mb-3 img-fluid" src="{{ asset('public\images\Преимущества.jpg') }}">
                <p class="text-center">Высокие стандарты качества</p>
            </div>
        </div>
        <div class="col-auto d-flex flex-column justify-content-end m-3">
            <div style="width: 190px;">
                <img class="mb-3 img-fluid" src="{{ asset('public\images\Преимущества2.jpg') }}">
                <p class="text-center">Лучшее соотношение цена/качество</p>
            </div>
        </div>
        <div class="col-auto d-flex flex-column justify-content-end m-3">
            <div style="width: 190px;">
                <img class="mb-3 img-fluid" src="{{ asset('public\images\Преимущества3.png') }}">
                <p class="text-center">Каждый клиент уникален!</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-bottom: 90px;">
        <div class="col-12" style="margin-bottom: 60px;">
            <h4 class="text-center">Путеводитель</h4>
        </div>
        @foreach ($tours as $tour)
        <div class="col-auto m-3">
            <div class="d-flex flex-column justify-content-end" style="width: 360px; height:240px; background-image:url('public{{ $tour->img }}'); background-position:center; background-size:cover;">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reviewModal_{{ $tour->id }}">
                    "{{ $tour->title }}"<br>
                    оставить отзыв
                </button>

                <!-- Modal -->
                <div class="modal fade" id="reviewModal_{{ $tour->id }}" tabindex="-1" aria-labelledby="reviewModal_{{ $tour->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="reviewModal_{{ $tour->id }}Label">Отзыв о туре "{{ $tour->title }}"</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{route('store_review',['tour'=>$tour])}}">
                            @method('post')
                            @csrf
                            <textarea name="text" class="form-control mb-4" placeholder="Поделитесь впечатлениями о туре"></textarea>
                            <button type="submit" class="btn btn-warning">отправить</button>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="row justify-content-center" style="margin-bottom: 90px;">
        <div class="col-12" style="margin-bottom: 60px;">
            <h4 class="text-center">Поиск тура</h4>
        </div>
        <div class="row">
            <div class="col-6 p-4" style="background: #FFC600;">
            <h5 style="font-size: 28px;">Выбери место куда ты хочешь и мы тебя доставим!</h5>
        </div>
        <div class="col-6" style="padding-left: 50px;">
            <form class="row" method="post" action="{{ route('full_search') }}">
                @csrf
                @method('post')
                    <div class="col-7 mb-3">
                        <label class="form-label" for="title">название тура</label>
                        <input type="text" class="form-control" name="search" id="title" style="color: #000">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label" for="date_start">дата начала</label>
                        <input class="form-control" type="date" name="date_start" id="date_start">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label" for="date_finish">дата окончания</label>
                        <input class="form-control" type="date" name="date_finish" id="date_finish">
                    </div>
                    <div class="col-auto mb-3">
                        <label class="form-label" for="seat_cnt">кол-во пассажиров</label>
                        <input class="form-control" style="width: 60px;" type="text" name="seat_cnt" id="seat_cnt">
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <button style="border-color: #FFC600;" class="style-btn" type="submit">найти</button>
                        </div>

                    </div>

            </form>
        </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-bottom: 40px;">
        <div class="col-12">
            <h4 class="text-center">Отзывы клиентов</h4>

        </div>
        <div class="col-7">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner " >
                    @foreach ($reviews as $key=>$rev)
                        <div class="carousel-item p-3 {{ $key==0?'active':'' }}" >
                            <div class="row" style="border-radius: 3px; border: 1px solid #FFC600; margin:80px;">
                                <div class="col-4 p-4">
                                    <p>{{ $rev->user->first_name }}</p>
                                    <img class="img-fluid" src="{{ asset('public'.$rev->user->photo) }}">
                                </div>
                                <div class="col-8 p-4">
                                    <div class="mb-4">
                                        <p style="margin-bottom:0;">Посетил(-а) тур "<strong>{{ $rev->tour->title }}</strong>"</p>
                                        <p style="margin-bottom:0;">Экскурсовод: <strong>{{ $rev->user->last_name }} {{ $rev->user->first_name }}</strong></p>
                                    </div>

                                    <p>{{ $rev->text }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach


                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                      </svg>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                      </svg>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>


    </div>
</div>
<div class="row justify-content-center" style="background-color: #EBEBEB; padding:45px; margin-bottom: 90px;">
    <div class="col-auto">
        <form method="post" action="#" class="d-flex align-items-center">
            @csrf
            @method('post')
            <p style="margin-right: 20px; margin-bottom:0;">Узнавай первым о новых акциях!</p>
            <input style="margin-right: 20px;" type="email" placeholder="Email" name="email">
            <button class="style-btn" type="submit">подписаться</button>
        </form>
    </div>
</div>


@endsection

<style>
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
