@extends('client.base')
@section('style')
    @vite('resources/scss/panel/login.scss')
@endsection
@section('content')
<main>
    <div class="row">
        <div class="col-12 mb-3 my-5">
            <p class="title-text text-center h4">Авторизация для администратора</p>
        </div>
        <div class="col-12">
            <div class="card card-form-wrapper">
                <div class="card-body">
                    <div class="d-flex justify-content-md-center mb-5">
                        <div class="col-lg-3 col-md-6 col-12">
                            <p class="card-title text-center">Вход в личный кабинет администратора. Укажите свою почту и пароль, выданный вам администратором</p>
                        </div>
                    </div>
                    <div class="row justify-content-md-center align-items-md-center mb-5">
                        <div class="col-md-2 logo">
                            <img src="{{Vite::asset('resources/images/logo_mpt.png')}}" />
                        </div>
                        <div class="col-md-7 col-lg-6 form-wrapper">
                            <form method="post" action="{{route('panel.auth')}}">
                                @csrf
                                <div class="row g-lg-3 mb-md-3 mb-lg-0 align-items-center">
                                    <label for="email" class="col-form-label py-0">Почта</label>
                                    <div class="col-5 my-0">
                                        <input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelpInline">
                                    </div>
                                    <div class="col-auto my-0">
                                        <span id="emailHelpInline" class="form-text"><span class="fw-bold">Почта</span> - укажите ваш адрес электронной почты</span>
                                    </div>
                                </div>
                                <div class="row g-lg-3 align-items-center">
                                    <label for="password" class="col-form-label">Пароль</label>
                                    <div class="col-5 my-0">
                                        <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline">
                                    </div>
                                    <div class="col-auto my-0">
                                        <span id="passwordHelpInline" class="form-text"><span class="fw-bold">Пароль</span> - укажите выданный вам пароль</span>
                                    </div>
                                </div>
                                <div class="row g-lg-3 align-items-center">
                                    <label class="col-form-label"></label>
                                    <div class="col-5 my-0">
                                        <button type="submit" class="btn btn-primary w-100">Войти</button>
                                    </div>
                                </div>
                                @error('error')
                                    <div class="form-text text-danger">Логин или пароль введены неверно</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection