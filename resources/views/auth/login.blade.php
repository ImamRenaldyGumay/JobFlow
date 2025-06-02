<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JobFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white min-h-screen flex items-center justify-center">
    <div class="w-full min-h-screen flex flex-col md:flex-row">
        <!-- Left: Form -->
        <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 py-8 sm:py-12">
            <div class="w-full max-w-md">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <h2 class="text-3xl font-bold mb-8 text-gray-900">Welcome Back</h2>
                <form class="space-y-5" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input id="email" name="email" type="email" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                            placeholder="Enter your email">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                            placeholder="Password">
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <div class="flex items-center opacity-50 cursor-not-allowed select-none">
                            <input id="remember_me" name="remember" type="checkbox" disabled
                                class="h-4 w-4 text-green-700 focus:ring-green-700 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-400">Remember me</label>
                        </div>
                        <span class="text-sm text-gray-400 cursor-not-allowed select-none">Forgot password?</span>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-800 text-white py-2 rounded-md font-semibold hover:bg-green-900 transition">Sign
                        In</button>
                </form>
                <div class="flex items-center my-6">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="mx-4 text-gray-400">Or</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 mb-6">
                    <button disabled
                        class="flex-1 flex items-center justify-center border border-gray-300 rounded-md py-2 bg-gray-100 text-gray-400 cursor-not-allowed">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google"
                            class="w-5 h-5 mr-2"> Sign in with Google
                    </button>
                    <button disabled
                        class="flex-1 flex items-center justify-center border border-gray-300 rounded-md py-2 bg-gray-100 text-gray-400 cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M16.365 1.43c0 1.14-.93 2.07-2.07 2.07-.06 0-.12 0-.18-.01.01-.13.02-.26.02-.39 0-1.14.93-2.07 2.07-2.07.06 0 .12 0 .18.01-.01.13-.02.26-.02.39zm2.52 4.36c-1.36-.08-2.51.78-3.16.78-.65 0-1.65-.76-2.72-.74-1.4.02-2.7.81-3.42 2.06-1.46 2.53-.37 6.28 1.04 8.34.7 1.01 1.53 2.14 2.62 2.1 1.05-.04 1.45-.68 2.72-.68 1.27 0 1.63.68 2.73.66 1.13-.02 1.84-1.03 2.53-2.04.44-.65.62-.99.97-1.74-2.56-.98-2.95-4.61.56-5.36-.11-.36-.32-.7-.62-.98-.5-.46-1.19-.7-1.85-.66zm-2.13 13.13c-.54 0-1.08.16-1.52.16-.44 0-.98-.15-1.61-.15-.66 0-1.36.17-2.14.17-1.09 0-2.18-.62-2.89-1.68-.99-1.47-1.4-3.57-1.4-3.57s1.29-.5 2.6-.5c.44 0 .86.06 1.25.17.39.11.74.28 1.07.5.33.22.62.5.87.82.25.32.46.68.62 1.07.16.39.28.8.36 1.22.08.42.12.85.12 1.29 0 .44-.04.87-.12 1.29-.08.42-.2.83-.36 1.22-.16.39-.37.75-.62 1.07-.25.32-.54.6-.87.82-.33.22-.68.39-1.07.5-.39.11-.81.17-1.25.17-1.31 0-2.6-.5-2.6-.5s.41-2.1 1.4-3.57c.71-1.06 1.8-1.68 2.89-1.68.78 0 1.48.17 2.14.17.63 0 1.17-.15 1.61-.15.44 0 .98.16 1.52.16.44 0 .98-.15 1.61-.15.66 0 1.36.17 2.14.17 1.09 0 2.18-.62 2.89-1.68.99-1.47 1.4-3.57 1.4-3.57s-1.29-.5-2.6-.5c-.44 0-.86.06-1.25.17-.39.11-.74.28-1.07.5-.33.22-.62.5-.87.82-.25.32-.46.68-.62 1.07-.16.39-.28.8-.36 1.22-.08.42-.12.85-.12 1.29 0 .44.04.87.12 1.29.08.42.2.83.36 1.22.16.39.37.75.62 1.07.25.32.54.6.87.82.33.22.68.39 1.07.5.39.11.81.17 1.25.17 1.31 0 2.6-.5 2.6-.5s-.41-2.1-1.4-3.57c-.71-1.06-1.8-1.68-2.89-1.68z" />
                        </svg>
                        Sign in with Apple
                    </button>
                </div>
                <div class="text-center text-sm text-gray-700">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-700 font-semibold hover:underline">Sign Up</a>
                </div>
            </div>
        </div>
        <!-- Right: Image -->
        <div class="hidden md:block md:w-1/2 h-screen bg-gray-100">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80"
                alt="Leaf" class="object-cover w-full h-full rounded-l-3xl">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>
    @endif
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: @json($errors->first()),
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Google button
            const googleBtn = document.querySelector('button:has(img[alt="Google"])');
            if (googleBtn) {
                googleBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Not Available',
                        text: 'This feature is not available yet.',
                        confirmButtonColor: '#2563eb'
                    });
                });
            }
            // Apple button
            const appleBtn = document.querySelector('button:has(svg)');
            if (appleBtn) {
                appleBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Not Available',
                        text: 'This feature is not available yet.',
                        confirmButtonColor: '#2563eb'
                    });
                });
            }
            // Forgot password link
            const forgotLink = document.querySelector('a[href="#"]:not([tabindex="-1"])');
            if (forgotLink) {
                forgotLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Not Available',
                        text: 'This feature is not available yet.',
                        confirmButtonColor: '#2563eb'
                    });
                });
            }
        });
    </script>
</body>

</html>