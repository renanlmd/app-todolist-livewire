<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Todo List</title>
    <link href="/css/app.css" rel="stylesheet">
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
    <script src="https://kit.fontawesome.com/d86845d251.js" crossorigin="anonymous"></script>

    @stack('scripts')
    @stack('scripts-pomodoro')
</body>
</html>