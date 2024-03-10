<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Get started with a free and open-source admin dashboard layout built with Tailwind CSS and Flowbite featuring charts, widgets, CRUD layouts, authentication pages, and more" />
    <meta name="author" content="Themesberg" />
    <meta name="generator" content="Hugo 0.118.2" />

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://flowbite-admin-dashboard.vercel.app/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="https://flowbite-admin-dashboard.vercel.app/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="https://flowbite-admin-dashboard.vercel.app/favicon-16x16.png" />
    <link rel="icon" type="image/png" href="https://flowbite-admin-dashboard.vercel.app/favicon.ico" />
    <link rel="manifest" href="https://flowbite-admin-dashboard.vercel.app/site.webmanifest" />
    <link rel="mask-icon" href="https://flowbite-admin-dashboard.vercel.app/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="theme-color" content="#ffffff" />


    <script>
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <x-header />

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar />

        <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                @yield("content")
            </main>
            <x-footer />
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
    @yield('script')
</body>

</html>
