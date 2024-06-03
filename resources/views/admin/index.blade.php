@extends('layout.app')
@section('title')
Admin
@endsection
@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    {{-- ---------------ТУРЫ------------------- --}}
<div class="row mb-5">
    <div class="col-12">
        <h5 class="mb-4">Проводмые туры</h5>
        <div class="row">
            @foreach ($tours as $tour)
                <div class="col-3 tour-card d-flex flex-column justify-content-between">
                    <div class="img-block">
                        <img style="width: 100%;" src="{{ asset('public'.$tour->img) }}">
                    </div>
                    <div class="text-block p-4">
                    <div class="row mb-3">
                        
                            <h5 class="bold mb-3">{{ $tour->title }}</h5>
                            <p>Всего проведено:</p>
                            <p>Запланировано провести:</p>
                            <p>Стоимость: {{ $tour->price }} руб/чел</p>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <a class="btn btn-link" href="{{ route('destroy_tour',['tour'=>$tour]) }}">удалить тур</a>
                        </div>
                        <div class="col-7">
                            <a href="{{ route('show_update_tour',['tour'=>$tour]) }}" class="btn btn-link" >редактировать тур</a>
                        </div>
                        
                        
                        
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#planModal_{{ $tour->id }}" class="btn btn-warning">запланировать тур</button>
                            
                        </div>
                        
                    </div>
                </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="planModal_{{ $tour->id }}" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="planModalLabel">Запланировать тур</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{route('plan_tour',['tour'=>$tour])}}">
                            @csrf
                            @method('post')
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <label for="date_start" class="form-label">Дата начала</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start">
                                </div>
                                <div class="col-auto">
                                    <label for="date_finish" class="form-label">Дата окончания</label>
                                    <input type="date" class="form-control" id="date_finish" name="date_finish">
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label for="seat_cnt" class="form-label">Количество мест</label>
                                <input type="text" class="form-control w-25" id="seat_cnt" name="seat_cnt">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">отмена</button>
                            <button type="submit" class="btn btn-primary">подтвердить тур</button>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                    </div>
                </div>
            @endforeach
            <div class="col-3 add-card ">
                <button type="button" class="p-5" style="outline: none; background:none; border: none; width: 100%; height: 100%;" data-bs-toggle="modal" data-bs-target="#tourModal">
                    <p class="bold" style="font-size: 5rem;">+</p>
                    <p class="bold">новый тур</p>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="tourModal" tabindex="-1" aria-labelledby="tourModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="tourModallLabel">Добавление нового тура</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('store_tour') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-4 m-4" style="border: 1px dotted grey; border-radius:6px;">
                                    <button type="button" class="" style="outline: none; background:none; border: none;">

                                        <p class="bold" style="font-size: 5rem;z-index:1; width:100%; height:100%;">+<input type="file" name="img" style="opacity:0; width:100%; height:100%;margin-top:-130px; cursor: pointer; "></p>

                                    </button>
                                    <p class="bold text-center">фото тура</p>
                                </div>
                                <div class="col-6">
                                    <p class="bold text-center">Информация о туре</p>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Название тура*</label>
                                        <input type="text" class="form-control mb-4" name="title" id="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Описание тура*</label>
                                        <textarea type="text" class="form-control mb-4" name="description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 align-items-end">
                                <div class="col-3">
                                    <label for="user_id" class="form-label">Экскурсовод*</label>
                                    <select id="user_id" class="form-select" name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="city_id" class="form-label">Город выезда*</label>
                                    <select id="city_id" class="form-select" name="city_id">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">

                                        <label for="price" class="form-label">Цена тура на человека*</label>
                                        <input type="text" class="form-control" name="price" id="price">

                                </div>
                                <div class="col-3">

                                        <label for="discount" class="form-label">Размер детской скидки*</label>
                                        <input type="text" class="form-control" name="discount" id="discount">

                                </div>
                            </div>
                            <div class="row">
                                <p>Локации в туре*</p>
                                @foreach ($locations as $location)
                                    <div class="row">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $location->id }}" value="{{ $location->id }}" name="locations[]">
                                            <label class="form-check-label" for="{{ $location->id }}">{{ $location->title }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                

                            </div>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-warning">сохранить</button>
                                </div>
                            </div>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
{{-- ------------------ПЛАНЫ------------------ --}}
<div class="row mb-5">
    <div class="col-12">
        <h5 class="mb-4">Запланированные туры</h5>
        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-3 tour-card d-flex flex-column justify-content-between">
                    <div class="img-block">
                        <img style="width: 100%;" src="{{ asset('public'.$plan->tour->img) }}">
                    </div>
                    <div class="text-block p-4">
                    <div class="row mb-3">
                        
                            <h5 class="bold mb-3">{{ $plan->tour->title }}</h5>
                            <p>Дата начала: <strong>{{ implode('.',array_reverse(explode('-',$plan->date_start))) }}</strong></p>
                            <p>Дата окончания: <strong>{{ implode('.',array_reverse(explode('-',$plan->date_finish))) }}</strong> </p>
                            <p>Количество мест: {{ $plan->seat_cnt }}</p>
                            <p>Статус: {{ $plan->status }}</p>
                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-auto">
                            <a class="btn btn-link" href="{{ route('cancel_plan',['planTour'=>$plan]) }}">отменить</a>
                        </div>
                        <div class="col-auto">
                            <a data-bs-toggle="modal" data-bs-target="#editPlanModal_{{ $plan->id }}" href="#" class="btn btn-link">редактировать</a>
                        </div>
                        <div class="col-auto">
                            <a  href="{{ route('complete_plan',['planTour'=>$plan]) }}" class="btn btn-warning ">тур выполнен</a>
                        </div>
                        
                        
                        
                    </div>
                </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editPlanModal_{{ $plan->id }}" tabindex="-1" aria-labelledby="editPlanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="editPlanModalLabel">Редактирование запланированного тура</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{ route('edit_plan',['planTour'=>$plan]) }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <label for="date_start" class="form-label">Дата начала</label>
                                    <input type="date" value="{{ $plan->date_start }}" class="form-control" id="date_start" name="date_start">
                                </div>
                                <div class="col-auto">
                                    <label for="date_finish" class="form-label">Дата окончания</label>
                                    <input type="date" value="{{ $plan->date_finish }}" class="form-control" id="date_finish" name="date_finish">
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label for="seat_cnt" class="form-label">Количество мест</label>
                                <input type="text" value="{{ $plan->seat_cnt }}" class="form-control w-25" id="seat_cnt" name="seat_cnt">
                            </div>
                            <button class="btn btn-warning" type="submit">сохранить</button>

                            
                        </form>
                        </div>
                        
                    </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
{{-- ------------------ЛОКАЦИИ------------------ --}}
<div class="row mb-5">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-2">
                <h5 class="mb-4">Локации</h5>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#locationModal">
                    + добавить локацию
                </button>

                <!-- Modal -->
                <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="locationModalLabel">Добавление новой локации</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{route('store_location')}}" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label mb-2">Название локации*</label>
                                <input type="text" class="form-control mb-4" name="title" id="title">
                            </div>
                            <div class="mb-5">
                                <label for="img" class="form-label mb-2">Фото локации*</label>
                                <input type="file" class="form-control mb-4" name="img" id="img">
                            </div>
                            <button class="btn btn-warning" type="submit">сохранить</button>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mb-5">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действия</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                    <tr>
                        <th scope="row">{{ $location->id }}</th>
                        <td><img style="border-radius: 50%;width:70px; height:70px;" class="img-fluid" src="{{ asset('public'.$location->img) }}"></td>
                        <td>{{ $location->title }}</td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('destroy_location',['location'=>$location]) }}" class="btn btn-outline-warning">удалить</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editLocationModal_{{ $location->id }}">
                                        изменить
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editLocationModal_{{ $location->id }}" tabindex="-1" aria-labelledby="editLocationModal_{{ $location->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                            <h1 class="modal-title fs-5" id="editLocationModal_{{ $location->id }}Label">Изменение: {{ $location->title }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="{{ route('update_location',['location'=>$location]) }}" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Название локации*</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $location->title }}" id="title">
                                                </div>
                                                <div class="mb-5">
                                                    <label for="img" class="form-label">Новое фото локации</label>
                                                    <input type="file" class="form-control" name="img" id="img">
                                                </div>
                                                <button class="btn btn-warning" type="submit">сохранить</button>
                                            </form>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
              </table>
        </div>
    </div>
</div>
{{-- ------------------ГОРОДА------------------ --}}
<div class="row mb-5">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-2">
                <h5 class="mb-4">Города</h5>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cityModal">
                    + добавить город
                </button>

                <!-- Modal -->
                <div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="cityModalLabel">Добавление нового города</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{route('store_city')}}">
                            @method('post')
                            @csrf
                            <label for="title" class="form-label mb-2">Название города*</label>
                            <input type="text" class="form-control mb-4" name="title" id="title">
                            <button class="btn btn-warning" type="submit">сохранить</button>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Действия</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                    <tr>
                        <th scope="row">{{ $city->id }}</th>
                        <td>{{ $city->title }}</td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('destroy_city',['city'=>$city]) }}" class="btn btn-outline-warning">удалить</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCityModal_{{ $city->id }}">
                                        изменить
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editCityModal_{{ $city->id }}" tabindex="-1" aria-labelledby="editCityModal_{{ $city->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                            <h1 class="modal-title fs-5" id="editCityModal_{{ $city->id }}Label">Изменение: {{ $city->title }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="{{ route('update_city',['city'=>$city]) }}">
                                                @method('put')
                                                @csrf
                                                <label for="title" class="form-label mb-2">Название города*</label>
                                                <input type="text" value="{{ $city->title }}" class="form-control mb-4" name="title" id="title">
                                                <button class="btn btn-warning" type="submit">сохранить</button>
                                            </form>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
              </table>
        </div>
    </div>
</div>
{{-- ------------------АКЦИИ------------------ --}}
<div class="row">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-2">
                <h5 class="mb-4">Акции</h5>
            </div>
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#saleModal">
                    + добавить акцию
                </button>

                <!-- Modal -->
                <div class="modal fade" id="saleModal" tabindex="-1" aria-labelledby="saleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="saleModalLabel">Добавление новой акции</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{route('store_sale')}}" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label mb-2">Название акции*</label>
                                <input type="text" class="form-control mb-4" name="title" id="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label mb-2">Описание акции*</label>
                                <textarea class="form-control mb-4" name="description" id="description"></textarea>
                            </div>
                            <div class="mb-5">
                                <label for="img" class="form-label mb-2">Фото акции*</label>
                                <input type="file" class="form-control mb-4" name="img" id="img">
                            </div>
                            <button class="btn btn-warning" type="submit">сохранить</button>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Действия</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <th scope="row">{{ $sale->id }}</th>
                        <td><img style="width:100px; height:auto;" class="img-fluid" src="{{ asset('public'.$sale->img) }}"></td>
                        <td>{{ $sale->title }}</td>
                        <td>{{ $sale->description }}</td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('destroy_sale',['sale'=>$sale]) }}" class="btn btn-outline-warning">удалить</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSaleModal_{{ $sale->id }}">
                                        изменить
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editSaleModal_{{ $sale->id }}" tabindex="-1" aria-labelledby="editSaleModal_{{ $sale->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                            <h1 class="modal-title fs-5" id="editSaleModal_{{ $sale->id }}Label">Изменение: {{ $sale->title }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="{{ route('update_sale',['sale'=>$sale]) }}" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="title" class="form-label mb-2">Название акции</label>
                                                    <input type="text" class="form-control mb-4" name="title" value="{{ $sale->title }}" id="title">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label mb-2">Описание акции</label>
                                                    <textarea class="form-control mb-4" name="description" id="description">{{ $sale->description }}</textarea>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="img" class="form-label mb-2">Новое фото акции</label>
                                                    <input type="file" class="form-control mb-4" name="img" id="img">
                                                </div>
                                                <button class="btn btn-warning" type="submit">сохранить</button>
                                            </form>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
              </table>
        </div>
    </div>
</div>
</div>
<style>
    .add-card, .tour-card{
        height: auto;
        border-radius: 6px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        margin-right: 30px;
        
    }
    .add-card{
        background: #EBEBEB;
        
    }
    .tour-card{
        padding: 0px !important;
        background: #F8F8F8;
    }
    .bold{
        font-weight: 700;
    }
    .tour-card p, .tour-card a, .tour-card button{
        margin-bottom: 0;
        font-size: 12px;
        color: black;
    }
    .text-block{
        border-radius: 6px;
        background: #F8F8F8;
        z-index:1;
        margin-top: -40px;
    }
</style>
@endsection

