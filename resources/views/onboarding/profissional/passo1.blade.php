@extends('layouts.app')

@section('title', 'Onboarding Profissional - Passo 1')

@section('content')
    <div class="page-wrapper">
        <div class="preloader"></div>
        <span class="header-span"></span>
        @include('layouts.partials.header-onboarding')
        <section class="user-dashboard row justify-content-center">
            <div class="dashboard-outer col-lg-10 mt-30 mb-50">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Escolha o seu perfil</h4>
                                </div>
                                <div class="widget-content">
                                    <form method="get" action="{{ route('onboarding.profissional.passo2') }}">
                                        <div class="form-group">
                                            <div class="radio-outer row justify-content-center">
                                                <div class="col-lg-3 profile-choice-box card bg-light m-1">
                                                    <div class="radio-box card-body pt-5 pb-5">
                                                        <input class="theme-btn btn-style-seven" type="radio" name="perfil" id="radio-1" value="profissional" checked>
                                                        <label class="mb-0" for="radio-1"><span><i class="la la-user"></i> Profissional</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 profile-choice-box card bg-light m-1">
                                                    <div class="radio-box card-body pt-5 pb-5">
                                                        <input class="theme-btn btn-style-seven" type="radio" name="perfil" id="radio-2" value="empresa">
                                                        <label class="mb-0" for="radio-2"><span><i class="la la-user"></i> Empresa</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12 mt-30">
                                                <button class="theme-btn btn-style-one pull-right" type="submit">Próximo</button>
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
        @include('layouts.partials.copyright')
    </div>
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
