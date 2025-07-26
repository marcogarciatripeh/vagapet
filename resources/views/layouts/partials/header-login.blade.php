<!-- Main Header para Login -->
<header class="main-header">
    <div class="header-upper">
        <div class="auto-container">
            <div class="logo-box" style="text-align:center; width:100%;">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="VagaPet"></a></div>
            </div>
        </div>
    </div>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="VagaPet"></a></div>
    </div>
    <!-- Mobile Nav -->
    <div id="nav-mobile" style="display:none;">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
        </ul>
    </div>
</header>
