@extends('layout.app')
@section('title')
Бронирование тура
@endsection
@section('content')
<div class="container" id="Book">
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
                            <p style="font-size: 12px;" class="mb-5">Город выезда: <strong>{{ $plan->tour->city->title }}</strong></p>

                    </div>
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
    <div class="row mb-5 align-items-center" style="">
        <h4>Бронирование тура</h4>
        <div class="col-8">
            <form class="row" id="book-form" @submit.prevent=add_men>
                <div class="row">
                    <div class="col-5 d-flex flex-column">
                    <label for="fio" class="form-label">ФИО*</label>
                    <input name="fio" type="text" id="fio" required>
                    <div class="invalid-feedback">
                        Обязательное поле
                    </div>
                </div>
                <div class="col-4 d-flex flex-column">
                    <label for="phone" class="form-label">Телефон*</label>
                    <input name="phone" type="text" id="phone" required>
                    <div class="invalid-feedback">
                        Обязательное поле
                    </div>
                </div>
                <div class="col-3 d-flex flex-column">
                    <label for="birthday" class="form-label">Дата рождения*</label>
                    <input name="birthday" type="date" id="birthday" required>
                    <div class="invalid-feedback">
                        Обязательное поле
                    </div>
                </div>
                </div>
                <div class="row justify-content-end mt-3">
                <div class="col-3">
                    <button type="submit" class="btn btn-warning">+ добавить туриста</button>
                </div>
            </div>
            </form>
            
        </div>
    </div>
    <div class="row" v-if="books.length>0">
        <div class="col-6">
          <h4 class="mb-4">Список туристов</h4>
        <div class="" v-for="men in books">
            <div class="row mb-2 align-items-center justify-content-between" style="border-bottom: 1px solid rgb(121, 117, 117)">
                <div class="col-6">
                    <p style="margin-bottom: 0;">@{{ men.fio }}</p>
                </div>
                <div class="col-4 d-flex justify-content-end">  
                    <p style="margin-bottom: 0;" v-if="{{ $plan->tour->price }} != men.price "><span style="text-decoration: line-through">{{ $plan->tour->price }} руб </span> <strong> @{{ men.price }} руб</strong></p>
                    <p style="margin-bottom: 0;" v-else><strong>@{{ men.price }} руб</strong></p>
                </div>
                <div class="col-2">
                    <button @click="remove_men(men)" style="color: black" class="btn btn-link" type="button">удалить</button>
                </div>
            </div>
        </div>  
        </div>
    </div>
    <div class="row justify-content-center mt-5" v-if="books.length>0">
        <div class="col-auto">
            <button class="btn btn-warning" @click="send_data" type="button" style="font-size: 20px;">оформить бронирование</button>
        </div>
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
    input{
        border-radius: 6px;
        border: 1px solid #000 !important;
        padding: 8px;
        background: transparent;
    }
</style>

<script>
    const app = {
        data(){
            return {
                books:[]
            }
        },
        methods:{
            add_men(){
                let form = document.getElementById('book-form')
                price = {{ $plan->tour->price }}
                let age = ((new Date().getTime() - new Date(form.querySelector('[name="birthday"]').value)) / (24 * 3600 * 365.25 * 1000))
                if(age<16){
                    price = price - price*0.1
                }
                let men = {
                    fio: form.querySelector('[name="fio"]').value,
                    birthday: form.querySelector('[name="birthday"]').value,
                    phone: form.querySelector('[name="phone"]').value,
                    price:price,
                    plan_tour_id:{{ $plan->id }}
                }
                
                this.books.push(men)
                men = {}
                form.reset()
                console.log(this.books)
            },
            remove_men(men){
                this.books.splice(this.books.indexOf(men),1)
                // console.log(this.books)
            },
            async send_data(){
                const response = await fetch('{{ route('book') }}',{
                    method:'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'Content-Type':'application/json',
                    },
                    body: JSON.stringify(this.books)
                })
                if(response.status == 200){
                    window.location = response.url
                }
            }
        }

    }
    Vue.createApp(app).mount('#Book');
</script>
@endsection
