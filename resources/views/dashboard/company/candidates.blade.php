@extends('layouts.dashboard')

@section('title', 'Candidatos - VagaPet')

@section('content')
  <!-- Painel (Candidatos) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Candidatos</h3>
        <div class="text">Gerencie as candidaturas recebidas</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Candidatos</h4>

                <div class="chosen-outer">
                  <!-- Selecione a Vaga -->
                  <select class="chosen-select">
                    <option>Selecione a Vaga</option>
                    <option>Groomer Sênior Pet</option>
                    <option>Recepcionista Pet Shop</option>
                    <option>Auxiliar Veterinário</option>
                    <option>Dog Walker / Pet Sitter</option>
                    <option>Especialista em Banho/Tosa Estilizada</option>
                  </select>

                  <!-- Filtro de Status -->
                  <select class="chosen-select">
                    <option>Todos os Status</option>
                    <option>Aprovado</option>
                    <option>Rejeitado</option>
                  </select>
                </div>
              </div>

              <div class="widget-content">
                <div class="tabs-box">
                  <div class="aplicants-upper-bar">
                    <h6>Vaga: Groomer Sênior Pet</h6>
                    <ul class="aplicantion-status tab-buttons clearfix">
                      <li class="tab-btn active-btn totals" data-tab="#totals">
                        Total(s): 6
                      </li>
                      <li class="tab-btn approved" data-tab="#approved">
                        Aprovado(s): 2
                      </li>
                      <li class="tab-btn rejected" data-tab="#rejected">
                        Rejeitado(s): 4
                      </li>
                    </ul>
                  </div>

                  <div class="tabs-content">
                    <!-- Aba Totals -->
                    <div class="tab active-tab" id="totals">
                      <div class="row">
                        <!-- Exemplo de Candidato 1 -->
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                <img src="{{ asset('images/resource/candidate-1.png') }}" alt="Candidato 1">
                              </figure>
                              <h4 class="name"><a href="#">Maria da Silva</a></h4>
                              <ul class="candidate-info">
                                <li class="designation">Banho e Tosa</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  São Paulo, SP
                                </li>
                              </ul>
                              <ul class="post-tags">
                                <li><a href="#">Banho</a></li>
                                <li><a href="#">Tosa</a></li>
                              </ul>
                            </div>
                            <div class="option-box">
                              <ul class="option-list">
                                <li>
                                  <button data-text="Ver Candidatura">
                                    <span class="la la-eye"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Aprovar Candidatura">
                                    <span class="la la-check"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Rejeitar Candidatura">
                                    <span class="la la-times-circle"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Excluir Candidatura">
                                    <span class="la la-trash"></span>
                                  </button>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>

                        <!-- Exemplo de Candidato 2 -->
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                <img src="{{ asset('images/resource/candidate-2.png') }}" alt="Candidato 2">
                              </figure>
                              <h4 class="name"><a href="#">João Santos</a></h4>
                              <ul class="candidate-info">
                                <li class="designation">Auxiliar Veterinário</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  São Paulo, SP
                                </li>
                              </ul>
                              <ul class="post-tags">
                                <li><a href="#">Veterinária</a></li>
                                <li><a href="#">Auxiliar</a></li>
                              </ul>
                            </div>
                            <div class="option-box">
                              <ul class="option-list">
                                <li>
                                  <button data-text="Ver Candidatura">
                                    <span class="la la-eye"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Aprovar Candidatura">
                                    <span class="la la-check"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Rejeitar Candidatura">
                                    <span class="la la-times-circle"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Excluir Candidatura">
                                    <span class="la la-trash"></span>
                                  </button>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>

                        <!-- Exemplo de Candidato 3 -->
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                <img src="{{ asset('images/resource/candidate-3.png') }}" alt="Candidato 3">
                              </figure>
                              <h4 class="name"><a href="#">Ana Costa</a></h4>
                              <ul class="candidate-info">
                                <li class="designation">Recepcionista</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  São Paulo, SP
                                </li>
                              </ul>
                              <ul class="post-tags">
                                <li><a href="#">Recepção</a></li>
                                <li><a href="#">Atendimento</a></li>
                              </ul>
                            </div>
                            <div class="option-box">
                              <ul class="option-list">
                                <li>
                                  <button data-text="Ver Candidatura">
                                    <span class="la la-eye"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Aprovar Candidatura">
                                    <span class="la la-check"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Rejeitar Candidatura">
                                    <span class="la la-times-circle"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Excluir Candidatura">
                                    <span class="la la-trash"></span>
                                  </button>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>

                        <!-- Exemplo de Candidato 4 -->
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Candidato 4">
                              </figure>
                              <h4 class="name"><a href="#">Pedro Oliveira</a></h4>
                              <ul class="candidate-info">
                                <li class="designation">Dog Walker</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  São Paulo, SP
                                </li>
                              </ul>
                              <ul class="post-tags">
                                <li><a href="#">Dog Walker</a></li>
                                <li><a href="#">Pet Sitter</a></li>
                              </ul>
                            </div>
                            <div class="option-box">
                              <ul class="option-list">
                                <li>
                                  <button data-text="Ver Candidatura">
                                    <span class="la la-eye"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Aprovar Candidatura">
                                    <span class="la la-check"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Rejeitar Candidatura">
                                    <span class="la la-times-circle"></span>
                                  </button>
                                </li>
                                <li>
                                  <button data-text="Excluir Candidatura">
                                    <span class="la la-trash"></span>
                                  </button>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Aba Aprovados -->
                    <div class="tab" id="approved">
                      <div class="row">
                        <!-- Candidatos aprovados aqui -->
                      </div>
                    </div>

                    <!-- Aba Rejeitados -->
                    <div class="tab" id="rejected">
                      <div class="row">
                        <!-- Candidatos rejeitados aqui -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim Widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Candidatos) -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
$(document).ready(function() {
    // Tabs functionality
    $('.tab-btn').on('click', function() {
        var target = $(this).data('tab');
        $('.tab-btn').removeClass('active-btn');
        $(this).addClass('active-btn');
        $('.tab').removeClass('active-tab');
        $(target).addClass('active-tab');
    });
});
</script>
@endpush

