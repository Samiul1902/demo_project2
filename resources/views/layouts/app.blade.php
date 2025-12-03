<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Smart Salon & Beauty Parlour</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.15s; }
        .delay-2 { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glow-btn {
            position: relative;
            overflow: hidden;
            transition: transform 0.15s ease-out, box-shadow 0.15s ease-out;
        }
        .glow-btn::before {
            content: '';
            position: absolute;
            inset: -50%;
            background: radial-gradient(circle, rgba(255,255,255,0.35) 0, transparent 55%);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .glow-btn:hover::before {
            opacity: 1;
        }
        .glow-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .hero-gradient {
            background:
                radial-gradient(circle at top left, #ff9a9e 0, transparent 55%),
                radial-gradient(circle at bottom right, #fad0c4 0, transparent 55%),
                linear-gradient(135deg, #fbc2eb 0%, #a18cd1 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
<div class="min-h-screen flex flex-col">
    @include('partials.navbar')

    <main class="flex-1">
        {{ $slot ?? '' }}
    </main>

    @include('partials.footer')
</div>
</body>
</html>
