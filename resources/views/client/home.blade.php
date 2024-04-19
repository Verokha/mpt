@extends('client.base')
@section('style')
    @vite('resources/scss/client/home.scss')
@endsection
@section('content')
    <main>
        @if(Auth::guard('student')->check())
            <div class="row actions-container">
            <div class="col-12">
                    <div class="actions card text-center shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Главная страница</h4>
                            <p class="card-text">{{$description}}</p>
                            <div class="row gy-2 text-center">
                                <div class="col-12 col-md-4">
                                    <a href="{{route('certificate.study')}}" class="w-xs-100 card-link btn btn-primary h-100">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            Оформления заявления на получение справки
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{route('certificate.characteristic')}}" class="w-xs-100 card-link btn btn-primary h-100">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            Оформление характеристики
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-4">
                                    <a href="{{route('certificate.paymentOrder')}}" class="w-xs-100 card-link btn btn-primary h-100">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            Загрузить платежку
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row accordion-container">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="accordion " id="accordionFaq">
                                @foreach ($faqs as $key => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed text-decoration-underline" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$key}}" aria-expanded="false" aria-controls="collapse_{{$key}}">
                                                {{$faq->question}}
                                            </button>
                                        </h2>
                                        <div id="collapse_{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                                        <div class="accordion-body">{{$faq->answer}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row actions-container">
                <div class="col-12 auth-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <p class="title text-center">Для осуществления действий со справками, необходимо аутентифицироваться через свою МПТ почту</p>
                        </div>
                    </div>
                    <div class="row justify-content-center row-card-auth">
                        <div class="col-12 col-md-9">
                            <div class="card card-auth">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Аутентификация через Google</h5>
                                    <a href="{{ route('google.login') }}" class="btn btn-primary">Аутентифицироваться</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection