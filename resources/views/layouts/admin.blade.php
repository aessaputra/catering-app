<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    {{-- Kita akan include file navbar di sini nanti --}}
    {{-- @include('layouts.partials.admin.navbar') --}}

    {{-- Kita akan include file sidebar di sini nanti --}}
    {{-- @include('layouts.partials.admin.sidebar') --}}

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        {{-- Breadcrumb bisa ditambahkan di sini jika perlu --}}
                    </div>
                </div>
            </div></section>

        <section class="content">

            @yield('content')
            </section>
        </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">Catering App</a>.</strong> All rights reserved.
    </footer>

</div>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@include('sweetalert::alert')

@stack('scripts')
</body>
</html>