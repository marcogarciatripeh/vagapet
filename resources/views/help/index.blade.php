@extends('layouts.app')

@section('title', 'Ajuda - VagaPet')

@section('content')
    <!-- Seção da Dashboard -->
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Cabeçalho Principal -->
        @include('layouts.partials.dashboard.header')

        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- User Sidebar -->
        @if(auth()->user()?->isProfessional())
            @include('layouts.partials.dashboard.sidebar-professional')
        @else
            @include('layouts.partials.dashboard.sidebar-company')
        @endif

        <!-- Dashboard Content -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Ajuda</h3>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Como podemos te ajudar?</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form" method="POST" action="">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Assunto*</label>
                                                <input type="text" name="subject" placeholder="Ex.: Dificuldade técnica" required>
                                            </div>

                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Descrição*</label>
                                                <textarea name="description" placeholder="Descreva brevemente como o que podemos ajudar." required></textarea>
                                            </div>

                                            <div class="form-group col-lg-12 col-md-12">
                                                <button type="submit" class="theme-btn btn-style-one">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Copyright -->
    @include('layouts.partials.copyright')
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
