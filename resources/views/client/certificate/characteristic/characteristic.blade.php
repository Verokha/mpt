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
            <p class="title-text text-start text-break h5">Заказ характеристики</p>
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
                    <p class="card-title">Заказ характеристики<p>
                    <form method="POST" action="{{route('post.certificate.characteristic')}}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-labe p-0" for="all">Форма получения</label>
                                    <p class="control-label p-0" for="allSelect">Эл. Формат / Бумажный носитель</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="item-input">
                                        <label for="inputSchool" class="form-label required simple-input-label">Школа</label>
                                        <input type="text" required maxlength="509" class="form-control" name="inputSchool" id="inputSchool">
                                        @error('inputSchool')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                    <div class="item-input">
                                        <label for="inputEndSchool" class="form-label required simple-input-label">Год окончания школы</label>
                                        <select class="form-control" name="inputEndSchool" id="inputEndSchool" required>
                                            <option value=""></option>
                                            @for ($year = (int)date('Y'); 1900 <= $year; $year--)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endfor
                                        </select>
                                        @error('inputEndSchool')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                    <div class="item-input">
                                        <label for="inputYearOfEntry" class="form-label required simple-input-label">Год поступления в МПТ</label>
                                        <select class="form-control" name="inputYearOfEntry" id="inputYearOfEntry" required>
                                            <option value=""></option>
                                            @for ($year = (int)date('Y'); 1900 <= $year; $year--)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endfor
                                        </select>
                                        @error('inputYearOfEntry')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                    <div class="item-input">
                                        <label for="responsibilities" class="control-label required simple-input-label">Обязанности в группе</label>
                                        <select class="form-select" name="responsibilities" required>
                                            <option value=""></option>
                                            <option value="Ответственный за успеваемость">Ответственный за успеваемость</option>
                                            <option value="Ответственный за посещаемость">Ответственный за посещаемость</option>
                                            <option value="Староста группы">Староста группы</option>
                                            <option value="Нет">Нет</option>
                                        </select>
                                        @error('responsibilities')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                    <div class="item-input">
                                        <label for="inputWhereNeeded" class="form-label required simple-input-label">Куда нужна характеристика</label>
                                        <input required maxlength="254" type="text" class="form-control" name="inputWhereNeeded" id="inputWhereNeeded">
                                        @error('inputWhereNeeded')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="item-input">
                                        <label for="inputSecondName" class="form-label required simple-input-label">Фамилия</label>
                                        <input type="text" required maxlength="509" class="form-control" name="inputSecondName" id="inputSecondName" value="{{auth('student')->user()->second_name ?? ''}}">
                                        @error('inputSecondName')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputFirstdName" class="form-label required simple-input-label">Имя</label>
                                        <input type="text" required maxlength="509" class="form-control" name="inputFirstdName" id="inputFirstdName" >
                                        @error('inputFirstdName')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputPatronymic" class="form-label simple-input-label">Отчество (*если его нет,  поставьте прочерк или слово "нет")</label>
                                        <input type="text" class="form-control" name="inputPatronymic" id="inputPatronymic" value="{{auth('student')->user()->patronymic ?? ''}}">
                                        @error('inputPatronymic')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputSemester" class="control-label required simple-input-label">Семестр</label>
                                        <select class="form-select" name="inputSemester" id="inputSemester" required>
                                            <option value=""></option>
                                            @foreach ($semester as $item)
                                                <option value="{{$item->name}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('inputSemester')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputGroup" class="form-label required simple-input-label">Группа</label>
                                        <input type="text" required maxlength="509" class="form-control" name="inputGroup" id="inputGroup">
                                        @error('inputGroup')
                                            <div class="form-text text-danger">Обязательное поле заполнено некорректно.</div>
                                        @enderror
                                    </div>

                                    <div class="item-input">
                                        <label for="inputYear" class="form-label required simple-input-label">Дата рождения</label>
                                        <input type="date" required class="form-control" name="inputYear" id="inputYear">
                                        @error('inputYear')
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