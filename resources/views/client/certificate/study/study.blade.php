@extends('client.base')
@section('style')
    @vite('resources/scss/client/study.certificate.scss')
@endsection
@section('script')
    @vite('resources/js/client/form-runner.js')
@endsection
@section('content')
<main>
    <div class="row">
        <div class="col-12">
            <p class="title-text text-start text-break h5">Заказ справки об обучении</p>
        </div>
        <div class="col-12 col-sm-6">
            <p class="description-text text-start text-break h6">{{$description}}</p>
        </div>
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if(session('fail'))
                <div class="alert alert-danger" role="alert">{{ session('fail') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Заказ справки об обучении<p>
                    <form method="POST" action={{route('post.certificate.study')}}>
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-labe p-0" for="all">Форма получения</label>
                                    <p class="control-label p-0" for="allSelect">Эл. Формат / Бумажный носитель</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="radio-title radio control-label required">Выбор необходимого документа</label>
                                    @foreach ($typeOfDocs as $typeDoc)
                                        <div class="form-check">
                                            <input class="form-check-input" required type="radio" name="typeDoc" id="typeDoc_{{$typeDoc->id}}" value="{{$typeDoc->id}}">
                                            <label class="form-check-label radio-type-label" for="typeDoc_{{$typeDoc->id}}">
                                                {{$typeDoc->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('typeDoc')
                                        <div class="form-text text-danger">Обязательное поле не выбрано или заполнено некорректно.</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="item-input">
                                        <label for="inputSecondName" maxlength="509" class="required form-label simple-input-label">Фамилия</label>
                                        <input type="text" required class="form-control" name="inputSecondName" id="inputSecondName" value="{{auth('student')->user()->second_name ?? ''}}">
                                        @error('inputSecondName')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputFirstdName" class="required form-label simple-input-label">Имя</label>
                                        <input type="text" required maxlength="509" class="form-control" name="inputFirstdName" id="inputFirstdName" >
                                        @error('inputFirstdName')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputPatronymic" maxlength="509" class="form-label simple-input-label">Отчество (*если его нет,  поставьте прочерк или слово "нет")</label>
                                        <input type="text" class="form-control" name="inputPatronymic" id="inputPatronymic" value="{{auth('student')->user()->patronymic ?? ''}}">
                                    </div>

                                    <div class="item-input">
                                        <label for="inputGroup" maxlength="509" class="required form-label simple-input-label">Группа</label>
                                        <input type="text" required class="form-control" name="inputGroup" id="inputGroup">
                                        @error('inputGroup')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 submit-block action_button">
                                    <button type="submit" class="btn btn-primary w-100">Заказать</button>
                                </div>
                                <div class="col-12 loader_button submit-block d-none">
                                    <button class="btn neutral w-100" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Отправка...
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection