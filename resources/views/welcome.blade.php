<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobFlow - Your Job Tracking Solution</title>
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-blue-600">JobFlow</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600">Features</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Pricing</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                        <a href="{{ route('login') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Get
                            Started</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Track Your Job Search</span>
                    <span class="block text-blue-600">With Ease</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Organize your job applications, track interviews, and manage your career growth all in one place.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('login') }}"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                            Get Started
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div
                            class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Application Tracking</h3>
                        <p class="mt-2 text-base text-gray-500">Keep track of all your job applications in one organized
                            place.</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Interview Scheduling</h3>
                        <p class="mt-2 text-base text-gray-500">Schedule and manage your interviews with ease.</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Progress Analytics</h3>
                        <p class="mt-2 text-base text-gray-500">Track your job search progress with detailed analytics.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2024 JobFlow. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>