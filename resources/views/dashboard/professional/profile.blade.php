@extends('layouts.dashboard-professional')

@section('title', 'Meu Perfil - VagaPet')

@section('content')
  <!-- Painel (Meu Perfil) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Meu Perfil</h3>
        <div class="text">Pronto para voltar ao trabalho?</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Meu Perfil</h4>
              </div>

              <div class="widget-content">
                <div class="uploading-outer">
                  <div class="uploadButton">
                    <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                    <label class="uploadButton-button ripple-effect" for="upload">Subir foto</label>
                    <span class="uploadButton-file-name"></span>
                  </div>
                  <div class="text">Tamanho máximo do arquivo: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                </div>

                <form class="default-form">
                  <div class="row">
                    <!-- Nome Completo -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome*</label>
                      <input type="text" name="name" placeholder="Maria">
                    </div>

                    <!-- Nome Completo -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Sobrenome*</label>
                      <input type="text" name="name" placeholder="da Silva">
                    </div>

                    <!-- Título Profissional (Ex.: Veterinária, Groomer, etc.) -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Título Profissional*</label>
                      <input type="text" name="title" placeholder="Groomer Especialista em Banho e Tosa">
                    </div>

                    <!-- Telefone -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Telefone*</label>
                      <input type="text" name="phone" placeholder="(11) 98765-4321">
                    </div>

                    <!-- Endereço de E-mail -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Endereço de E-mail*</label>
                      <input type="email" name="email" placeholder="maria@exemplo.com">
                    </div>

                    <!-- Site -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site Pessoal</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br">
                    </div>

                    <!-- Experiência -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Experiência profissional</label>
                      <select class="chosen-select">
                        <option>Estágio (estudante)</option>
                        <option>Junior (até 2 anos)</option>
                        <option>Pleno (de 3 a 5 anos)</option>
                        <option>Senior (mais de 5 anos)</option>
                      </select>
                    </div>

                    <!-- Educação -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Educação</label>
                      <select class="chosen-select">
                        <option>Ensino Fundamental</option>
                        <option>Ensino Médio</option>
                        <option>Ensino Superior</option>
                        <option>Pós-graduação (Mestrado ou doutorado)</option>
                      </select>
                    </div>

                    <!-- Área de trabalho -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Área de trabalho*</label>
                      <p>Você pode incluir mais de uma opção</p>
                      <select data-placeholder="Escolha" class="chosen-select multiple" multiple tabindex="4">
                        <option value="BanhoTosa">Banho & Tosa</option>
                        <option value="Recepcao">Recepção</option>
                        <option value="Vendas">Vendas</option>
                        <option value="Veterinario">Veterinário</option>
                        <option value="AuxiliarVeterinario">Auxiliar Veterinário</option>
                        <option value="Limpeza">Limpeza</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Estoque">Estoque</option>
                        <option value="Motorista">Motorista</option>
                      </select>
                    </div>

                    <!-- Área de Atuação -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Área de Atuação</label>
                      <select class="chosen-select">
                        <option>Selecione</option>
                        <option>Adestramento</option>
                        <option>Administrativo</option>
                        <option>Banho e tosa</option>
                        <option>Creche e hotel</option>
                        <option>Enfermeiro, auxiliar ou técnico</option>
                        <option>Limpeza</option>
                        <option>Marketing</option>
                        <option>Motorista</option>
                        <option>Recepção</option>
                        <option>Serviços gerais</option>
                        <option>Vendas</option>
                        <option>Veterinária</option>
                      </select>
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Data de Nascimento</label>
                      <input type="date" name="birth_date">
                    </div>

                    <!-- Gênero -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Gênero</label>
                      <select class="chosen-select">
                        <option>Selecione</option>
                        <option>Feminino</option>
                        <option>Masculino</option>
                        <option>Prefiro não informar</option>
                      </select>
                    </div>

                    <!-- Endereço -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Endereço</label>
                      <input type="text" name="address" placeholder="Rua das Flores, 123">
                    </div>

                    <!-- Cidade -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Cidade</label>
                      <input type="text" name="city" placeholder="São Paulo">
                    </div>

                    <!-- Estado -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Estado</label>
                      <select class="chosen-select">
                        <option>Selecione</option>
                        <option>AC</option>
                        <option>AL</option>
                        <option>AP</option>
                        <option>AM</option>
                        <option>BA</option>
                        <option>CE</option>
                        <option>DF</option>
                        <option>ES</option>
                        <option>GO</option>
                        <option>MA</option>
                        <option>MT</option>
                        <option>MS</option>
                        <option>MG</option>
                        <option>PA</option>
                        <option>PB</option>
                        <option>PR</option>
                        <option>PE</option>
                        <option>PI</option>
                        <option>RJ</option>
                        <option>RN</option>
                        <option>RS</option>
                        <option>RO</option>
                        <option>RR</option>
                        <option>SC</option>
                        <option>SP</option>
                        <option>SE</option>
                        <option>TO</option>
                      </select>
                    </div>

                    <!-- CEP -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>CEP</label>
                      <input type="text" name="cep" placeholder="01234-567">
                    </div>

                    <!-- Salário Atual -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Salário Atual</label>
                      <input type="text" name="salary" placeholder="R$ 2.500,00">
                    </div>

                    <!-- Salário Desejado -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Salário Desejado</label>
                      <input type="text" name="desired_salary" placeholder="R$ 3.000,00">
                    </div>

                    <!-- Tipo de Contrato -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Tipo de Contrato</label>
                      <select class="chosen-select">
                        <option>Selecione</option>
                        <option>CLT</option>
                        <option>PJ</option>
                        <option>Freelancer</option>
                        <option>Temporário</option>
                        <option>Estágio</option>
                      </select>
                    </div>

                    <!-- Disponibilidade -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Disponibilidade</label>
                      <select class="chosen-select">
                        <option>Selecione</option>
                        <option>Imediata</option>
                        <option>15 dias</option>
                        <option>30 dias</option>
                        <option>60 dias</option>
                        <option>90 dias</option>
                      </select>
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <!-- Seção Formação Acadêmica -->
                      <div class="resume-outer">
                        <div class="upper-title">
                          <h4>Formação profissional</h4>
                          <button class="add-info-btn">
                            <span class="icon flaticon-plus"></span> Adicionar Formação
                          </button>
                        </div>

                        <!-- Exemplo de Formação 1 -->
                        <div class="resume-block">
                          <div class="inner">
                            <span class="name">C</span>
                            <div class="title-box">
                              <div class="info-box">
                                <h3>Curso de Auxiliar Veterinário</h3>
                                <span>Instituto PetCare</span>
                              </div>
                              <div class="edit-box">
                                <span class="year">2021 - 2022</span>
                                <div class="edit-btns">
                                  <button><span class="la la-pencil"></span></button>
                                  <button><span class="la la-trash"></span></button>
                                </div>
                              </div>
                            </div>
                            <div class="text">Recebi treinamento prático e teórico em auxílio a veterinários, tratamento de animais domésticos e cuidados específicos pós-operatórios.</div>
                          </div>
                        </div>

                        <!-- Exemplo de Formação 2 -->
                        <div class="resume-block">
                          <div class="inner">
                            <span class="name">U</span>
                            <div class="title-box">
                              <div class="info-box">
                                <h3>Administração de Pet Shop</h3>
                                <span>Universidade Animal</span>
                              </div>
                              <div class="edit-box">
                                <span class="year">2019 - 2021</span>
                                <div class="edit-btns">
                                  <button><span class="la la-pencil"></span></button>
                                  <button><span class="la la-trash"></span></button>
                                </div>
                              </div>
                            </div>
                            <div class="text">Especialização em gestão de estoque, relacionamento com clientes e cuidados gerais de um pet shop.</div>
                          </div>
                        </div>
                      </div>

                      <!-- Seção Experiência -->
                      <div class="resume-outer theme-blue">
                        <div class="upper-title">
                          <h4>Experiência de Trabalho</h4>
                          <button class="add-info-btn">
                            <span class="icon flaticon-plus"></span> Adicionar Experiência
                          </button>
                        </div>

                        <!-- Exemplo de Experiência 1 -->
                        <div class="resume-block">
                          <div class="inner">
                            <span class="name">P</span>
                            <div class="title-box">
                              <div class="info-box">
                                <h3>Groomer Sênior</h3>
                                <span>Pet4U</span>
                              </div>
                              <div class="edit-box">
                                <span class="year">2022 - Atual</span>
                                <div class="edit-btns">
                                  <button><span class="la la-pencil"></span></button>
                                  <button><span class="la la-trash"></span></button>
                                </div>
                              </div>
                            </div>
                            <div class="text">Responsável por cuidar da aparência dos pets, incluindo tosa higiênica e estilos avançados, além de garantir o bem-estar dos animais durante o processo.</div>
                          </div>
                        </div>

                        <!-- Exemplo de Experiência 2 -->
                        <div class="resume-block">
                          <div class="inner">
                            <span class="name">A</span>
                            <div class="title-box">
                              <div class="info-box">
                                <h3>Auxiliar Veterinário</h3>
                                <span>Clínica Happy Pets</span>
                              </div>
                              <div class="edit-box">
                                <span class="year">2020 - 2021</span>
                                <div class="edit-btns">
                                  <button><span class="la la-pencil"></span></button>
                                  <button><span class="la la-trash"></span></button>
                                </div>
                              </div>
                            </div>
                            <div class="text">Auxiliava o veterinário em procedimentos, monitorava animais em recuperação e orientava clientes sobre cuidados pós-consulta.</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Portfólio -->
                    <div class="form-group col-lg-6 col-md-12">
                      <div class="uploading-outer">
                        <div class="uploadButton">
                          <input class="uploadButton-input" type="file"
                            name="attachments[]" accept="image/*, application/pdf"
                            id="upload" multiple />
                          <label class="uploadButton-button ripple-effect" for="upload">
                            Adicionar Portfólio
                          </label>
                          <span class="uploadButton-file-name"></span>
                        </div>
                        <div class="text">Você pode incluir fotos do seu trabalho, do seu dia a dia e demonstrar sua relação com os animais.</div>
                      </div>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea placeholder="Fale sobre sua experiência, prêmios, serviços oferecidos (banho, tosa, recepção, etc.) e qualquer outro detalhe relevante."></textarea>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-6 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Ls widget (Seção Redes Sociais) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Redes Sociais</h4>
                <p>Inclua suas redes sociais se quiser que outros vejam seu perfil e possam te seguir.</p>
              </div>

              <div class="widget-content">
                <form class="default-form">
                  <div class="row">
                    <!-- Facebook -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="www.facebook.com/MeuPerfil">
                    </div>

                    <!-- Twitter -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>X (antigo Twitter)</label>
                      <input type="text" name="twitter" placeholder="twitter.com/MeuPerfil">
                    </div>

                    <!-- Linkedin -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>TikTok</label>
                      <input type="text" name="linkedin" placeholder="www.tiktok.com/meuperfil">
                    </div>

                    <!-- Instagram -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="instagram.com/meuperfil">
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-6 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Ls widget (Seção Informações de Contato) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Localização</h4>
                <p>Só o bairro e cidade ficarão visíveis na plataforma para ajudar na busca por vagas releventes.</p>
              </div>

              <div class="widget-content">
                <form class="default-form">
                  <div class="row">
                    <!-- Endereço Completo -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Endereço Completo</label>
                      <input type="text" name="address" placeholder="Rua Exemplo, 123, Bairro, Cidade - Estado">
                    </div>

                    <!-- Encontrar no Mapa - Bairro -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Bairro e cidade (aparece no mapa)*</label>
                      <input type="text" name="map" placeholder="Vila Clementina, São Paulo - SP">
                    </div>

                    <!-- Botão de Buscar Localização -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-three">Buscar Localização</button>
                    </div>

                    <!-- Mapa -->
                    <div class="form-group col-lg-12 col-md-12">
                      <div class="map-outer">
                        <div class="map-canvas map-height" data-zoom="12"
                          data-lat="-23.550520" data-lng="-46.633308"
                          data-type="roadmap" data-hue="#ffc400"
                          data-title="Localização"
                          data-icon-path="images/resource/map-marker.png"
                          data-content="São Paulo - SP, Brasil<br><a href='mailto:info@meuservicos.com'>info@meuservicos.com</a>">
                        </div>
                      </div>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim do Painel (Meu Perfil) -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
