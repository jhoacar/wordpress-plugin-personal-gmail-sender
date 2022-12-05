<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ personal_gmail_sender_assets('/fonts/bootstrap-icons/bootstrap-icons-1.10.2.css') }}" />
<link rel="stylesheet" href="{{ personal_gmail_sender_assets('/css/core.css') }}" />
<!-- END: Theme CSS-->
@yield('styles')
<div style="height: 85vh;min-width:100%;" class="horizontal-layout horizontal-menu default floating static">
    <!-- BEGIN: Content-->
    <div class="content m-0">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper boxed">
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- End: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-start d-block d-md-inline-block mt-25">
                Created by - <a class="ms-25" href="https://github.com/jhoacar">Jhoan Carrero</a>
            </span>
            <span class="float-md-end d-block d-md-inline-block mt-25">
                Personal Gmail Sender Plugin Version - {{ PERSONAL_GMAIL_SENDER_PLUGIN_VERSION }}
            </span>
        </p>
    </footer>
    <!-- END: Footer-->
</div>
@yield('scripts')