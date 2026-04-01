<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ledgerly - Simple Invoice Generator')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Favicon using the same external image -->
    <link rel="icon" type="image/png" href="https://iili.io/BKzT8OB.png">
    <!-- Open Graph Meta -->
    <meta property="og:title" content="@yield('og_title', 'Ledgerly')">
    <meta property="og:type" content="website">
    <meta property="og:description" content="@yield('og_description', 'Solving the chaos, inefficiency, and lost revenue around invoicing for freelancers, small businesses, and service providers')">
    <meta property="og:image" content="https://iili.io/BKzT8OB.png">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card (Optional but recommended) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Ledgerly')">
    <meta name="twitter:description" content="@yield('og_description', 'Solving the chaos, inefficiency, and lost revenue around invoicing for freelancers, small businesses, and service providers')">
    <meta name="twitter:image" content="https://iili.io/BKzT8OB.png">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3K0N15VKRE"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-3K0N15VKRE');
    </script>

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
