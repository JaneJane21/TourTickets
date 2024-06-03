@extends('layout.app')
@section('title')
Редактирование тура {{ $tour->title }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
        <h2 class="text-center mb-5 bg-warning p-3">Редактирование тура "{{ $tour->title }}"</h2>
        <form action="{{ route('update_tour',['tour'=>$tour]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-4 m-4" style="border: 1px dotted grey; border-radius:6px;">
                <button type="button" class="" style="outline: none; background:none; border: none;">

                    <p class="bold" style="font-size: 5rem;z-index:1; width:100%; height:100%;">+<input type="file" name="img" style="opacity:0; width:100%; height:100%;margin-top:-130px; cursor: pointer; "></p>

                </button>
                <p class="bold text-center">новое фото тура</p>
            </div>
            <div class="col-6">
                <p class="bold text-center">Информация о туре</p>
                <div class="mb-3">
                    <label for="title" class="form-label">Название тура*</label>
                    <input type="text" class="form-control mb-4" value="{{ $tour->title }}" name="title" id="title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание тура*</label>
                    <textarea type="text" class="form-control mb-4" name="description" id="description">{{ $tour->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row mb-5 align-items-end">
            <div class="col-3">
                <label for="user_id" class="form-label">Экскурсовод*</label>
                <select id="user_id" class="form-select" name="user_id">
                    <option selected disabled>{{ $tour->user->first_name }} {{ $tour->user->last_name }}</option>
                    @foreach ($users as $user)
                        @if ($user->id != $tour->user_id)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label for="city_id" class="form-label">Город выезда*</label>
                <select id="city_id" class="form-select" name="city_id">
                    <option selected disabled>{{ $tour->city->title }}</option>
                    @foreach ($cities as $city)
                    
                        @if ($city->title != $tour->city->title)
                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div>
            <div class="col-3">

                    <label for="price" class="form-label">Цена тура на человека*</label>
                    <input type="text" class="form-control" value="{{ $tour->price }}" name="price" id="price">

            </div>
            <div class="col-3">

                    <label for="discount" class="form-label">Размер детской скидки*</label>
                    <input type="text" class="form-control" value="{{ $tour->discount }}" name="discount" id="discount">

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Локации в туре</p>
            @foreach ($locations as $location)
           
                @if (in_array($location->id,$locationsintour))                     
                <div class="row">
                    <div class="mb-3 form-check">
                            <input type="checkbox" checked class="form-check-input" id="{{ $location->id }}" value="{{ $location->id }}" name="locations[]">  
                            <label class="form-check-label" for="{{ $location->id }}">{{ $location->title }}</label>
                    </div>
                </div>   
                    @else
                <div class="row">
                    <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="{{ $location->id }}" value="{{ $location->id }}" name="locations[]">  
                            <label class="form-check-label" for="{{ $location->id }}">{{ $location->title }}</label>
                    </div>              
                @endif
            @endforeach
            </div>

            

        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                <button type="submit" class="btn btn-warning">сохранить</button>
            </div>
        </div>
    </form>
    </div>
    </div>
    
    
</div>
@endsection
<style>
    .bold{
        font-weight: 700;
    }
</style>