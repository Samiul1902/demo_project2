<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Smart Salon & Beauty Parlour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Only your custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('partials.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')
</body>
</html>
