@extends('layouts.app')

@section('title', 'Finalizar Compra - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim Cabeçalho -->

  <!-- Título da Página -->
  <section class="page-title">
    <div class="auto-container">
      <div class="title-outer">
        <h1>Finalizar compra</h1>
        <ul class="page-breadcrumb">
          <li><a href="{{ route('home') }}">Início</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Fim Título da Página -->

  <!-- Página de Checkout -->
  <section class="checkout-page">
    <div class="auto-container">
      <div class="row">

        <!-- Formulário de Dados -->
        <div class="column col-lg-8 col-md-12 col-sm-12">
          <div class="checkout-form">
            <h3 class="title">Dados de Cobrança</h3>
            <form method="post" action="{{ route('checkout.process') }}" class="default-form">
              @csrf
              <div class="row">

                <!-- Nome Completo -->
                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                  <div class="field-label">Nome Completo <sup>*</sup></div>
                  <input type="text" name="nome" placeholder="Ex: Maria Silva" required>
                </div>

                <!-- Telefone -->
                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                  <div class="field-label">Telefone <sup>*</sup></div>
                  <input type="text" name="telefone" placeholder="(11) 98765-4321" required>
                </div>

                <!-- E-mail -->
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="field-label">E-mail <sup>*</sup></div>
                  <input type="email" name="email" placeholder="seu@exemplo.com" required>
                </div>

                <!-- Endereço -->
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="field-label">Endereço <sup>*</sup></div>
                  <input type="text" name="endereco1" placeholder="Rua Exemplo, 123" required>
                  <input type="text" name="endereco2" placeholder="Apto, sala, etc. (opcional)">
                </div>

                <!-- Bairro / Cidade -->
                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                  <div class="field-label">Bairro / Cidade <sup>*</sup></div>
                  <input type="text" name="bairro" placeholder="Morumbi, São Paulo" required>
                </div>

                <!-- Estado -->
                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                  <div class="field-label">Estado <sup>*</sup></div>
                  <input type="text" name="estado" placeholder="SP" required>
                </div>

                <!-- CEP -->
                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                  <div class="field-label">CEP <sup>*</sup></div>
                  <input type="text" name="cep" placeholder="01234-567" required>
                </div>

              </div>

            </form>
          </div>
        </div>

        <!-- Resumo do Pedido -->
        <div class="column col-lg-4 col-md-12 col-sm-12">
           <!--Order Box-->
          <div class="order-box">
            <h3>Seu pedido</h3>
            <table>
              <thead>
                <tr>
                  <th><strong>Serviços</strong></th>
                  <th><strong>Subtotal</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr class="cart-item">
                  <td class="product-name">Publicação de vaga x2</td>
                  <td class="product-total">R$19,80</td>
                </tr>

                <tr class="cart-item">
                  <td class="product-name">Divulgação em redes sociais x 1</td>
                  <td class="product-total">R$39,80</td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="cart-subtotal">
                  <td>Subtotal</td>
                  <td><span class="amount">R$59,60</span></td>
                </tr>
                <tr class="order-total">
                  <td>Total</td>
                  <td><span class="amount">R$59,60</span></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <!--End Order Box-->

          <!-- Opções de Pagamento -->
          <div class="payment-box">
            <div class="payment-options">
              <ul>
                <li>
                  <div class="radio-option radio-box">
                    <input type="radio" name="pagamento" id="bank" checked>
                    <label for="bank">Boleto Bancário <span class="small-text">Receba o boleto por e-mail e pague em até 3 dias.</span></label>
                  </div>
                </li>
                <li>
                  <div class="radio-option radio-box">
                    <input type="radio" name="pagamento" id="credit">
                    <label for="credit">Cartão de Crédito <span class="small-text">Parcelamento em até 3x sem juros.</span></label>
                  </div>
                </li>
                <li>
                  <div class="radio-option radio-box">
                    <input type="radio" name="pagamento" id="pix">
                    <label for="pix">PIX <span class="small-text">Receba QR Code para pagamento instantâneo.</span></label>
                  </div>
                </li>
              </ul>
              <div class="btn-box">
                <a href="#" class="theme-btn btn-style-one">Confirmar</a>
              </div>
            </div>
          </div>
          <!-- Fim Opções de Pagamento -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Checkout Page -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- Fim Main Footer -->

</div>
<!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
