<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ config('app.name', 'Admin IT Grade') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
    ></script>
    <script src="/assets/js/init-alpine.js"></script>
    <!-- You need focus-trap.js to make the modal accessible -->
    <script src="/assets/js/focus-trap.js" defer></script>
    @stack('scripts')
</head>
<body>
<div id="app">

            {{ $slot }}
    <footer class="w-full bg-white p-8">

        <hr class="my-8 border-blue-gray-50" />
        <p class="block text-center font-sans text-base font-normal leading-relaxed text-blue-gray-900 antialiased">
            <a href="#">Links</a>
        </p>
        <p class="block text-center font-sans text-base font-normal leading-relaxed text-blue-gray-900 antialiased">
           2023 © Mikhalkevich
        </p>
    </footer>
</div>
</body>
</html>
