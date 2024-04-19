@extends('client.base')
@section('style')
    @vite('resources/scss/panel/base.scss')
    @vite('resources/scss/panel/index.scss')
@endsection
@section('content')
<main>
    <div class="row">
        <div class="col-12 mb-3">
            <p class="title-text text-start text-break h5">Входящие заявления</p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('panel.index', ['status_request' => 'all', 'type_request' => $typeRequest]) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($statusRequest === 'all') _mtp selected @endif">Все</button>
            </a>
        </div>
        <div class="col-md-3 mt-2 mt-md-0">
            <a href="{{ route('panel.index', ['status_request' => 'wait_action', 'type_request' => $typeRequest]) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($statusRequest === 'wait_action') _mtp selected  @endif">В ожидании действий</button>
            </a>
        </div>
        <div class="col-md-3 mt-2 mt-md-0">
            <a href="{{ route('panel.index', ['status_request' => 'wait_send', 'type_request' => $typeRequest]) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($statusRequest === 'wait_send') _mtp selected @endif">В ожидании отправки</button>
            </a>
        </div>
        <div class="col-md-3 mt-2 mt-md-0">
            <a href="{{ route('panel.index', ['status_request' => 'archive', 'type_request' => $typeRequest]) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($statusRequest === 'archive') _mtp selected @endif">Архив</button>
            </a>
        </div>
        <div class="col-12 mt-3">
            <input class="form-control" type="text" placeholder="Поиск по студенту" aria-label="default input example">
        </div>

        <div class="col-md-3 mt-3 mb-md-5">
            <a href="{{ route('panel.index', ['status_request' => $statusRequest, 'type_request' => 'study']) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($typeRequest === 'study') _mtp selected @endif">Справки об обучении</button>
            </a>
        </div>
        <div class="col-md-3 mt-2 mt-md-3 mb-md-5">
            <a href="{{ route('panel.index', ['status_request' => $statusRequest, 'type_request' => 'payment']) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($typeRequest === 'payment') _mtp selected @endif">Платежки</button>
            </a>
        </div>
        <div class="col-md-3 mt-2 mt-md-3 mb-5">
            <a href="{{ route('panel.index', ['status_request' => $statusRequest, 'type_request' => 'characteristic']) }}">
                <button type="button" class="btn btn-secondary w-100 h-100 @if($typeRequest === 'characteristic') _mtp selected @endif">Характеристика</button>
            </a>
        </div>

        @foreach ($data as $item)
            <div class="col-12 card_wrapper">
                <div class="card shadow mb-3">
                    <div class="row g-0">
                        <div class="col-md-6 left_part">
                            <div class="card-body">
                                <h5 class="card-title type_label mb-3">{{$item['typeLabel']}}</h5>
                                <small class="text-body-secondary">Фамилия студента:</small>
                                <p class="card-text">{{$item['second_name']}}</p>
                                <small class="text-body-secondary">Имя студента:</small>
                                <p class="card-text">{{$item['first_name']}}</p>
                                <small class="text-body-secondary">Отчество студента:</small>
                                <p class="card-text">{{$item['patronymic']}}</p>
                                @if ($item['birthDate'])
                                    <small class="text-body-secondary">Дата рождения:</small>
                                    <p class="card-text">{{$item['birthDate']}}</p>
                                @endif
                                @if ($item['school'])
                                    <small class="text-body-secondary">Школа:</small>
                                    <p class="card-text">{{$item['school']}}</p>
                                @endif
                                @if ($item['endSchool'])
                                    <small class="text-body-secondary">Год окончания школы:</small>
                                    <p class="card-text">{{$item['endSchool']}}</p>
                                @endif
                                @if ($item['typeDocument'])
                                    <small class="text-body-secondary">Необходимый документ:</small>
                                    <p class="card-text">{{$item['typeDocument']}}</p>
                                @endif
                                @if ($item['paymentFile'])
                                    <small class="text-body-secondary">Файл платежки:</small>
                                    <div><a href="{{$item['paymentFile']}}" class="card-link" target="_blank">Посмотреть</a></div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 right_part">
                            <div class="card-body text-md-end">
                                <div class="mb-2">
                                    <button type="button" class="btn shadow current_status">{{$item['status']}}</button>
                                </div>
                                <small class="text-body-secondary">Отправлено {{$item['created_at']}}</small>
                                <p class="card-text">{{$item['first_name']}} {{$item['second_name']}}</p>
                                <small class="text-body-secondary">Адрес электронной почты студента:</small>
                                <p class="card-text">{{$item['email']}}</p>
                                <small class="text-body-secondary">Группа:</small>
                                <p class="card-text">{{$item['group']}}</p>
                                @if ($item['semester'])
                                    <small class="text-body-secondary">Семестр:</small>
                                    <p class="card-text">{{$item['semester']}}</p>
                                @endif
                                @if ($item['startMpt'])
                                    <small class="text-body-secondary">Год поступления в МПТ:</small>
                                    <p class="card-text">{{$item['startMpt']}}</p>
                                @endif
                                @if ($item['responsibilities'])
                                    <small class="text-body-secondary">Обязанности в группе:</small>
                                    <p class="card-text">{{$item['responsibilities']}}</p>
                                @endif
                                @if ($item['whereNeeded'])
                                    <small class="text-body-secondary">Куда нужна характеристика:</small>
                                    <p class="card-text">{{$item['whereNeeded']}}</p>
                                @endif
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end actions">
                                    @foreach ($item['actions'] as $techName => $action)
                                        <button type="button" class="btn w-25 shadow action {{$techName}}">{{$action}}</button> 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</main>
@endsection