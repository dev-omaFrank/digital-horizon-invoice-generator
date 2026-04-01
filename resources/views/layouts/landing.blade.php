<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ledgerly Invoices - Simple Invoice Generator')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        a{
            text-decoration: none;
        }
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    
    @yield('content')
    
    {{-- @include('components.footer') --}}
</body>
</html>
