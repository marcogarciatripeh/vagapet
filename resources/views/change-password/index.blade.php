@extends('layouts.app')

@section('title', 'Alterar Senha - VagaPet')

@section('content')
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Cabeçalho Principal -->
        @if(isset($userType) && $userType === 'company')
            @include('layouts.partials.dashboard.header-company')
        @else
            @include('layouts.partials.dashboard.header-professional')
        @endif

        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- User Sidebar -->
        @if(isset($userType) && $userType === 'company')
            @include('layouts.partials.dashboard.sidebar-company')
        @else
            @include('layouts.partials.dashboard.sidebar-professional')
        @endif

        <!-- Dashboard Content -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Alterar Senha</h3>
                    <div class="text">Pronto para voltar ao trabalho?</div>
                </div>
                <!-- Card/Widget -->
                <div class="ls-widget">
                    <div class="widget-title">
                        <h4>Alterar Senha</h4>
                    </div>
                    <div class="widget-content">
                        <form class="default-form">
                            <div class="row">
                                <!-- Senha Antiga -->
                                <div class="form-group col-lg-7 col-md-12">
                                    <label>Senha Antiga</label>
                                    <input type="password" name="old_password" placeholder="">
                                </div>
                                <!-- Nova Senha -->
                                <div class="form-group col-lg-7 col-md-12">
                                    <label>Nova Senha</label>
                                    <input type="password" name="new_password" placeholder="">
                                </div>
                                <!-- Confirmar Senha -->
                                <div class="form-group col-lg-7 col-md-12">
                                    <label>Confirmar Senha</label>
                                    <input type="password" name="confirm_password" placeholder="">
                                </div>
                                <!-- Botão Atualizar -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <button class="theme-btn btn-style-one">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.partials.copyright')
@endsection


@push('scripts')
    @include('layouts.partials.scripts')
@endpush
