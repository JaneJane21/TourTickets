@extends('layout.app')
@section('title')
Мой профиль
@endsection
@section('content')
<div class="container">
  @if (session()->has('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-7">
            <div class="row">
                <div class="col-auto" style="margin-right: 40px;">
                    @if ($user->photo !='')
                        <img class="img-fluid" style="width: 200px; border-radius:50%; height:200px;" src="{{ asset('public'.$user->photo) }}">
                    @else
                        <img class="img-fluid" style="width: 200px;" src="{{ asset('public\images\user.svg') }}">
                    @endif
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <p style="margin-bottom: 0;">{{ $user->last_name }}</p>
                        <hr style="color: #FFC600; height:2px; margin:0;">
                    </div>
                    <div class="mb-3">
                        <p style="margin-bottom: 0;">{{ $user->first_name }}</p>
                        <hr style="color: #FFC600; height:2px; margin:0;">
                    </div>
                    <button type="button" style="color: black; padding:0; margin-bottom:30px;" class="btn btn-link"
                    data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">редактировать</button>
                    <div class="collapse mb-5" style="z-index: 1; width:500px;" id="collapseExample">
                        <div class="card card-body">
                            
                                <form action="{{ route('update_user') }}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row mb-3">
                                      <div class="col-12">
                                          <label for="img" class="form-label">Новое фото профиля</label>
                                          <input type="file"  class="form-control" id="img" name="img">
                                        </div>
                                  </div>
                                    <div class="row mb-3">
                                      <div class="col">
                                          <label for="first_name" class="form-label">Имя</label>
                                          <input type="text" value="{{ $user->first_name }}" class="form-control" id="first_name" name="first_name" @error('first_name')
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
                                          <input type="text" value="{{ $user->last_name }}" class="form-control" id="last_name"name="last_name" @error('last_name')
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
                                          <input type="date" value="{{ $user->birthday }}" class="form-control" id="birthday" name="birthday" @error('birthday')
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
                                          @if ($user->gender == 0)
                                            <select id="gender" class="form-select" name="gender">
                                              <option selected disabled value="0">женский</option>
                                              <option value="1">мужской</option>
                                            </select>
                                          @else
                                          <select id="gender" class="form-select" name="gender">
                                            <option selected disabled value="1">мужской</option>
                                            <option value="0">женский</option>
                                          </select>
                                          @endif
                                          
                                          <div class="invalid-feedback">
                                          
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-5">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" value="{{ $user->email }}" class="form-control" id="email" name="email" @error('email')
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
                                          <input type="text" value="{{ $user->phone }}" class="form-control" id="phone" name="phone" @error('phone')
                                          is_invalid
                                        @enderror>
                                        <div class="invalid-feedback d-block">
                                          @error('phone')
                                            {{$message}}
                                          @enderror
                                        </div>
                                        </div>
                                  </div>
                                  <div class="row mb-3 align-items-end">
                                    
                                      <div class="col-md-5">
                                          <label for="password" class="form-label">Новый пароль</label>
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
                                          <label for="password_confirmation" class="form-label">Повторите новый пароль</label>
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
                                  
              
                                  <div class="row  d-flex justify-content-center">
                                      <div class="col-auto">
                                          <button type="submit" style="border-radius: 6px; background: #FFC600;" class="btn">сохранить изменения</button>
                                      </div>
                                  </div>
                              </form>
                            
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-auto">
                          <a href="{{ route('logout') }}" class="btn btn-warning" >выйти</a>
                        </div>
                      </div>
                    

                </div>
            </div>
        </div>
        <div class="col-5">
          <p>Всего посещено туров: <strong>{{ $total }}</strong></p>
          
          
          <h4>Предстоящие туры</h4>
          @foreach ($books as $book)
          <div class="tour-card p-4">
            <div class="row mb-3">
              <div class="row mb-3">
                <div class="col-auto ">
                  <h5>Бронь на имя: <strong>{{ $book->fio }}</strong></h5>
              </div>
              </div>
                    <div class="row mb-3">
                        <div class="col-auto ">
                            <h5 class="bold">{{ $book->plan_tour->tour->title }}</h5>
                        </div>
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <p><strong><span style="margin-right: 20px;">{{ implode('.',array_reverse(explode('-',$book->plan_tour->date_start))) }} - {{ implode('.',array_reverse(explode('-',$book->plan_tour->date_finish))) }}</span>I<span style="margin-left: 20px;">{{ $book->price }} руб/чел</span></strong> </p>
                        </div>
                    </div>
                    <div class="row">
                      <p>Город отправления: <strong>{{ $book->plan_tour->tour->city->title }}</strong></p>
                    </div>
                    <div class="row">
                      <div class="col-auto">
                        <button type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-html="true" title="@foreach($book->all_books as $b)
                          {{ $b->fio }}
                          @endforeach">
                        Всего участников: <strong>{{ count($book->all_books) }}</strong> 
                      </button>
                      </div>
                      
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-auto">
                        <a href="{{ route('cancel_book',['book'=>$book]) }}" class="btn btn-link">отменить бронь</a>
                      </div>
                    </div>
            </div>
        </div>
          @endforeach
          

          
        </div>
    </div>
    
</div>
<style>
.tour-card{
  height: auto;
  border-radius: 6px;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  margin-bottom: 20px;
  background: #F8F8F8;
}
.bold{
  font-weight: 700;
}
.tour-card p, .tour-card a, .tour-card button{
  margin-bottom: 0px;
  font-size: 14px;
  color: black;
}
</style>
@endsection