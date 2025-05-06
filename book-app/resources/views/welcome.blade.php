<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Booknook</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>
<body class="bg-[#0a0a0a] text-[#EDEDEC] flex items-center justify-center min-h-screen p-6 dark:bg-indigo-500">

    <div class="w-full max-w-xl text-center space-y-8">
        <!-- Welcome Card -->
        <section class="bg-[#111111] rounded-xl shadow-lg p-10 space-y-6">
            <h1 class="text-4xl font-bold">Welcome to Booknook</h1>
            <p class="text-gray-400 text-base">
                Explore a wide range of books across different genres and discover what other readers are saying about them!
            </p>

            <div class="space-y-3">
                <p class="text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">Sign in here</a>.
                </p>

                <p class="text-sm text-gray-500">
                    New here?
                    <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Create an account</a> and start exploring!
                </p>
            </div>
        </section>
    </div>

</body>
</html>

