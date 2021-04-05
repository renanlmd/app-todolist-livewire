<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    @livewireStyles

</head>
<body>
    
    <div class="min-h-screen flex-auto flex-col justify-between">
        
        <header class="p-4 bg-teal-500 text-center text-white font-bold">Header</header>
        <main class="bg-teal-600 flex items-center justify-center p-5">
            @yield('content')
        </main>
        <footer class="p-4 bg-teal-500 text-center text-white font-bold"></footer>
        
    </div>
    
    @livewireScripts
    @stack('scripts')
</body>
</html>