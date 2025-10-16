@extends('layouts.app')

@section('title', 'FAQ - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-dynamic')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Faqs Section -->
  <section class="faqs-section">
    <div class="auto-container">
      <div class="sec-title text-center">
        <h2>Perguntas Frequentes</h2>
        <div class="text">Home / FAQ</div>
      </div>

      @if($faqs->count() > 0)
        @foreach($faqs as $category => $categoryFaqs)
          <!-- Seção: {{ $categoryFaqs->first()->category_label }} -->
          <h3>{{ $categoryFaqs->first()->category_label }}</h3>
          <ul class="accordion-box">
            @foreach($categoryFaqs as $index => $faq)
              <li class="accordion block {{ $loop->first ? 'active-block' : '' }}">
                <div class="acc-btn {{ $loop->first ? 'active' : '' }}">{{ $faq->question }} <span class="icon flaticon-add"></span></div>
                <div class="acc-content {{ $loop->first ? 'current' : '' }}">
                  <div class="content">
                    <p>{{ $faq->answer }}</p>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        @endforeach
      @else
        <div class="text-center">
          <p>Nenhuma pergunta frequente encontrada no momento.</p>
        </div>
      @endif

    </div>
  </section>
  <!-- End Faqs Section -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
