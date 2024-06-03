@extends('layout.app')
@section('title')
Создание аккаунта
@endsection
@section('content')
<div class="container">
    <div class="row">
      @if (session()->has('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
      @endif
        <div class="col-12 m-3">
            <div class="row">
                <div style="border-radius: 10px; background: #F8F8F8; box-shadow: -4px 4px 4px 0px rgba(0, 0, 0, 0.25); margin-right: -30px; z-index:1;" class="col-6 p-5 d-flex flex-column align-items-center">
                    <p class="mb-5">Создание аккаунта</p>
                    <form action="{{route('store_user')}}" method="post">
                      @method('post')
                      @csrf
                      <div class="row mb-3">
                        <div class="col">
                            <label for="first_name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" @error('first_name')
                              is_invalid
                            @enderror>
                            <div class="invalid-feedback d-block">
                              @error('first_name')
                                {{$message}}
                              @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="last_name"name="last_name" @error('last_name')
                            is_invalid
                          @enderror>
                          <div class="invalid-feedback d-block">
                            @error('last_name')
                              {{$message}}
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="birthday" class="form-label">Дата рождения</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" @error('birthday')
                            is_invalid
                          @enderror>
                          <div class="invalid-feedback d-block">
                            @error('birthday')
                              {{$message}}
                            @enderror
                          </div>
                          </div>
                          <div class="col-md-3">
                            <label for="gender" class="form-label">Пол</label>
                            <select id="gender" class="form-select" name="gender">
                          
                              
                              <option value="0">женский</option>
                              <option value="1">мужской</option>
                            </select>
                            <div class="invalid-feedback">
                            
                          </div>
                          </div>
                          
                          <div class="col-md-5">
                            <label for="email" class="form-label">Email</label>
                            <input type="mail" class="form-control" id="email" name="email" @error('email')
                            is_invalid
                          @enderror>
                          <div class="invalid-feedback d-block">
                            @error('email')
                              {{$message}}
                            @enderror
                          </div>
                          </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-5">
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
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-5">
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
                        <div class="col-md-5">
                            <label for="password_confirmation" class="form-label">Повторите пароль</label>
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" @error('password')
                          is_invalid
                        @enderror>
                        <div class="invalid-feedback d-block">
                          @error('password')
                            {{$message}}
                          @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="rule" name="rule" @error('rule')
                          is_invalid
                        @enderror>
                        
                          <label class="form-check-label" for="rule">
                            согласен(-на) на обработку персональных данных
                          </label>
                          <div class="invalid-feedback d-block">
                          @error('rule')
                            {{$message}}
                          @enderror
                        </div>
                        </div>
                        
                      </div>
                    </div>

                    <div class="row  d-flex justify-content-center">
                        <div class="col-3">
                            <button type="submit" style="border-radius: 6px; background: #FFC600;" class="btn">регистрация</button>
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
