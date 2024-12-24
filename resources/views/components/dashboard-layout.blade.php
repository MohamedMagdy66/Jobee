<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-black text-white pb-20 font-hanken-grotesk  ">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10">


            <div >
                <a href="/" class="flex items-center text-white text-lg font-bold ">
                    <img src="{{Vite::asset('resources/images/jobee.svg')}}" alt="" class="mr-2"> 
                    Jobee
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <a href="/" class="hover:text-blue-600">Jobs</a>
                <a href="jobs/create" class="hover:text-blue-600">Post a job</a>

            </div>
            @auth
            <div class="space-x-6 font-bold flex">
                <a href="/dashboard" class="hover:text-blue-600">Dashboard</a>
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button class="hover:text-red-600">Logout</button>
                </form>
            </div>
            @endauth

            @guest
            <div class="space-x-6 font-bold">
            <a href="/register" class="hover:text-blue-600">Sign Up</a>
            <a href="/login" class="hover:text-green-600">Log In</a>
        </div>
            @endguest
        </nav>
        <main class="mt-10 max-w-[986px] mx-auto">
            {{$slot}}
        </main>

    </div>
</body>
</html>