<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hinunangan Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .crisp-shadow {
            box-shadow: 0 1px 3px rgba(15, 23, 42, .08),
                        0 1px 2px rgba(15, 23, 42, .06);
        }

        .portal-border {
            border: 1px solid #dbe4ef;
        }

        .survey-border {
            border: 1.5px solid #0f172a;
        }

        .star-btn {
            font-size: 30px;
            color: #f59e0b;
            text-shadow: 0 1px 0 #d97706;
            cursor: pointer;
        }

        .star-btn.off {
            color: #cbd5e1;
            text-shadow: none;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* HERO BACKGROUND FIX */
        .hero-bg {
            background:
                linear-gradient(rgba(2, 132, 199, .55),
                rgba(15, 23, 42, .85)),
                url('/images/hinunangan_paradise_1779325004774.png');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>