@extends('layouts.dashboard')

@section('title', 'Editar Vaga - VagaPet')

@section('content')
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Editar vaga</h3>
        <div class="text">Atualize as informações desta oportunidade.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>{{ $job->title }}</h4>
                <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="theme-btn btn-style-three">
                  <i class="las la-external-link-alt"></i> Ver página pública
                </a>
              </div>

              <div class="widget-content">
                @include('dashboard.company.partials.job-form', [
                  'job' => $job,
                  'formAction' => route('company.update-job', $job->id),
                  'formMethod' => 'POST',
                  'submitLabel' => 'Atualizar vaga',
                ])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush

