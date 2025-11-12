@php
  /** @var \App\Models\User|null $user */
  $user = Auth::user();

  $professionalBuilder = $user?->professionalProfile()->withTrashed();
  $companyBuilder = $user?->companyProfile()->withTrashed();

  $canAccessProfessional = $professionalBuilder ? $professionalBuilder->exists() : false;
  $canAccessCompany = $companyBuilder ? $companyBuilder->exists() : false;

  $buttonClass = $buttonClass ?? 'btn btn-md btn-primary menu-btn text-white';
  $dropdownMenuClass = $dropdownMenuClass ?? 'dropdown-menu dropdown-menu-right';
  $containerClass = $containerClass ?? '';
  $currentLabel = $currentLabel ?? 'Painel';
@endphp

@if($canAccessProfessional && $canAccessCompany)
  <div class="dropdown dashboard-switcher {{ $containerClass }}">
    <button class="{{ trim($buttonClass . ' dropdown-toggle') }}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="la la-dashboard"></i>
      <span>{{ $currentLabel }}</span>
    </button>
    <div class="{{ $dropdownMenuClass }}">
      <a class="dropdown-item" href="{{ route('professional.dashboard') }}">
        <i class="la la-user mr-1"></i> Painel Profissional
      </a>
      <a class="dropdown-item" href="{{ route('company.dashboard') }}">
        <i class="la la-building mr-1"></i> Painel Empresa
      </a>
    </div>
  </div>
@elseif($canAccessProfessional)
  <a href="{{ route('professional.dashboard') }}" class="{{ $buttonClass }}">
    <i class="la la-dashboard"></i>
    <span>Painel Profissional</span>
  </a>
@elseif($canAccessCompany)
  <a href="{{ route('company.dashboard') }}" class="{{ $buttonClass }}">
    <i class="la la-dashboard"></i>
    <span>Painel Empresa</span>
  </a>
@else
  <a href="{{ route('onboarding.step1') }}" class="{{ $buttonClass }}">
    <i class="la la-cog"></i>
    <span>Completar Perfil</span>
  </a>
@endif
