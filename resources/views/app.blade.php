<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <meta charset="utf-8"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.64.min.js') }}"></script>
</head>

<body>
    <div id="web">
    </div>
</body>

</html>
