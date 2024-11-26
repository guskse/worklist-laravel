<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{asset('css/style.css')}} />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <title>{{$title ?? 'Workopia | Find and List jobs'}}</title>
</head>
<body class="bg-gray-100">

    {{-- navbar --}}
    <x-header />

    {{-- only show this component if in the home page --}}
    @if(request()->is('/'))
    <x-hero />
    <x-top-banner />
    @endif

    <main class="container mx-auto p-4 mt-4">
        {{-- content will be put in the $slot --}}
        {{$slot}}
    </main>

    
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>
