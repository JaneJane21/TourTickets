@extends('layout.app')
@section('title')
ТУР-НН Вход
@endsection
@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="row">
        <div class="col-12 m-3">
            <div class="row">
                <div style="border-radius: 10px; background: #F8F8F8; box-shadow: -4px 4px 4px 0px rgba(0, 0, 0, 0.25); margin-right: -30px; z-index:1;" class="col-6 p-5 d-flex flex-column align-items-center">
                    <p class="mb-5">Вход в аккаунт</p>
                    <form method="post" action="{{route('auth')}}">
                        @method('post')
                        @csrf
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone" @error('phone')
                            is_invalid
                          @enderror>
                          <div class="invalid-feedback d-block">
                            @error('phone')
                              {{$message}}
                            @enderror
                          </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                          <input type="password" class="form-control" id="password" name="password" @error('password')
                          is_invalid
                        @enderror>
                        <div class="invalid-feedback d-block">
                          @error('password')
                            {{$message}}
                          @enderror
                        </div>
                        </div>

                    <div class="row  d-flex justify-content-center">
                        <div class="col-3">
                            <button type="submit" style="border-radius: 6px; background: #FFC600;" class="btn">войти</button>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-6">
                    <img style="height: 100%; width:auto; object-fit: cover; padding: 0; border-radius: 10px;" class="img-fluid" src="{{ asset('public\images\guest_bg.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    label{
        font-size: 14px;
    }
</style>
