@php
  $job ??= null;
  $formAction = $formAction ?? '#';
  $formMethod = strtoupper($formMethod ?? 'POST');
  $submitLabel = $submitLabel ?? 'Salvar vaga';
  $contractTypes = [
    'clt' => 'CLT',
    'pj' => 'PJ',
    'freelance' => 'Freelancer',
    'internship' => 'Estágio',
    'temporary' => 'Temporário',
  ];
  $experienceLevels = [
    'junior' => 'Júnior',
    'pleno' => 'Pleno',
    'senior' => 'Sênior',
    'lead' => 'Líder',
    'any' => 'Indiferente',
  ];
  $salaryTypes = [
    'negotiable' => 'Negociável',
    'fixed' => 'Valor fixo',
    'range' => 'Faixa salarial',
  ];
  $areasDefault = [
    'Banho e tosa',
    'Creche e hotel',
    'Veterinária',
    'Recepção',
    'Vendas',
    'Serviços gerais',
    'Administrativo',
    'Marketing',
    'Logística',
  ];
@endphp

<form class="default-form" method="POST" action="{{ $formAction }}">
  @csrf
  @if(!in_array($formMethod, ['GET', 'POST']))
    @method($formMethod)
  @endif

  <div class="row">
    <div class="form-group col-lg-12 col-md-12">
      <label>Título da Vaga *</label>
      <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}" placeholder="Ex.: Groomer especialista em cães" required>
    </div>

    <div class="form-group col-lg-12 col-md-12">
      <label>Descrição da Vaga *</label>
      <textarea name="description" rows="6" placeholder="Detalhe a oportunidade, responsabilidades e perfil desejado." required>{{ old('description', $job->description ?? '') }}</textarea>
    </div>

    <div class="form-group col-lg-12 col-md-12">
      <label>Requisitos</label>
      <textarea name="requirements" rows="4" placeholder="Formação, experiências e habilidades obrigatórias.">{{ old('requirements', $job->requirements ?? '') }}</textarea>
    </div>

    <div class="form-group col-lg-12 col-md-12">
      <label>Benefícios</label>
      <textarea name="benefits" rows="3" placeholder="Liste benefícios como VT, VR, plano de saúde, etc.">{{ old('benefits', $job->benefits ?? '') }}</textarea>
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Tipo de contrato *</label>
      <select name="contract_type" class="chosen-select" required>
        <option value="">Selecione</option>
        @foreach($contractTypes as $value => $label)
          <option value="{{ $value }}" {{ old('contract_type', $job->contract_type ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Nível de experiência *</label>
      <select name="experience_level" class="chosen-select" required>
        <option value="">Selecione</option>
        @foreach($experienceLevels as $value => $label)
          <option value="{{ $value }}" {{ old('experience_level', $job->experience_level ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Área de atuação</label>
      <select name="area" class="chosen-select">
        <option value="">Selecione ou informe</option>
        @foreach($areasDefault as $area)
          <option value="{{ $area }}" {{ old('area', $job->area ?? '') === $area ? 'selected' : '' }}>{{ $area }}</option>
        @endforeach
      </select>
      <small class="text-muted d-block mt-1">Caso a área não esteja na lista, escolha a mais próxima e detalhe na descrição.</small>
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Carga horária semanal</label>
      <input type="number" min="0" name="work_hours" value="{{ old('work_hours', $job->work_hours ?? '') }}" placeholder="Ex.: 44" >
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Tipo de salário *</label>
      <select name="salary_type" class="chosen-select" required>
        @foreach($salaryTypes as $value => $label)
          <option value="{{ $value }}" {{ old('salary_type', $job->salary_type ?? 'negotiable') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-lg-3 col-md-6">
      <label>Salário mínimo</label>
      <input type="number" min="0" step="0.01" name="salary_min" value="{{ old('salary_min', $job->salary_min ?? '') }}" placeholder="R$">
    </div>

    <div class="form-group col-lg-3 col-md-6">
      <label>Salário máximo</label>
      <input type="number" min="0" step="0.01" name="salary_max" value="{{ old('salary_max', $job->salary_max ?? '') }}" placeholder="R$">
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Local de trabalho</label>
      <input type="text" name="work_location" value="{{ old('work_location', $job->work_location ?? '') }}" placeholder="Unidade / Bairro">
    </div>

    <div class="form-group col-lg-4 col-md-12">
      <label>Cidade</label>
      <input type="text" name="city" value="{{ old('city', $job->city ?? '') }}" placeholder="Cidade">
    </div>

    <div class="form-group col-lg-2 col-md-12">
      <label>Estado (UF)</label>
      <input type="text" name="state" value="{{ old('state', $job->state ?? '') }}" placeholder="UF" maxlength="2" style="text-transform: uppercase;">
    </div>

    <div class="form-group col-lg-6 col-md-12">
      <label>Receber candidaturas até</label>
      <input type="date" name="deadline" value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}">
    </div>

    <div class="form-group col-lg-6 col-md-12 mt-3 d-flex gap-3 flex-wrap">
      <label class="form-check form-switch">
        <input type="checkbox" class="form-check-input" name="is_remote" value="1" {{ old('is_remote', $job->is_remote ?? false) ? 'checked' : '' }}>
        <span class="form-check-label">Vaga remota</span>
      </label>
      <label class="form-check form-switch">
        <input type="checkbox" class="form-check-input" name="is_hybrid" value="1" {{ old('is_hybrid', $job->is_hybrid ?? false) ? 'checked' : '' }}>
        <span class="form-check-label">Vaga híbrida</span>
      </label>
      <label class="form-check form-switch">
        <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured', $job->is_featured ?? false) ? 'checked' : '' }}>
        <span class="form-check-label">Destacar vaga</span>
      </label>
      <label class="form-check form-switch">
        <input type="checkbox" class="form-check-input" name="is_urgent" value="1" {{ old('is_urgent', $job->is_urgent ?? false) ? 'checked' : '' }}>
        <span class="form-check-label">Marcar como urgente</span>
      </label>
    </div>

    @if($job)
      <div class="form-group col-lg-6 col-md-12">
        <label>Status da vaga *</label>
        <select name="status" class="chosen-select" required>
          <option value="draft" {{ old('status', $job->status) === 'draft' ? 'selected' : '' }}>Rascunho</option>
          <option value="active" {{ old('status', $job->status) === 'active' ? 'selected' : '' }}>Publicado</option>
          <option value="paused" {{ old('status', $job->status) === 'paused' ? 'selected' : '' }}>Pausado</option>
          <option value="closed" {{ old('status', $job->status) === 'closed' ? 'selected' : '' }}>Encerrado</option>
        </select>
      </div>
    @endif

    <div class="form-group col-lg-12 col-md-12 text-end">
      <button type="submit" class="theme-btn btn-style-one">{{ $submitLabel }}</button>
    </div>
  </div>
</form>

